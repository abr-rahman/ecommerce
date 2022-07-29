@extends('layouts.dashboard_master')

@section('dashboard_bar') Add Inventory @endsection

@section('content')

    <div class="row font-weight-bold">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Inventory -- {{ $product->product_name }} </h4>
                </div>
              <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                       {{ 'You are field empthy!' }}
                    @endforeach
                </div>
                @endif --}}

                <form action="{{ route('add.inventory.post', $product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Color</label>
                                @foreach ($colors as $color)
                                <div class="form-check">
                                    <input class="form-check-input my_css" type="radio" name="color_id" id="flexRadioDefault{{ $color->id}}" value="{{ $color->id}}">
                                    <label class="form-check-label" for="flexRadioDefault{{ $color->id}}">
                                        {{ $color->color_name }} <span class="badge color_css" style="background-color: {{ $color->color_code }}"> &nbsp; </span>
                                    </label>
                                </div>
                                @endforeach
                                    @error('color_id')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-12 text-black">
                            <div class="form-group">
                                <label>Size</label>
                                <select class="form-control" name="size_id" id="">
                                    <option value="">>-- Choose Size --<</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id}}">{{ $size->size_name }}</option>
                                    @endforeach

                                </select>
                                        @error('size_id')
                                            <span class="text-danger">  {{ $message }} </span>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control" name="quantity_id">
                                    @error('quantity_id')
                                        <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Add Inventory</button>
                    </div>

                </form>
              </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Inventory -- {{ $product->product_name }} </h4>
                <span class="badge bg-dark text-black">Total Variation: {{ $inventories->count() }}</span>
                </div>
              <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SL No:</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Market Value (taka)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_market_value = 0;
                        @endphp
                        @foreach ($inventories as $inventory)
                        <tr>
                            <td>
                                {{ $loop->index+1 }}
                                @if ($inventory->quantity_id == 0)

                                    <alert class="alert-danger">
                                        Stock Out
                                    </alert>

                                @endif

                            </td>
                            <td>{{ $inventory->relationtocolor->color_name }}
                                <span class="badge color_css" style="background-color: {{ $inventory->relationtocolor->color_code }}"> &nbsp; </span>
                            </td>
                            <td>{{ $inventory->relationtosize->size_name }}</td>
                            <td>{{ $inventory->quantity_id }}</td>
                            @php
                                $total_market_value += ($product->dicsounted_price * $inventory->quantity_id);
                            @endphp
                            <td>{{ $product->dicsounted_price * $inventory->quantity_id}}</td>
                            {{-- <td>
                                <a href="{{ route('add.inventory.delete') }}" class="btn btn-sm btn-success">Delete</a>
                            </td> --}}
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="3" class="text-black"><b>Total</b></td>
                            <td class="text-black"><b>{{ $inventories->sum('quantity_id') }}</b></td>
                            <td class="text-black"><b>{{ $total_market_value}}</b></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>

        </div>
    </div>

@endsection
