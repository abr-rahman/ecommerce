<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Chekout;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    // coupon section
    public function coupon(){
        $coupons = Coupon::all();
        return view('coupon.index', compact('coupons'));
    }
    public function addcoupon(Request $request ){
        Coupon::insert($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);
        return back();
    }
    public function chekcoupon(Request $request ){
        if(Coupon::where('coupon_name', $request->coupon_name)->exists()){
            $coupon = Coupon::where('coupon_name', $request->coupon_name)->first();
            // echo $coupon->coupon_valid_date;
            // echo Carbon::today();
            if(Carbon::today() <= $coupon->coupon_valid_date){
                // echo $coupon->minimum_order;
                // echo $request->sub_total;
                if($coupon->minimum_order > $request->sub_total){
                    Session::put('s_coupon_name', '');
                    return response()->json([
                        'error' => 'You have to minimum order '. $coupon->minimum_order
                    ]);
                }else{
                    Session::put('s_coupon_name', '');
                    if($coupon->coupon_limit == 0){
                        return response()->json([
                            'error' => 'This coupon usage limite over'
                        ]);
                    }else{

                        Session::put('s_coupon_name', $request->coupon_name);

                        if($coupon->coupon_type == 'percentage'){
                            $grand_total = $request->sub_total - ($request->sub_total * ($coupon->coupon_amount/100));
                        }else{
                            $grand_total = $request->sub_total - $coupon->coupon_amount ;
                        }
                        return response()->json([
                            'coupon_type' => $coupon->coupon_type,
                            'grand_total' => $grand_total,
                            'coupon_amount' => $coupon->coupon_amount
                        ]);
                    }
                }
            }else{
                Session::put('s_coupon_name', '');
                return response()->json([
                    'error' => 'This Coupon validity date over'
                ]);
            }
        }else{
            Session::put('s_coupon_name', '');
            return response()->json([
                'error' => 'This Coupon Name is not exists'
            ]);
        }

    }

}
