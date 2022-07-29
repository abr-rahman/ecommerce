<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use App\Models\Order_summery;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(Order_summery $order_summery, Order_detail $id){

        $order_details = Order_detail::where('order_summery_id', $order_summery->id)->get();

        return view('customer.review', compact('order_summery', 'order_details'));
    }

    public function addreview (Request $request, Order_detail $order_details_id){

        // echo $order_details_id;
        // return $request;
        Review::insert([
            'order_details_id' => $order_details_id->id,
            'product_id' => $order_details_id->product_id,
            'i_color' => $order_details_id->i_color,
            'i_size' => $order_details_id->i_size,
            'user_id' => auth()->id(),
            'review' => $request->review,
            'rating' => $request->rating,
            'created_at' => Carbon::now()
        ]);
        return back();
    }
}
