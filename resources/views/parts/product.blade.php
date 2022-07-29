<div class="product">
    <div class="thumb">
        <a href="{{ url('product/details') }}/{{ $product->slug }}" class="image">
            <img src="{{ asset('upload/pro_thumbnail_photo') }}/{{ $product->pro_thumbnail_photo }}" alt="Product" />
        </a>
        <span class="badges">

                @if (App\Models\Inventory::where('product_id', $product->id)->sum('quantity_id') == 0)
                    <span class="sale">Stock Out</span>
                @endif


            @if ($product->dicsounted_price != $product->regular_price)
                <span class="sale">
                    {{ 100- round(($product->dicsounted_price/$product->regular_price) * 100, 1) }} %
                </span>
            @endif

            @if(today()->diffindays($product->created_at) < 6)
                <span class="new">New</span>
            @endif

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
        <a href="{{ url('product/details') }}/{{ $product->slug }}" title="Add To Cart" class=" add-to-cart">Details</a>
    </div>
    <div class="content">
        @php
            $reviews = App\Models\Review::where('product_id', $product->id)->get();
            if($reviews->average('rating')){
                $average_rating = $reviews->average('rating');
            }else {
                $average_rating = 0;
            }
            // echo $average_rating;
            $final_star = ((100*$average_rating)/5);
        @endphp
        <span class="ratings">
            <span class="rating-wrap">
                <span class="star" style="width: {{ $final_star}}%"></span>
            </span>
            <span class="rating-num">( {{ $reviews->count() }} Review )</span>
        </span>

        <h5 class="title"><a href="{{ url('product/details') }}/{{ $product->slug }}">{{ $product->product_name }}</a>
        </h5>
        <span class="price">
                <span class="text-success new">{{ $product->dicsounted_price }}</span>
            @if ($product->dicsounted_price != $product->regular_price)
                <span class="text-danger old">{{ $product->regular_price }}</span>
            @endif

        </span>
    </div>
</div>
