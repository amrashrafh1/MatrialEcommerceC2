<div class="product">
    <div class="yith-wcwl-add-to-wishlist">
        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
    </div>
    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
        <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224" height="197" class="wp-post-image" alt="">
        <span class="price">
                @if(isset($this->product->discount))
                <ins>
                    <span class="amount">{!! curr($this->product->priceDiscount()) !!}</span>
                </ins>
                <del>
                    <span class="amount">{!! curr($this->product->sale_price) !!}</span>
                </del>
                @else
                <ins>
                    <span class="amount">{!! curr($this->product->sale_price) !!}</span>
                </ins>
                @endif
            </span>
        <!-- /.price -->
        <h2 class="woocommerce-loop-product__title">{!! $this->product->name !!}</h2>
    </a>
    <div class="hover-area">
        @if($this->product->IsVariable())
        <a class="button add_to_cart_button" href='{{url('/'. $this->product->slug)}}' rel="nofollow">Add to cart</a>
            <a class="add-to-compare-link" href="compare.html">Add to compare</a>
            @else
            <a class="button add_to_cart_button" wire:click='addCart({{$this->product->id}})' rel="nofollow">Add to cart</a>
            <div wire:loading>
                Processing Payment...
            </div>
            <a class="add-to-compare-link" href="compare.html">Add to compare</a>
            @endif
    </div>
</div>
