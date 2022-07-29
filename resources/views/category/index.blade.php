@extends('layouts.dashboard_master')

@section('dashboard_bar')
    List Category

@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">List Category</h4>

                    <button  data-toggle="modal" data-target="#exampleModalCenter" class="my_btn" id="my_btn">

                        <i class="fa fa-trash fa-1.5x "></i> Recycle Bin
                    </button>
                           <!-- Modal -->
                           <div class="modal fade text-black" id="exampleModalCenter">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Deleted Category</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Sl. No</th>
                                                    <th>Category Name</th>
                                                    <th>Restor</th>
                                                    <th>Per: Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($deleted_categories as $deleted_category)
                                                    <tr>
                                                        <td>{{ $loop->index +1 }}</td>
                                                        <td>{{ $deleted_category->category_name }}</td>
                                                        <td>
                                                            <a href="{{ route('categoryrestore', $deleted_category->id) }}" class="btn btn-info btn-square btn-sm">Restor</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('category.forcedelete', $deleted_category->id) }}" class="btn btn-danger btn-square btn-sm">Per: Delete</a>
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
                            <th>Category name </th>
                            <th>Cat: Photo</th>
                            {{-- <th>Created at </th> --}}
                            <th>Action</th>
                            <th>Details</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $categories as $category )
                        <tr>
                            <td>
                                {{ $loop->index +1 }}
                            </td>
                            <td>{{ $category->category_name }}</td>
                            <td><img src="{{ asset('upload/category_photo') }}/{{ $category->category_photo }}" width="110
                                " alt=""></td>
                            <td>
                                <form action="{{ route('Category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </td>
                            <td><a href="{{ route('Category.show', $category->id) }}" class="btn btn-outline-info btn-sm">Show Details</a></td>
                            <td><a href="{{ route('Category.edit', $category->id) }}" class="btn btn-outline-warning btn-sm">Edite</a></td>
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

