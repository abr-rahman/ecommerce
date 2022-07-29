@extends('layouts.frontend')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Cart Area Start -->
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row" id="cart_main_section">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sub_total = 0;
                                    @endphp

                                    @forelse($carts as $cart)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img class="img-responsive ml-15px"
                                                    src="{{ asset('upload/pro_thumbnail_photo') }}/{{ $cart->relationtoproduct->pro_thumbnail_photo }}" alt="" /></a>
                                        </td>
                                        <td class="product-name">
                                            {{ $cart->relationtoproduct->product_name }}
                                            <p>Color: {{ $cart->relationtocolor->color_name }}</p>
                                            <p>Size: {{ $cart->relationtosize->size_name }}</p>
                                        </td>
                                        <td class="product-price-cart">
                                            <span class="amount">
                                                {{ $cart->product_current_price }}
                                            </span>
                                        </td>

                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <span class="d-none">{{ $cart->id }}</span>
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                                    value="{{ $cart->cart_amount }}" />
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            {{ $cart->product_current_price *  $cart->cart_amount }}
                                            @php
                                                $sub_total += ( $cart->product_current_price *  $cart->cart_amount );
                                            @endphp
                                        </td>
                                        <td class="product-remove">
                                            {{-- <a href="{{ route('cart.remove', $cart->id) }}"> --}}
                                            <a id="{{ $cart->id}}" class="cart_item_delete">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="55" class="text-center">
                                                <h2 class="text-danger">This Item Proccesing Now</h2>
                                            </td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{ route('index')}}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <button>Update Shopping Cart</button>
                                        <a href="#">Clear Shopping Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="cart-tax">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                                </div>
                                <div class="tax-wrapper">
                                    <p>Enter your destination to get a shipping estimate.</p>
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <label>
                                                * Country
                                            </label>
                                            <select class="email s-email s-wid" id="country_droupdown">
                                                <option>>--Select One--<</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->country_id }}">{{ $country->relationtoCountry->name }}  </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="tax-select">
                                            <label>
                                                * Region / State
                                            </label>
                                            <select class="text-danger email s-email s-wid font-weight-bold" id="city_droupdown" disabled>
                                                <option value="">>--Select One--<</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>

                                        <input type="text" id="coupon_input_field" class="" placeholder="Country & City Select Please!" disabled/>
                                        <div id="error_field" class="alert text-danger d-none">

                                        </div>
                                        <button id="apply_coupon_btn" class="d-none cart-btn-2" type="button">Apply Coupon</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-md-30px">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Sub Total<span id="sub_total">{{ $sub_total }}</span></h5>
                                <h5>Shipping Charge (+)<span id="shipping_charge">0</span></h5>
                                <h5>Discount Tyoe<span id="discount_type">-</span></h5>
                                <h5>Discount Price (-)<span id="discount_amount">0</span></h5>

                                <h4 class="grand-totall-title">Grand Total <span id="grand_total">{{ $sub_total }}</span></h4>
                                <a id="checkout_btn" href="{{ route('chekout') }}" class="d-none">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->

@endsection


@section('footer_script')
    <script>
       $(document).ready(function(){
            $('.cart_item_delete').click(function(){
                var cart_id = $(this).attr('id');

                 //ajax start
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                   // url: :"{{ route('cart.remove') }}",
                    url: '/cart/remove',
                    data: {cart_id:cart_id},

                    success: function(data){
                        // $('#cart_main_section').load(" #cart_main_section > *");

                        Swal.fire(
                                'Cart item remove successfully!',
                                'Important!',
                                'Success'
                        )
                        location.reload();
                    }
                });
                //ajax end
            });

            $('.inc').click(function(){
                    var cart_id = $(this).parent().find("span").html();

                    //ajax start
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                   // url: :"{{ route('cart.remove') }}",
                    url: '/cart/inc',
                    data: {cart_id:cart_id},

                    success: function(data){
                        // $('#cart_main_section').load(" #cart_main_section > *");

                        Swal.fire(
                            'Cart item added successfully!',
                            'Important!',
                            'success'
                        )
                        location.reload();
                    }
                });
                //ajax end

            });

            $('.dec').click(function(){
                    var cart_id = $(this).parent().find("span").html();

                    //ajax start
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                   // url: :"{{ route('cart.remove') }}",
                    url: '/cart/dec',
                    data: {cart_id:cart_id},

                    success: function(data){
                        // $('#cart_main_section').load(" #cart_main_section > *");

                        Swal.fire(
                            'Cart item remove successfully!',
                            'Important!',
                            'success'
                        )
                        location.reload();
                    }
                });
                //ajax end

            });

            // Country city section start

            $('#country_droupdown').change(function(){
                var country_id = $(this).val();
                $('#shipping_charge').html(0);
                $('#discount_amount').html(0);
                $('#discount_type').html('');
                $('#coupon_input_field').html('');
                $('#checkout_btn').addClass('d-none');
                $('#grand_total').html($('#sub_total').html());

                //ajax start
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                   // url: :"{{ route('cart.remove') }}",
                    url: '/get/city/list',
                    data: {country_id:country_id},

                    success: function(data){
                        // alert(data);
                        $('#city_droupdown').html(data);
                        $('#city_droupdown').attr('disabled', false);
                        $('#city_droupdown').removeClass('text-danger');
                        $('#city_droupdown').addClass('text-success');

                    }
                });
                //ajax end

            });

            $('#city_droupdown').change(function(){
                // alert($(this).val());
                $('#shipping_charge').html($(this).val());
                $('#checkout_btn').removeClass('d-none');

                var sub_total = $('#sub_total').html();
                var shipping_charge = $(this).val();
                var discount_amount = $('#discount_amount').html();
                $('#coupon_input_field').attr('disabled', false);
                var grand_total = parseInt(sub_total) + parseInt(shipping_charge) - parseInt(discount_amount);
                $('#grand_total').html(grand_total);

                var country_id = $('#country_droupdown :selected').val();
                var city_name = $(this).children("option:selected").html();

                 //ajax start
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                   // url: :"{{ route('cart.remove') }}",
                    url: '/set/country/city',
                    data: {country_id:country_id, city_name:city_name},

                    success: function(data){
                        // alert('session set');
                    }
                });
                //ajax end

            });

                // Country city section end

                // Coupon section start

            $('#coupon_input_field').keyup(function(){
                $('#apply_coupon_btn').removeClass('d-none');
            });

            $('#apply_coupon_btn').click(function(){
                var coupon_name = $('#coupon_input_field').val();
                var sub_total = {{ $sub_total }};

               //ajax start
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                   // url: :"{{ route('cart.remove') }}",
                    url: '/chek/coupon',
                    data: {coupon_name:coupon_name, sub_total:sub_total},

                    success: function(data){
                        if(data.error){
                            $('#error_field').removeClass('d-none');
                            $('#error_field').html(data.error);
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'This is invalid coupon!',
                            showConfirmButton: false,
                            timer: 1000
                            })
                        }else{
                            $('#error_field').addClass('d-none');
                            $('#discount_amount').html(data.coupon_amount);
                            $('#discount_type').html(data.coupon_type);
                            var shipping_charge = $('#shipping_charge').html();
                            $('#grand_total').html(data.grand_total + parseInt(shipping_charge));

                            Swal.fire({
                            icon: 'success',
                            title: 'Coupon added successfully',
                            showConfirmButton: false,
                            timer: 1500
                            })
                        }
                    }
                });
                //ajax end

            });

                                // Coupon section end

       });
    </script>
@endsection




