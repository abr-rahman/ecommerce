@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Slider

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-white bg-primary">
                <h4 class="text-white">Slider</h4>
            </div>
          <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3>Add Slider Form</h3>
                <div class="form-group">
                    <label>Offer Headline</label>
                    <input class="form-control text-black @error('slider_name') is-invalid @enderror" type="text" name="slider_name">
                        @error('slider_name')
                        <span class="text-danger">  {{ $message }} </span>
                        @enderror
                </div>
                <div class="form-group">
                    <label>Slider Photo</label>
                    <input class="form-control" type="file" name="slider_photo">
                        @error('slider_photo')
                        <span class="text-danger">  {{ $message }} </span>
                        @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Slider</button>
                </div>

            </form>
          </div>
        </div>

    </div>
</div>

   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Slider</h4>

                    <button  data-toggle="modal" data-target="#exampleModalCenter" class="my_btn" id="my_btn">

                        <i class="fa fa-trash fa-1.5x "></i> Recycle Bin
                    </button>
                           <!-- Modal -->
                           <div class="modal fade text-black" id="exampleModalCenter">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Deleted Category</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Sl. No</th>
                                                    <th>Slider Name</th>
                                                    <th>Restor</th>
                                                    <th>Per: Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ( $deleted_sliders as $slider )
                                                    <tr>
                                                        <td>
                                                            {{ $loop->index +1 }}
                                                        </td>
                                                        <td>{{ $slider->slider_name }}</td>
                                                        <td><img src="{{ asset('upload/slider_photo') }}/{{ $slider->slider_photo }}" width="50
                                                            " alt=""></td>
                                                        <td>
                                                            <a href="{{ route('slider.restore', $slider->id) }}" class="btn btn-outline-warning btn-sm rounded-0">Restor</a>
                                                            <a href="{{ route('slider.forcedelete', $slider->id) }}" class="btn btn-outline-info btn-sm rounded-0">Per: Delete</a>
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
              <div class="card-body table-responsive">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th>Serial No:</th>
                            <th>Offer Header</th>
                            <th>Slider Photo</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $sliders as $slider )
                        <tr>
                            <td>
                                {{ $loop->index +1 }}
                            </td>
                            <td>{{ $slider->slider_name }}</td>
                            <td><img src="{{ asset('upload/slider_photo') }}/{{ $slider->slider_photo }}" width="110
                                " alt=""></td>
                            <td class="d-flex">
                                <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-outline-warning btn-sm rounded-0">Edite</a>
                                <a href="{{ route('slider.show', $slider->id) }}" class="btn btn-outline-info btn-sm rounded-0">Show Details</a>

                                <form action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-0">Delete</button>
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

@endsection

@section('footer_select2')
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
@endsection
