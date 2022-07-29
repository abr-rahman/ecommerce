@extends('layouts.frontend')

@section('content')


    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->


    <!-- checkout area start -->
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <form action="{{ route('chekout.post') }}" method="post">
                    @csrf
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-4">
                                    <label>Name</label>
                                    <input type="text" value="{{ auth()->user()->name }}" name="customer_name" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-4">
                                    <label>Email</label>
                                    <input type="text" value="{{ auth()->user()->email }}" name="customer_email" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Country Name</label>
                                    <input type="text"  value="{{ App\Models\Country::find(session('s_country_id'))->name }}" readonly/>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>City Name</label>
                                    <input type="text" value="{{ session('s_city_name') }} " disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Address</label>
                                    <input class="billing-address" placeholder="House number and street name" type="text" name="customer_address" />
                                    <input placeholder="Apartment, suite, unit etc." type="text" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-4">
                                    <label>Phone</label>
                                    <input type="text"  name="customer_phone" />
                                </div>
                            </div>

                        </div>

                        <div class="additional-info-wrap">
                            <h4>Additional information</h4>
                            <div class="additional-info">
                                <label>Order notes</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                    name="order_notes"></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Sub Total</li>
                                        <li>{{ $sub_total }}</li>
                                    </ul>
                                    <ul>
                                        <li class="your-order-shipping">Shipping Charge</li>
                                        <li>{{ $shipping_charge }}</li>
                                    </ul>
                                    <ul>
                                        <li class="your-order-shipping">After Coupon</li>
                                        <li>{{ $after_coupon_total }}</li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li>{{ $grand_total }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment-method">
                                <h4>Payment Method</h4>
                                <select name="payment_method" id="" class="form-control">
                                    <option value="cod">Cash On Delevary</option>
                                    <option value="online">Bksh, Nagad, Rocket etc</option>
                                </select>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <style>
                                .ordr_btn { background-color:#fb5d5d;color:#fff;display:block;font-weight:700;letter-spacing:1px;line-height:1;padding:18px 20px;text-align:center;text-transform:uppercase;border-radius:0;z-index:9}
                            </style>
                            {{-- <a class="btn-hover" href="#">Place Order</a> --}}
                            <button class="btn btn-hover ordr_btn" type="submit">Place Order</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- checkout area end -->

@endsection
