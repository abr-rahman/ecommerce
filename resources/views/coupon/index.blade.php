@extends('layouts.dashboard_master')

@section('dashboard_bar')
Coupon List
@endsection

@section('content')
    <div class="row">
        {{-- color pickup section --}}
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <h4 class="text-white">Add Coupon
                            </h4>
                        </div>
                        <div class="card-body">

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('add.coupon') }}" method="POST">
                                @csrf
                                <h3>Add Coupon Form</h3>
                                <div class="form-group">
                                    <label>Coupon Name</label>
                                    <input class="form-control" type="text" name="coupon_name">
                                </div>
                                <div class="form-group">
                                    <label>Coupon Validate Date</label>
                                    <input class="form-control" type="date" name="coupon_valid_date">
                                </div>
                                <div class="form-group">
                                    <label>Coupon Type</label>
                                    <select class="form-control" name="coupon_type" id="">
                                        <option value="flat">Flate Discount</option>
                                        <option value="percentage">Percentage Discount</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Coupon Amount</label>
                                    <input class="form-control" type="number" name="coupon_amount">
                                </div>
                                <div class="form-group">
                                    <label>Minimum Amount Order</label>
                                    <input class="form-control" type="number" name="minimum_order">
                                </div>
                                <div class="form-group">
                                    <label>Coupon Limit Person</label>
                                    <input class="form-control" type="number" name="coupon_limit">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Add color</button>
                                </div>
                            </form>
                          </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <h4 class="text-white">List Color</h4>
                        </div>
                      <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Coupon Name</th>
                                        <th>Validate Date</th>
                                        <th>Coupon Type</th>
                                        <th>Coupon Amount</th>
                                        <th>Minimum Order</th>
                                        <th>Coupon Limit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->coupon_name }} </td>
                                        <td>{{ $coupon->coupon_valid_date }} </td>
                                        <td>{{ $coupon->coupon_type }} </td>
                                        <td>{{ $coupon->coupon_amount }} </td>
                                        <td>{{ $coupon->minimum_order }} </td>
                                        <td>{{ $coupon->coupon_limit }} </td>

                                        {{-- <td>
                                            <a href="{{ route('Coupon.destroy') }}" type="button" class="btn btn-danger btn-sm">Delete</a>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                      </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection
