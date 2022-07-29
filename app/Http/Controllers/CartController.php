<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Shipping;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function insertcart(Request $request){

        $user_id = auth()->id();

        $is_exist = Cart::where([
            'product_id' => $request->product_id,
            'i_color' => $request->i_color,
            'i_size' => $request->i_size,
            'user_id' => $user_id,
        ])->exists();
        $cart_amount_status = "";
        if($is_exist){
            Cart::where([
                'product_id' => $request->product_id,
                'i_color' => $request->i_color,
                'i_size' => $request->i_size,
                'user_id' => $user_id,
            ])->increment('cart_amount', $request->cart_amount);
            $cart_amount_status = 0;
        }else{
            Cart::insert([
                'product_id' => $request->product_id,
                'product_current_price' => $request->product_current_price,
                'i_color' => $request->i_color,
                'i_size' => $request->i_size,
                'cart_amount' => $request->cart_amount,
                'user_id' => $user_id,
                'created_at' => Carbon::now()
            ]);
            $cart_amount_status = 1;
        }
        return response()->json(['cart_amount_status' => $cart_amount_status]);
    }

    public function cart(){

        Session::put('s_coupon_name', '');

        if(Auth::check()){
            $countries = Shipping::select('country_id')->groupBy('country_id')->get();
            $carts = Cart::where('user_id', auth()->id())->get();
            return view('cart', compact('carts', 'countries'));
        }else{
            return redirect('login');
        }

    }
    public function cartremove(Request $request){

        Cart::find($request->cart_id)->delete();
        return back();
    }

    public function cartinc(Request $request){

        Cart::find($request->cart_id)->increment('cart_amount');
        return back();
    }

    public function getcitylist(Request $request){

        $select_option = '<option value="">>--Select One--<</option>';

        $cities = Shipping::where('country_id', $request->country_id)->get();

        foreach($cities as $city){
            $select_option .= "<option value='$city->shipping_charge'>$city->city_name</option>";
        }
        echo $select_option;
    }

    public function cartdec(Request $request){

        Cart::find($request->cart_id)->decrement('cart_amount');
        return back();
    }

    // Shipping section
    public function shipping(){
        $countries = Country::all();
        $shippings = Shipping::all();
        return view('shipping.index', compact('countries', 'shippings'));
    }
    public function addshipping(Request $request ){

        $status = Shipping::where([
            'country_id' => $request->country_id,
            'city_name' => $request->city_name
        ])->exists();

        if($status){
            return back()->with('error', 'This country city already exists');
        }else{
            Shipping::insert($request->except('_token'));
        }
        return back()->with('success', 'Shipping Added Successfully');
    }

    public function shippingdestroy( $shipping)
    {
        return $shipping->delete();
        // Shipping::find($shipping)->delete();
        return back();
    }

}
