@extends('layouts.dashboard_master')

@section('dashboard_bar')
Orders List
@endsection

@section('content')
    <div class="row">
        {{-- color pickup section --}}
        <div class="col-12">
            <div class="row">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <h4 class="text-white">List Orders</h4>
                        </div>
                      <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Customer Name</th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>
                                        <th>Payment Method</th>
                                        <th>Grand Total</th>
                                        <th>Created At</th>
                                        <th>Change Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_summeris as $order_summery)
                                    <tr>
                                        <td>{{ $order_summery->id }}</td>
                                        <td>{{ $order_summery->customer_name }}</td>
                                        <td>{{ $order_summery->payment_status }}</td>
                                        <td>{{ $order_summery->order_status }}</td>
                                        <td>{{ $order_summery->payment_method }}</td>
                                        <td>{{ $order_summery->grand_total }}</td>
                                        <td class="font-weight-bold">{{ $order_summery->created_at->diffforhumans() }}</td>
                                        <td>
                                            <form action="{{ route('change.order.status', $order_summery->id) }}" method="post" >
                                                @csrf
                                            <select name="order_status" class="form-control"  onchange="this.form.submit()">
                                                <option {{ ($order_summery->order_status == 'processing') ? 'selected': '' }} value="processing">Processing</option>
                                                <option {{ ($order_summery->order_status == 'On the Way') ? 'selected': '' }} value="On the Way">On the Way</option>
                                                <option {{ ($order_summery->order_status == 'delivered') ? 'selected': '' }} value="delivered">Delivered</option>
                                            </select>
                                        </form>
                                        </td>
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

