<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Chekout;
use App\Models\Inventory;
use App\Models\Order_detail;
use App\Models\Order_summery;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class ChekoutController extends Controller
{
    public function chekout(){
        // direct cart page na asar cheking start
        $after_link = explode('/', url()->previous());

        if(end($after_link) != "cart"){
            return abort(404);
        }
        // direct na asar cheking end

        $sub_total = 0;
        foreach(Cart::where('user_id', auth()->user()->id)->get() as $cart){
            $sub_total += ($cart->product_current_price * $cart->cart_amount);
        }

        $shipping_charge = Shipping::where([
            'Country_id' => Session::get('s_country_id'),
            'city_name' => Session::get('s_city_name')
        ])->first()->shipping_charge;

        // echo $sub_total;
        // echo $shipping_charge;

        if(Session::get('s_coupon_name')){
            $coupon = Coupon::where('coupon_name', Session::get('s_coupon_name'))->first();

            if($coupon->coupon_type == 'percentage'){
                $after_coupon_total = $sub_total - ($sub_total * ($coupon->coupon_amount/100));
            }else{
                $after_coupon_total = $sub_total - $coupon->coupon_amount ;
            }

        }else{
            $after_coupon_total = $sub_total;
        }

        $grand_total = $after_coupon_total + $shipping_charge;

        Session::put('s_sub_total', $sub_total);
        Session::put('s_shipping_charge', $shipping_charge);
        Session::put('s_discount_amount', ($sub_total - $after_coupon_total));
        Session::put('s_grand_total', $grand_total);

        return view('chekout.index', compact('sub_total', 'shipping_charge', 'after_coupon_total', 'grand_total'));
    }
    public function setcountrycity(Request $request){
        Session::put('s_country_id', $request->country_id);
        Session::put('s_city_name', $request->city_name);
    }
    public function chekoutpost(Request $request){

        $order_summery_id = Order_summery::insertGetId([
            'user_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_country_id' => session('s_country_id'),
            'customer_city' => session('s_city_name'),
            'customer_address' => $request->customer_address,
            'customer_phone' => $request->customer_phone,
            'order_notes' => $request->order_notes,
            'payment_method' => $request->payment_method,
            'sub_total' => session('s_sub_total'),
            'shipping_charge' => session('s_shipping_charge'),
            'coupon_name' => session('s_coupon_name'),
            'discount_amount' => session('s_discount_amount'),
            'grand_total' => session('s_grand_total'),
            'created_at' => Carbon::now()
        ]);
        // return $order_summery_id;
         $cart_products = Cart::where('user_id', auth()->id())->get();
        foreach($cart_products as $cart_product){
            Order_detail::insert([
                'order_summery_id' => $order_summery_id,
                'product_id' => $cart_product->product_id,
                'product_current_price' => $cart_product->product_current_price,
                'i_color' => $cart_product->i_color,
                'i_size' => $cart_product->i_size,
                'amount' => $cart_product->cart_amount,
                'created_at' => Carbon::now()
             ]);

             //decrement at inventory
             Inventory::where([
                'product_id' => $cart_product->product_id,
                'color_id' => $cart_product->i_color,
                'size_id' => $cart_product->i_size,
             ])->decrement('quantity_id', $cart_product->cart_amount);

             // delete form cart
             $cart_product->delete();
        }

        if(session('s_coupon_name')){
            Coupon::where('coupon_name', session('s_coupon_name'))->decrement('coupon_limit');
        }

        // Online payment start
        if( $request->payment_method == 'online'){

            Session::put('s_order_summery_id', $order_summery_id);

            return redirect('pay');
            // Online payment end
        }else{
            return redirect('customer/dashboard');
        }


    }

    public function viewinvoice(Order_summery $order_summery){
        // return $order_summery;
        // return Order_detail::where('');
        // return Order_detail::where('order_summery_id', $order_summery_id)->get();
        $order_details = Order_detail::where('order_summery_id', $order_summery->id)->get();
        return view('invoice.index', compact('order_summery', 'order_details'));
    }
    public function downloadinvoice(Order_summery $order_summery){
        $pdf = PDF::loadView('invoice.index', compact('order_summery'));
        return $pdf->download(Carbon::now()->format('M d, Y') .' GoldFish Id '. $order_summery->id .'.pdf');
    }

}

