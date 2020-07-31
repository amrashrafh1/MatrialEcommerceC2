@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<ul id="site-header-cart" class="site-header-cart menu">
    <li class="animate-dropdown dropdown ">
        <a class="cart-contents" href="cart.html" data-toggle="dropdown" title="View your shopping cart">
            <i class="tm tm-shopping-bag"></i>
            <span class="count">{{ count($carts) }}</span>
            <span class="amount">
                            <span class="price-label">@lang('user.your_cart')</span>{!! curr(Cart::subTotal()) !!}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-mini-cart">
            <li>
                <div class="widget woocommerce widget_shopping_cart">
                    <div class="widget_shopping_cart_content">
                        <ul class="woocommerce-mini-cart cart_list product_list_widget">
                            @foreach ($carts as $cart)

                                @if($cart->buyable->IsVariable())
                                    <li class="woocommerce-mini-cart-item mini_cart_item">
                                        <a href="#" class="remove" wire:click='removeCart({{$cart->id}})' aria-label="Remove this item" data-product_id="65" data-product_sku="">×</a>
                                        <a href="{{route('show_product',$cart->buyable->slug)}}">
                                            <img src="{{ Storage::url($cart->buyable->image) }}" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">{{ $cart->buyable->name }}&nbsp;
                                        </a>
                                        <span class="quantity">
                                            @foreach($cart->options as $key =>$opt)
                                            {{$key}} : {{$opt}}<br/>
                                            @endforeach
                                        </span>
                                        <span class="quantity">{{ $cart->quantity }} ×
                                            <span class="woocommerce-Price-amount amount">
                                                {!! curr($cart->price) !!}</span>
                                        </span>
                                    </li>

                                    @else
                                    <li class="woocommerce-mini-cart-item mini_cart_item">
                                        <a href="#" class="remove" wire:click='removeCart({{$cart->id}})' aria-label="Remove this item" data-product_id="65" data-product_sku="">×</a>
                                        <a href="{{route('show_product',$cart->buyable->slug)}}">
                                            <img src="{{ Storage::url($cart->buyable->image) }}" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">{{ $cart->buyable->name }}&nbsp;
                                        </a>
                                        <span class="quantity">{{ $cart->quantity }} ×
                                            <span class="woocommerce-Price-amount amount">
                                                {!! curr($cart->price) !!}</span>
                                        </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <!-- .cart_list -->
                        <p class="woocommerce-mini-cart__total total">
                            <strong>@lang('user.subtotal'):</strong>
                            <span class="woocommerce-Price-amount amount">
                                {!! curr(Cart::subTotal()) !!}</span>
                        </p>
                        <p class="woocommerce-mini-cart__buttons buttons">
                            <a href="{{route('show_cart')}}" class="button wc-forward">@lang('user.View-cart')</a>
                            <a href="{{route('show_checkout')}}" class="button checkout wc-forward">Checkout</a>
                        </p>
                    </div>
                    <!-- .widget_shopping_cart_content -->
                </div>
                <!-- .widget_shopping_cart -->
            </li>
        </ul>
        <!-- .dropdown-menu-mini-cart -->
    </li>
</ul>
<!-- .site-header-cart -->

