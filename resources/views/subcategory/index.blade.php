@extends('layouts.dashboard_master')

@section('dashboard_bar')
    List Sub Category
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">List Sub  Category</h4>
                </div>
              <div class="card-body">
                <table class="table table-bordered" id="myTable">

                    @if ($subcategories->count() > 0)
                    <thead>
                        <tr>
                            <th class="col-1">Serial No:</th>
                            <th class="col-1">Sub: Id</th>
                            <th class="col-3">Category</th>
                            <th class="col-3">Sub Category</th>
                            <th class="col-3">Added By User Id</th>
                        </tr>
                    </thead>
                    @endif

                    <tbody>
                        @forelse ( $subcategories as $subcategory )
                        <tr>
                            <td>
                                {{ $loop->index +1 }}
                            </td>
                            <td>{{ $subcategory->id}}</td>
                            <td>{{ App\Models\Category::withTrashed()->find( $subcategory->category_id)->category_name }}</td>
                            <td>{{ $subcategory->subcategory_name }}</td>
                            <td>{{ $subcategory->added_by }}</td>
                            {{-- <td>{{ App\Models\User::find($subcategory->added_by)}}</td> --}}

                        </tr>
                            @empty
                            <tr class="text-center text-danger">
                                <td colspan="50">No data to show</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
              </div>
            </div>

        </div>
    </div>

@endsection
{{--
@section('footer_select2')
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
@endsection --}}
