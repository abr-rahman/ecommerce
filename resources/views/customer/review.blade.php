@extends('layouts.frontend')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Review & Rating</h2>
                    <h5>Order ID: {{ $order_summery->id }}</h5>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ auth()->user()->name }}</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- account area start -->
    <div class="account-dashboard pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @foreach ($order_details as $order_detail)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">product Name: {{$order_detail->relationtproduct->product_name}}</h4>
                            <h5>Color: {{$order_detail->relationto_i_color->color_name}}</h5>
                            <h6>Size: {{$order_detail->relationto_i_size->size_name}}</h6>

                            <img src="{{ asset('upload/pro_thumbnail_photo') }}/{{$order_detail->relationtproduct->pro_thumbnail_photo}} " alt="not found">
                        </div>
                        <div class="card-body">
                            @if (App\Models\Review::where('order_details_id', $order_detail->id)->exists())
                                <div class="alert alert-success">
                                    You Provided review and rating of this product
                                </div>
                            @else
                            <form action="{{ route('add.review', $order_detail->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                  <label>Give Review</label>
                                  <input type="text" name="review" class="form-control" placeholder="Please Give Your Review">
                                </div>
                                <div>
                                  <label>Give Rating</label>
                                  <input type="range" name="rating" min="1" max="5" value="5">
                                </div>
                                <div class="col-2">
                                    <input type="submit" class="btn btn-success" value="Give Review">
                                </div>
                            </form>
                            @endif

                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- account area end -->
@endsection
