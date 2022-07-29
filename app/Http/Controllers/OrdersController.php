<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_summery;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function orders(){
        $order_summeris = Order_summery::latest()->get();
        return view('orders.index', compact('order_summeris'));
    }
    public function changeorderstatus(Request $request, Order_summery $order_summery){
        $order_summery->order_status = $request->order_status;

        if($order_summery->payment_method == 'cod'){
            if($request->order_status == 'delivered'){
                $order_summery->payment_status = 'paid';
            }else{
                $order_summery->payment_status = 'unpaid';
            }
        }
        $order_summery->save();
        return back();
    }

    public function laterpay( $grand_total, $order_summery_id){
       Session::put('s_grand_total', $grand_total);
       Session::put('s_order_summery_id', $order_summery_id);
       return redirect('pay');
    }
}
