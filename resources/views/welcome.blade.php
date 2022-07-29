@extends('layouts.frontend')

@section('content')
    <!-- Hero/Intro Slider Start -->
    <div class="section ">
        <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
            <!-- Hero slider Active -->
            <div class="swiper-wrapper">
                <!-- Single slider item -->

                @forelse ($sliders as $slider)

                <div class="hero-slide-item-2 slider-height swiper-slide d-flex {{ ($loop->odd) ? 'bg-color1': 'bg-color2' }} ">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                                <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                    <h3 class="title-1">{{ $slider->slider_name }}</h3>
                                    <a href="#" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                        Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div
                                class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                                <div class="show-case">
                                    <div class="hero-slide-image">
                                        <img src="{{ asset('upload/slider_photo') }}/{{ $slider->slider_photo }}" alt="" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <h1>No data show</h1>
                @endforelse



            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-white"></div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- Hero/Intro Slider End -->
    <!-- Feature Area Srart -->
    <div class="feature-area  mt-n-65px">
        <div class="container">
            <div class="row">
                @forelse ($features as $feature)
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="{{ asset('upload/feature_photo') }}/{{ $feature->feature_photo }}" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="title">{{ $feature->feature_name }}</h4>
                            <span class="sub-title">{{ $feature->about_feature }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-4 col-md-6">
                    <h2>No data found</h2>
                </div>
                @endforelse

            </div>
        </div>
    </div>
    <!-- Feature Area End -->

    <!-- Product Area Start -->
    <div class="product-area pt-100px pb-100px">
        <div class="container">
            <!-- Section Title & Tab Start -->
            <div class="row">
                @foreach ($api_products as $api_product)
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            {{ $api_product['title'] }}
                        </div>
                        <div class="card-body">
                            <img src="{{ $api_product['image'] }}" alt="" width="100" height="100">
                            <div class="bade badge-success">{{ $api_product['price'] }} taka</div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Section Title Start -->
                <div class="col-12">
                    <div class="section-title text-center mb-0">
                        <h2 class="title">#products</h2>
                        <!-- Tab Start -->
                        <div class="nav-center">
                            <ul class="product-tab-nav nav align-items-center justify-content-center">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-product--all">All</a></li>

                                @foreach ($categories as $category)
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-product-{{ $category->id }}">{{ $category->category_name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- Tab End -->
                    </div>
                </div>
                <!-- Section Title End -->
            </div>
            <!-- Section Title & Tab End -->

            <div class="row">
                <div class="col">
                    <div id="login_check" class="tab-content mb-30px0px">
                        <!-- 1st tab start -->
                        <div class="tab-pane fade show active" id="tab-product--all">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                    data-aos-delay="400">

                                    <!-- Single Prodect -->
                                    @include('parts.product')
                                    <!-- Single Prodect -->
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- 1st tab end -->

                        <!-- 2nd tab start -->
                        @foreach ($categories as $category)
                        <div  class="tab-pane fade" id="tab-product-{{ $category->id }}">
                            <div class="row">
                                @forelse ( App\Models\Product::where('category_id', $category->id)->get() as $product)
                                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                data-aos-delay="200">

                                <!-- Single Prodect -->
                                    @include('parts.product')
                                </div>
                                @empty
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>No data at yet</h3>
                                        </div>
                                    </div>
                                @endforelse
                                <!-- 2nd tab end -->
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More <i
                            class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
     </div>
    <!-- Product Area End -->

    <!-- Banner Area Start -->
    {{-- <div class="row"> --}}
        <div class="col-12">
            <div class="banner-area pt-100px pb-100px plr-15px">
                <div class="container">
                    <div class="row m-0">

                        @forelse ( $categories as $category )
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="single-banner-2">
                                <img src="{{ asset('upload/category_photo') }}/{{ $category->category_photo }}" alt="">
                                <div class="item-disc">
                                    <h4 class="title">New Collection <br>
                                        For {{ $category->category_name }}</h4>
                                    <a href="" class="shop-link btn btn-primary">Shop Now <i class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 m-auto">
                            <div class="single-banner-2">
                                <div class="alert alert-danger">
                                    No Category Show
                                </div>
                            </div>
                        </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}

    <!-- Banner Area End -->

    <!-- Product Area Start -->
    <div class="product-area pt-100px pb-100px">
        <div class="container">
            <!-- Section Title & Tab Start -->
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg col-md col-12">
                    <div class="section-title mb-0">
                        <h2 class="title">#newarrivals</h2>
                    </div>
                </div>
                <!-- Section Title End -->

                <!-- Tab Start -->
                <div class="col-lg-auto col-md-auto col-12">
                    <ul class="product-tab-nav nav">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                href="#tab-product-all">All</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-product-new">New</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                href="#tab-product-bestsellers">Bestsellers</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                href="#tab-product-itemssale">Items
                                Sale</a></li>
                    </ul>
                </div>
                <!-- Tab End -->
            </div>
            <!-- Section Title & Tab End -->

            <div class="row">
                <div class="col">
                    <div class="tab-content top-borber">
                        <!-- 1st tab start -->
                        <div class="tab-pane fade show active" id="tab-product-all">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="{{ url('product/details') }}/{{ $product->slug }}" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/8.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/9.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                                        Tights</a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                    <span class="old">$48.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/10.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-7%</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 90%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4.5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Long
                                                        Sleeve
                                                        Shirts</a></h5>
                                                <span class="price">
                                                    <span class="new">$30.50</span>
                                                    <span class="old">$38.00</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/11.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">Sale</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 70%"></span>
                                                    </span>
                                                    <span class="rating-num">( 3.5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Parrera
                                                        Sunglasses -
                                                        Lomashop</a></h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/3.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                                        Tights</a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                    <span class="old">$48.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/1.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 1st tab end -->
                        <!-- 2nd tab start -->
                        <div class="tab-pane fade" id="tab-product-new">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/8.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/9.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                                        Tights</a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                    <span class="old">$48.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/10.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-7%</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 90%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4.5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Long
                                                        Sleeve
                                                        Shirts</a></h5>
                                                <span class="price">
                                                    <span class="new">$30.50</span>
                                                    <span class="old">$38.00</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/11.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">Sale</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 70%"></span>
                                                    </span>
                                                    <span class="rating-num">( 3.5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Parrera
                                                        Sunglasses -
                                                        Lomashop</a></h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/3.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                                        Tights</a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                    <span class="old">$48.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/1.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 2nd tab end -->
                        <!-- 3rd tab start -->
                        <div class="tab-pane fade" id="tab-product-bestsellers">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/8.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/9.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                                        Tights</a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                    <span class="old">$48.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/10.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-7%</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 90%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4.5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Long
                                                        Sleeve
                                                        Shirts</a></h5>
                                                <span class="price">
                                                    <span class="new">$30.50</span>
                                                    <span class="old">$38.00</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/11.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">Sale</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 70%"></span>
                                                    </span>
                                                    <span class="rating-num">( 3.5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Parrera
                                                        Sunglasses -
                                                        Lomashop</a></h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/3.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                                        Tights</a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                    <span class="old">$48.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/1.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 3rd tab end -->
                        <!-- 4th tab start -->
                        <div class="tab-pane fade" id="tab-product-itemssale">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/8.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/9.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                                        Tights</a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                    <span class="old">$48.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/10.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-7%</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 90%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4.5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Long
                                                        Sleeve
                                                        Shirts</a></h5>
                                                <span class="price">
                                                    <span class="new">$30.50</span>
                                                    <span class="old">$38.00</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/11.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">Sale</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 70%"></span>
                                                    </span>
                                                    <span class="rating-num">( 3.5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Parrera
                                                        Sunglasses -
                                                        Lomashop</a></h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/3.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">( 4 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                                        Tights</a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                    <span class="old">$48.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img src="{{ asset('fronted') }}/images/product-image/1.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 4th tab end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End -->

    <!-- Deal Area Start -->
    <div class="deal-area deal-bg deal-bg-2" data-bg-image="{{ asset('fronted') }}/images/deal-img/deal-bg-2.jpg">
        <div class="container ">
            <div class="row">
                <div class="col-12">
                    <div class="deal-inner position-relative pt-100px pb-100px">
                        <div class="deal-wrapper">
                            <span class="category">#FASHION SHOP</span>
                            <h3 class="title">Deal Of The Day</h3>
                            <div class="deal-timing">
                                <div data-countdown="2021/05/15"></div>
                            </div>
                            <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Shop
                                Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                        </div>
                        <div class="deal-image">
                            <img class="img-fluid" src="{{ asset('fronted') }}/images/deal-img/woman.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal Area End -->
    <!--  Blog area Start -->
    <div class="main-blog-area pb-100px pt-100px">
        <div class="container">
            <!-- section title start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center mb-30px0px">
                        <h2 class="title">#blog</h2>
                        <p class="sub-title">Lorem ipsum dolor sit amet consectetur adipisicing eiusmod.
                        </p>
                    </div>
                </div>
            </div>
            <!-- section title start -->

            <div class="row">
                <div class="col-lg-4 mb-md-30px mb-lm-30px">
                    <div class="single-blog">
                        <div class="blog-image">
                            <a href="blog-single-left-sidebar.html"><img src="{{ asset('fronted') }}/images/blog-image/1.jpg"
                                    class="img-responsive w-100" alt=""></a>
                        </div>
                        <div class="blog-text">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                        aria-hidden="true"></i> 24 Aug, 2021</a>
                                <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                    K</a>
                            </div>
                            <h5 class="blog-heading"><a class="blog-heading-link"
                                    href="blog-single-left-sidebar.html">There are many variations of
                                    passages of Lorem</a></h5>

                            <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                    class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <!-- End single blog -->
                <div class="col-lg-4 mb-md-30px mb-lm-30px">
                    <div class="single-blog ">
                        <div class="blog-image">
                            <a href="blog-single-left-sidebar.html"><img src="{{ asset('fronted') }}/images/blog-image/2.jpg"
                                    class="img-responsive w-100" alt=""></a>
                        </div>
                        <div class="blog-text">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                        aria-hidden="true"></i> 24 Aug, 2021</a>
                                <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                    K</a>
                            </div>
                            <h5 class="blog-heading"><a class="blog-heading-link"
                                    href="blog-single-left-sidebar.html">It is a long established factoi
                                    ader will be distracted</a></h5>

                            <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                    class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <!-- End single blog -->
                <div class="col-lg-4">
                    <div class="single-blog">
                        <div class="blog-image">
                            <a href="blog-single-left-sidebar.html"><img src="{{ asset('fronted') }}/images/blog-image/3.jpg"
                                    class="img-responsive w-100" alt=""></a>
                        </div>
                        <div class="blog-text">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                        aria-hidden="true"></i> 24 Aug, 2021</a>
                                <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                    K</a>
                            </div>
                            <h5 class="blog-heading"><a class="blog-heading-link"
                                    href="blog-single-left-sidebar.html">Contrary to popular belieflo
                                    lorem Ipsum is not</a></h5>


                            <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                    class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <!-- End single blog -->
            </div>
        </div>
    </div>
    <!--  Blog area End -->

   @endsection

   @section('footer_script')
   <script>
        $(document).ready(function(){
            $('#login_check').click(function(){

                if($('#login_status').val() == 'no'){
                    // alert('hi');

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
                }

            })
        })
    </script>
@endsection
   {{-- <script>
        $(document).ready(function(){
                $('.color_plate').click(function(){

            })
        })
   </script> --}}

