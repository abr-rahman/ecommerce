@extends('layouts.dashboard_master')

@section('dashboard_bar') Add Features Photo @endsection

@section('content')

    <div class="row font-weight-bold text-black">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Features Photo -- {{ $product->product_name }} </h4>
                </div>
              <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('file_err'))
                    <div class="alert alert-danger">{{ session('file_err') }}</div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                       {{ 'You are field empthy!' }}
                    @endforeach
                </div>
                @endif

                <form action="{{ route('product.addfeature.post', $product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Add Features Photo</label>
                                <input class="form-control" type="file" name="pro_multiple_photo[]" multiple>
                                    @error('file_err')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Add Features Photo</button>
                    </div>

                </form>
              </div>
            </div>

        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Features Photo -- {{ $product->product_name }} </h4>
                </div>
              <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SL No:</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pro_multiple_photos as $pro_multiple_photo)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>

                            <td>
                                <img width="100" src="{{ asset('upload/pro_multiple_photo') }}/{{ $pro_multiple_photo->pro_multiple_photo_name }}" alt="not found">
                            </td>
                            <td>
                                <a href="{{ route('product.featuredelete') }}" class="btn btn-sm btn-success">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
              </div>
            </div>

        </div>
    </div>

@endsection
