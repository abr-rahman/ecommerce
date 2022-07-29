@extends('layouts.dashboard_master')

@section('dashboard_bar')
Sub Create Category
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Create Sub Category</h4>
                </div>
              <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('subcategory.store') }}" method="POST">
                    @csrf
                    <h3>Add Sub Category Form</h3>
                    <div class="form-group">
                        <label>Sub Category name</label>

                       <select id="select" name="category_id" id="" class="form-control @error('subcategory_name') is-invalid @enderror">
                           <option value="" style="padding: 5px;">>-Select One Category -<</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                          @endforeach
                       </select>

                       @error('category_id')
                       <span class="text-danger"> {{ $message }} </span>
                       @enderror

                    </div>
                    <div class="form-group">
                        <label>Sub Category name</label>
                        <input class="form-control @error('subcategory_name') is-invalid @enderror" type="text" name="subcategory_name">
                            @error('subcategory_name')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <button id="sweet_alert" class="btn btn-primary" type="submit">Create Sub Category</button>
                    </div>

                </form>
              </div>
            </div>

        </div>
    </div>

@endsection


@section('footer_select2')
    <script>
        $(document).ready(function() {
            $('#select').select2();
        });
    </script>
@endsection
