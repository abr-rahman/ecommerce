@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Create Category
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Create Category</h4>
                </div>
              <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('Category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h3>Add Category Form</h3>
                    <div class="form-group">
                        <label>Category name</label>
                        <input class="form-control text-black @error('category_name') is-invalid @enderror" type="text" name="category_name">
                            @error('category_name')
                            <span class="text-danger">  {{ $message }} </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label>Category Photo</label>
                        <input class="form-control" type="file" name="category_photo">
                            @error('category_photo')
                            <span class="text-danger">  {{ $message }} </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Create Category</button>
                    </div>

                </form>
              </div>
            </div>

        </div>
    </div>

@endsection
