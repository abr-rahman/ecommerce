@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Edit feature
@endsection

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Edit Feature</h4>
                </div>
              <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('feature.update', $feature->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h3>Add Feature Form</h3>
                    <div class="form-group">
                        <label class="text-black">Feature name</label>
                        <input class="form-control @error('feature_name') is-invalid @enderror" type="text" name="feature_name" value="{{ $feature->feature_name }}">
                            @error('feature_name')
                            <span class="text-danger">  {{ $message }} </span>
                            @enderror
                    </div>
                    <div class="form-group">
                            <label class="text-black">About Feature</label>
                            <input class="form-control @error('about_feature') is-invalid @enderror" type="text" name="about_feature" value="{{ $feature->about_feature }}">
                            @error('about_feature')
                            <span class="text-danger">  {{ $message }} </span>
                            @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label>Feature Photo</label>
                        <input class="form-control" type="file" name="feature_photo">
                            @error('feature_photo')
                            <span class="text-danger">  {{ $message }} </span>
                            @enderror
                    </div> --}}
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Edite Feature</button>
                    </div>

                </form>
              </div>
            </div>
        </div>
</div>

@endsection
