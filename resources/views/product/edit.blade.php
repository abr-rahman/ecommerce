@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Edit Category
@endsection

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Edit Category</h4>
                </div>
              <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('Category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h3>Add Category Form</h3>
                    <div class="form-group">
                        <label>Category name</label>
                        <input class="form-control @error('category_name') is-invalid @enderror" type="text" name="category_name" value="{{ $category->category_name }}">
                            @error('category_name')
                            <span class="text-danger">  {{ $message }} </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Edite Category</button>
                    </div>

                </form>
              </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="{{ url()->previous() }}" class="btn btn-tumblr">Back</a>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
