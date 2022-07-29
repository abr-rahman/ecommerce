@extends('layouts.frontend')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Product Details</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $product->product_name }}</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Product Details Area Start -->
    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                    <!-- Swiper -->
                    <div class="swiper-container zoom-top">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto" src="{{ asset('upload/pro_thumbnail_photo')}}/{{ $product->pro_thumbnail_photo }}"
                                    alt="">
                            </div>

                            @foreach ($pro_multiple_photos as $pro_multiple_photo)
                                <div class="swiper-slide zoom-image-hover">
                                    <img class="img-responsive m-auto" src="{{ asset('upload/pro_multiple_photo/')}}/{{ $pro_multiple_photo->pro_multiple_photo_name}}"
                                        alt="">
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="swiper-container zoom-thumbs mt-3 mb-3">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <img class="img-responsive m-auto" src="{{ asset('upload/pro_thumbnail_photo')}}/{{ $product->pro_thumbnail_photo }}"
                                    alt="">
                            </div>
                            @foreach ($pro_multiple_photos as $pro_multiple_photo)
                            <div class="swiper-slide">
                                <img class="img-responsive m-auto" src="{{ asset('upload/pro_multiple_photo/')}}/{{ $pro_multiple_photo->pro_multiple_photo_name}}"
                                    alt="">
                            </div>
                            @endforeach




                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content">
                        @php
                            $product_id = $product->id;
                            $product_current_price = $product->dicsounted_price;
                        @endphp
                        <h2>{{ $product->product_name }}</h2>
                        <div class="pricing-meta">
                            <ul>
                                <li class="text-success">{{$product->dicsounted_price}}</li>
                                    @if ($product->dicsounted_price != $product->regular_price)
                                        <li class="text-danger">
                                            <s>{{ $product->regular_price }}</s>
                                        </li>
                                    @endif

                            </ul>
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div class="rating-product">

                                @for ($star = 1; $star <= round($reviews->average('rating')); $star++)
                                <i class="fa fa-star"></i>
                                @endfor

                            </div>
                            <span class="read-review"><a class="reviews" href="#">( {{ $reviews->count() }} Customer Review )</a></span>
                        </div>
                        <div class="pro-details-color-info d-flex align-items-center">

                            <input type="hidden" id="i_color">
                            <input type="hidden" id="i_size">
                            <span>Color</span>
                            <div class="pro-details-color">
                                <ul>
                                    @forelse ($inventories as $inventory)
                                        <li id="{{ $inventory->color_id }}"  class="color_plate" title="{{ $inventory->relationtocolor->color_name }}">
                                            <a class="{{ ($loop->first == 1)? 'active-color':''  }}" style="background-color:{{ $inventory->relationtocolor->color_code}} "></a>
                                        </li>
                                     @empty
                                        <li style="color: red">No Color Avaliable</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="pro-details-size-info d-flex align-items-center">
                            <span>Size</span>
                            <div class="pro-details-size">
                                <select id="size_droupdown" class="form-control text-center">
                                    <option class="text-center text-danger">>--Please Choose Color Fast--<</option>
                                </select>
                            </div>
                        </div>
                        <p class="m-0">
                            Available Stock:
                            <span class="badge bg-success" id="available_stock">
                                {{ $total_inventory }}
                            </span>
                        </p>
                        <p class="m-0">{{ $product->short_description }} </p>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input id="cart_amount" class="cart-plus-minus-box" type="text" name="qtybutton" value=""/>
                            </div>
                            <div class="pro-details-cart" >

                                @auth
                                    <input class="login_status" type="hidden" value="yes" id="login_status">
                                 @else
                                    <input class="login_status" type="hidden" value="no" id="login_status">
                                @endauth

                                <button id="cart_btn" class="add-cart">Add To Cart</button>

                            </div>
                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                <a href="#"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-details-compare-wishlist pro-details-compare">
                                <a href="#"><i class="pe-7s-refresh-2"></i></a>
                            </div>
                            {{-- SHSFGSFHSFHFSDGHD --}}
                        <div class="pro-details-cart d-none" id="view_cart">
                            <a href="{{ route('cart') }}" class="btnk btn-hover-primary mb-30px add-cart">view cart</a>
                        </div>
                            {{-- GDHSFDGHDGJDGHJGDFHD --}}
                        </div>

                        <div class="pro-details-sku-info pro-details-same-style  d-flex">
                            <span>SKU: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">{{ $product->sku }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-categories-info pro-details-same-style d-flex">
                            <span>Category: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">{{ App\Models\Category::find($product->category_id)->category_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-categories-info pro-details-same-style d-flex">
                            <span>Sub Category: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">{{ App\Models\Subcategory::find($product->subcategory_id)->subcategory_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-social-info pro-details-same-style d-flex">
                            <span>Share: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="http://www.facebook.com/sharer/sharer.php?u={{ url()->full()}}&t={{ $product->product_name}}" target="_blank" class="share-popup"><i class="fa fa-facebook"></i></a>
                                    <a href="http://www.twitter.com/intent/tweet?url={{ url()->full()}}&via=TWITTER_HANDLE_HERE&text={{ $product->product_name}}" target="_blank" class="share-popup"><i class="fa fa-twitter"></i></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- product details description area start -->
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details2">Information</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                    <a data-bs-toggle="tab" href="#des-details3">Reviews ({{ $reviews->count() }})</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper text-start">
                            <ul>
                                <li><span>Weight</span> {{$product->weight}} g</li>
                                <li><span>Dimensions</span>{{ $product->dimensions }}</li>
                                <li><span>Materials</span>{{ $product->meterials }}</li>
                                <li><span>Other Info</span> {{ $product->other_info }}</li>
                            </ul>
                        </div>
                    </div>
                    <div id="des-details1" class="tab-pane active">
                        <div class="product-description-wrapper">
                            <p>
                                {!! $product->long_description !!}
                            </p>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="review-wrapper">
                                    @forelse ($reviews as $review)
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{ asset('fronted') }}/images/review-image/1.png" alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>{{ App\Models\User::find($review->user_id)->name }}</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        @for ($star = 1; $star <=  $review->rating; $star++ )
                                                            <i class="fa fa-star"></i>
                                                        @endfor

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>
                                                   {{ $review->review }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <div class="alert alert-danger">
                                            No Reviews This Product
                                        </div>
                                    @endforelse

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details description area end -->

    <!-- Related product Area Start -->
    <div class="related-product-area pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-30px0px line-height-1">
                    <h2 class="title m-0">Related Products {{ $related_products->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                <div class="new-product-wrapper swiper-wrapper">
                        <!-- Single Prodect -->
                @foreach ($related_products as $product)
                    <div class="new-product-item swiper-slide">

                        @include('parts.product')
                    </div>
                @endforeach
                        <!-- Single Prodect -->
                </div>
                <!-- Add Arrows -->
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Related product Area End -->
@endsection

@section('footer_script')
    <script>
        $(document).ready(function(){
            $('.color_plate').click(function(){
                var color_id = $(this).attr('id');
                var product_id = "{{ $product_id }}";
                $('#i_color').val(color_id);
                $('#i_size').val("");

                //ajax start
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                   // url: :"{{'get.sizes' }}",
                    url: '/get/sizes',
                    data: {product_id:product_id, color_id:color_id},

                    success: function(data){
                       // alert(data);
                        $('#size_droupdown').html(data);
                    }
                });
                //ajax end
            });


            $('#size_droupdown').change(function(){
                 var size_id = $(this).val();
                 $('#i_size').val(size_id);
                //  $('#cart_amount').html(data);
                 var color_id = $('#i_color').val();
                 var product_id = "{{ $product_id }}";

                 //ajax start
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                   // url: :"{{ route('get.inventory') }}",
                    url: '/get/inventory',
                    data: {product_id:product_id, color_id:color_id, size_id:size_id},

                    success: function(data){
                       // alert(data);
                        $('#available_stock').html(data);
                    }
                });
                //ajax end
            });


            // cghxgfbnxfghsfbsxghxfd



        //     $('#cart_btn').click(function(){
        //     var login_status = $('#login_status').val();
        //     if(login_status == "yes"){
        //         var available_stock = parseInt($('#available_stock').html());
        //         var cart_amount = parseInt($('#cart_amount').val());
        //         if(available_stock < cart_amount){
        //             Swal.fire(
        //             'Stock Not Available!',
        //             'Your asking for more!',
        //             'waring'
        //             );
        //         }else{
        //             if(isNaN(cart_amount) || cart_amount <= 0){
        //                 Swal.fire(
        //                 'Card Amount Can Not Be Less Then 1!',
        //                 'Important !',
        //                 'warning'
        //                 );
        //             }else{
        //                 var i_color = $('#i_color').val();
        //                 var i_size = $('#i_size').val();
        //                 var cart_amount = $('#cart_amount').val();
        //                 var product_id = {{$product_id}};;
        //                     // ajax start
        //                 $.ajaxSetup({
        //                     headers: {
        //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                     }
        //                 });
        //                 $.ajax({
        //                     type: 'POST',
        //                     url: '/insert/cart',
        //                     data: {product_id:product_id, product_current_price:product_current_price, i_color:i_color, i_size:i_size, cart_amount:cart_amount },
        //                     success: function(data){
        //                         $('#header_cart_num').html(data.cart_amount_status + parseInt($('#cart_amount_status').html()));
        //                             Swal.fire(
        //                             'Cart Added Successfully',
        //                             'Important',
        //                             'success'
        //                         )
        //                     }
        //                 });
        //             }
        //         }
        //     }else{
        //         Swal.fire({
        //             title: 'Are you not logged in!',
        //             text: "Please Login First",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Yes, Login!'
        //             }).then((result) => {
        //             if (result.isConfirmed) {
        //                 window.location.href = "{{route('customerlogin')}}";
        //             }
        //             })
        //     }
        // });



            // kjxgfhzxfdghsfhshsdhd


            $('#cart_btn').click(function(){
               if($('#login_status').val() == 'no'){
                //   alert('Please login first to add to cart');
                    Swal.fire({
                    title: 'You are not logged in!',
                    text: "Please login first to add to cart.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Go to login'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('customerlogin') }}";
                    }
                })
               }else{
                var available_stock = parseInt($('#available_stock').html());
                var cart_amount = parseInt($('#cart_amount').val());

                    if(cart_amount > available_stock){
                        Swal.fire(
                        'Stock Not Available!',
                        'You are asking for more!',
                        'warning'
                        )
                    }
                    else{
                        if(isNaN(cart_amount)){
                                Swal.fire(
                                'Choose color , size & number First!',
                                'You are asking for more!',
                                'warning'
                                )
                            }
                            else{
                                if(cart_amount <= 0 ){
                                Swal.fire(
                                    'Card Amount Can Not Be Less Then 1!',
                                    'Important !',
                                    'waring'
                                )
                            }
                            else{
                                var product_id = "{{ $product_id }}";
                                var product_current_price = "{{ $product_current_price }}";
                                var i_color = $('#i_color').val();
                                var i_size = $('#i_size').val();
                                var cart_amount = $('#cart_amount').val();
                                // var user_id = {{ auth()->id() }};

                                            //ajax start
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                        type: 'POST',
                                        // url: :"{{ route('insert.cart') }}",
                                        url: '/insert/cart',
                                        data: {product_id:product_id, product_current_price:product_current_price, i_color:i_color, i_size:i_size, cart_amount:cart_amount},

                                        success: function(data){
                                            $('#header_cart_num').html(data.cart_amount_status + parseInt($('#cart_amount_status').html()));
                                            Swal.fire(
                                                'Cart Added Successfully',
                                                'Important',
                                                'success'
                                                )
                                            $('#view_cart').removeClass('d-none');
                                        }
                                    });
                                    // ajax end
                            }

                    }
                }
            }

            });

// ncvnxcvnxvcnxvnxcv


        });

    </script>
@endsection
