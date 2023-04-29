<div class="shopping-item">
    <div class="dropdown-cart-header">
        <span>2 Items</span>
        <a href="cart.html">View Cart</a>
    </div>
    <ul class="shopping-list">
        @foreach ($items as $itme)
            <li>
                <a href="javascript:void(0)" class="remove" title="Remove this item"><i class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="{{ route('products.show', $itme->product->slug) }}"><img
                            src="{{ $itme->product->image_url }}" alt="#" /></a>
                </div>
                <div class="name">
                    <h4>
                        <a href="product-details.html">{{ $itme->product->name }}</a>
                    </h4>
                    <p class="quantity">
                        1x - <span class="amount">{{ $itme->quantity }}</span>
                    </p>
                </div>
            </li>
        @endforeach

    </ul>

    <div class="bottom">
        <div class="total">
            <span>Total</span>
            <span class="total-amount">{{ currency::format($total) }}</span>
        </div>
        <div class="button">
            <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
        </div>
    </div>
</div>
