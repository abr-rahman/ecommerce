@extends('layouts.dashboard_master')

@section('dashboard_bar')
Shipping Charge Chart
@endsection

@section('content')
    <div class="row">
        {{-- color pickup section --}}
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <h4 class="text-white">Add Shipping
                            </h4>
                        </div>
                        <div class="card-body">

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('add.shipping') }}" method="POST">
                                @csrf
                                <h3>Add Shipping Form</h3>
                                <div class="form-group">
                                    <label>country name</label>
                                    <select name="country_id" id="" class="form-control">
                                        <option value="">>--Select Country--<</option>

                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }} ({{ $country->code }})</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>City Name</label>
                                    <input class="form-control" type="text" name="city_name">
                                </div>
                                <div class="form-group">
                                    <label>Shipping Charge</label>
                                    <input class="form-control" type="number" name="shipping_charge">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Add color</button>
                                </div>
                            </form>
                          </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <h4 class="text-white">List Color</h4>
                        </div>
                      <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Country Name</th>
                                        <th>City Name</th>
                                        <th>Shipping Charge</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shippings as $shipping)
                                    <tr>
                                        <td>{{ $shipping->rel_to_country->name }} ({{ $shipping->rel_to_country->code }})</td>
                                        <td>{{ $shipping->city_name }}</td>
                                        <td>{{ $shipping->shipping_charge }}</td>
                                        <td>
                                            <a href="{{ route('shipping.destroy') }}" type="button" class="btn btn-danger btn-sm">Delete</a>
                                            {{-- <form action="{{ route('shipping.destroy', $shipping->id, $country->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                            </form> --}}
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
