@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Variation Manager
@endsection

@section('content')
    <div class="row">
        {{-- color pickup section --}}
        <div class="col-6">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h4 class="text-white">Add Color</h4>
                    </div>
                  <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('add.color') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3>Add Color Form</h3>
                        <div class="form-group">
                            <label>Color name</label>
                            <input class="form-control text-black @error('color_name') is-invalid @enderror" type="text" name="color_name">
                                @error('color_name')
                                <span class="text-danger">  {{ $message }} </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Color Code</label>
                            <input class="form-control col-3" type="color" name="color_code">
                                @error('color_code')
                                <span class="text-danger">  {{ $message }} </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Add color</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h4 class="text-white">List Color</h4>
                    </div>
                  <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Color Name</th>
                                    <th>Color Cods</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $color)
                                <tr>
                                    <td>{{ $color->color_name }}</td>
                                    <td><span class="badge" style="background-color: {{ $color->color_code }}"> &nbsp; </span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                  </div>
                </div>
            </div>
        </div>
        {{-- size pickup section --}}
        <div class="col-6">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h4 class="text-white">Add Size</h4>
                    </div>
                  <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('add.size') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3>Add Size Form</h3>
                        <div class="form-group">
                            <label>Size name</label>
                            <input class="form-control text-black @error('size_name') is-invalid @enderror" type="text" name="size_name">
                                @error('size_name')
                                <span class="text-danger">  {{ $message }} </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Add size</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h4 class="text-white">List size</h4>
                    </div>
                  <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Size Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sizes as $size)
                                <tr>
                                    <td>{{ $size->size_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                  </div>
                </div>
            </div>
        </div>
    </div>

@endsection
