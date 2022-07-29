@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Add Product
@endsection

@section('content')

    <div class="row font-weight-bold text-black">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">All Product</h4>
                </div>
              <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif


                    @error('message')
                    <div class="alert alert-danger">{{ 'message' }}</div>
                    @enderror

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Product name</label>
                                <input class="form-control text-black @error('product_name') is-invalid @enderror" type="text" name="product_name">
                                    @error('product_name')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Regular Price</label>
                                <input class="form-control text-black @error('regular_price') is-invalid @enderror" type="text" name="regular_price" value="{{ old('regular_price') }}">
                                    @error('message')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                                    @error('regular_price')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Discounted Price</label>
                                <input class="form-control text-black @error('dicsounted_price') is-invalid @enderror" type="text" name="dicsounted_price">
                                    @error('message')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                                    @error('dicsounted_price')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Text</label>
                                    <textarea rows="3" class="form-control text-black @error('short_description') is-invalid @enderror" type="text" name="short_description" ></textarea>
                                    @error('short_description')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Choose One Category</label>
                                    <select id="category_droupdown" class="form-control text-black @error('category_id') is-invalid @enderror"  name="category_id">
                                        <option value="1">>--Select One--<</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach

                                    </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Choose Sub Category</label>
                                <select id="subcategory_droupdown"  class="form-control text-black @error('subcategory_id') is-invalid @enderror" type="text" name="subcategory_id">
                                    <option style="color: red" value="">>--Choose One Category--<</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="long_description_textarea" rows="3" class="form-control text-black @error('long_description') is-invalid @enderror" type="text" name="long_description"></textarea>
                                    @error('long_description')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Weight</label>
                                <input class="form-control text-black @error('weight') is-invalid @enderror" type="text" name="weight">
                                    @error('weight')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Dimensions</label>
                                <input class="form-control text-black @error('dimensions') is-invalid @enderror" type="text" name="dimensions">
                                    @error('dimensions')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Meterials</label>
                                <input class="form-control text-black @error('meterials') is-invalid @enderror" type="text" name="meterials">
                                    @error('meterials')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Other Information</label>
                                    <textarea rows="3" class="form-control text-black @error('other_info') is-invalid @enderror" type="text" name="other_info"></textarea>
                                @error('other_info')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Photo</label>
                                <input class="form-control" type="file" name="pro_thumbnail_photo">
                                    @error('pro_thumbnail_photo')
                                    <span class="text-danger">  {{ $message }} </span>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Add Product</button>
                    </div>

                </form>
              </div>
            </div>

        </div>
    </div>

@endsection

@section('footer_select2')
    <script>
        $(document).ready(function(){
            $('#category_droupdown').change(function(){
                var category_id = $(this).val();
                //ajax start
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/get/subcategory',
                    data: {category_id:category_id },

                    success: function(data){
                       // alert(data);
                        $('#subcategory_droupdown').html(data);
                    }
                });
                //ajax end


            });
            //summernote start
            $('#long_description_textarea').summernote();
        });
    </script>
@endsection
