<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
        <img src="{{ $pro->image_url }}" alt="image product">
        @if ($pro->sale_percent)
            <span class="sale-tag">%{{ $pro->sale_percent }}</span>
        @endif
        <div class="button">
            <a href="{{ route('products.show', $pro->slug) }}" class="btn"><i class="lni lni-cart"></i> Add to
                Cart</a>
        </div>
    </div>2
    <div class="product-info">
        <span class="category">{{ $pro->categore->name }}</span>
        <h4 class="title">
            <a href="{{ route('products.show', $pro->slug) }}">{{ $pro->name }}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{ $pro->price }}</span>
            @if ($pro->compare_price)
                {
                <span class="discount-price">{{ $pro->compare_price }}</span>
                }
            @endif
        </div>
    </div>

    <!-- End Single Product -->
</div>
