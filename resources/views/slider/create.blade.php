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

@endsection

