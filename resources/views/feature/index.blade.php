@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Feature Section

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-white bg-primary">
                <h4 class="text-white">Feature</h4>
            </div>
          <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('feature.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3>Add Feature Form</h3>
                <div class="form-group">
                    <label>Feature Headline</label>
                    <input class="form-control text-black @error('feature_name') is-invalid @enderror" type="text" name="feature_name">
                        @error('feature_name')
                        <span class="text-danger">  {{ $message }} </span>
                        @enderror

                    <label>Some text</label>
                    <input class="form-control text-black @error('about_feature') is-invalid @enderror" type="text" name="about_feature">
                    @error('about_feature')
                    <span class="text-danger">  {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>feature Photo</label>
                    <input class="form-control" type="file" name="feature_photo">
                        @error('feature_photo')
                        <span class="text-danger">  {{ $message }} </span>
                        @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Feature</button>
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
                    <h4 class="text-white">Feature</h4>

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
                                                    <th>Feature Name</th>
                                                    <th>Restor</th>
                                                    <th>Per: Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @foreach ($deleted_categories as $deleted_category)
                                                    <tr>
                                                        <td>{{ $loop->index +1 }}</td>
                                                        <td>{{ $deleted_category->category_name }}</td>
                                                        <td>
                                                            <a href="{{ route('category.restore', $deleted_category->id) }}" class="btn btn-info btn-square btn-sm">Restor</a>
                                                        </td>
                                                        <td><a href="{{ route('category.forcedelete', $deleted_category->id) }}" class="btn btn-danger btn-square btn-sm">Per: Delete</a></td>
                                                    </tr>
                                                    @endforeach --}}

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
                            <th>Header of Feature</th>
                            <th>About Feature</th>
                            <th>Feature Photo</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $features as $feature )
                        <tr>
                            <td>
                                {{ $loop->index +1 }}
                            </td>
                            <td>{{ $feature->feature_name }}</td>
                            <td>{{ $feature->about_feature }}</td>
                            <td><img src="{{ asset('upload/feature_photo') }}/{{ $feature->feature_photo }}" width="60
                                " alt=""></td>
                            <td class="d-flex">
                                <a href="{{ route('feature.edit', $feature->id) }}" class="btn btn-outline-warning btn-sm rounded-0">Edite</a>
                                <a href="{{ route('feature.show', $feature->id) }}" class="btn btn-outline-info btn-sm rounded-0">Show Details</a>

                                <form action="{{ route('feature.destroy', $feature->id) }}" method="POST">
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
