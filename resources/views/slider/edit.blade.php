@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Edit slider
@endsection

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Edit slider</h4>
                </div>
              <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('slider.update', $slider->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h3>Add slider Form</h3>
                    <div class="form-group">
                        <label>slider name</label>
                        <input class="form-control @error('slider_name') is-invalid @enderror" type="text" name="slider_name" value="{{ $slider->slider_name }}">
                            @error('slider_name')
                            <span class="text-danger">  {{ $message }} </span>
                            @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label>Slider Photo</label>
                        <input class="form-control @error('slider_name') is-invalid @enderror" type="file" name="slider_photo" value="{{ $slider->slider_photo }}" >
                            @error('slider_photo')
                            <span class="text-danger">  {{ $message }} </span>
                            @enderror
                    </div> --}}
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Edite slider</button>
                    </div>

                </form>
              </div>
            </div>
        </div>
</div>

@endsection
