<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @lang('user.Cart')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="type-page hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class='card mb-3'>
                                    <h2 class='card-header'>@lang('user.Shopping_Cart') ({{count($this->carts)}})</h2>
                                    <div class='card-body'>
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <input type="checkbox" class="check_all"
                                                wire:model='checkAll' />
                                                <span>@lang('user.select_all')</span>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='text-right' >
                                                    @auth
                                                    <div class="actions" colspan="12">
                                                        <div class="coupon">
                                                            <label for="coupon_code">@lang('user.coupon')</label>
                                                            <input type="text" placeholder="@lang('user.Coupon_code')"
                                                                wire:model.lazy='coupon' value="" id="coupon_code"
                                                                class="input-text" name="coupon_code" autocomplete='off'>
                                                            <button type="button" wire:click='CheckCoupon'
                                                                name="apply_coupon"
                                                                class="button">@lang('user.Apply_coupon')</button>
                                                        </div>
                                                        @error('coupon') <span
                                                            class="alert alert-danger">{{ $message }}</span>
                                                        @enderror
                                                        @if($this->message)
                                                        <div class="coupon alert alert-danger">
                                                            {{$this->message}}
                                                        </div>
                                                        @elseif($this->success)
                                                        <div class="coupon alert alert-success">
                                                            {{$this->success}}
                                                        </div>
                                                        @endif
                                                    </td>
                                                    @else
                                                    <td class="actions" colspan="12">
                                                        <div class="coupon">
                                                            @lang('user.Login_to_can_use_your_coupon')
                                                        </div>
                                                    </td>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="cart-wrapper">
                                    <form  action="#" class="woocommerce-cart-form">
                                        @foreach($stores as $store)
                                        <div class='card mb-3'>
                                            <div class='card-header'>
                                                <div class='card-title'>
                                                    <a href='{{route('show_seller', Str::slug($store->name))}}'class='mr-5'
                                                        style='color:#0063D1;'>{{$store->name}}
                                                    </a>
                                                    @if($store->slug)
                                                    <a href='{{route('show_chat', [
                                                        'memberTypeTo'   => 'member',
                                                        'seq'            => Crypt::encrypt($store->seller->id),
                                                        ])}}'
                                                        class='ml-5'>
                                                    <i class='fa fa-envelope-o'></i> @lang('user.contact')
                                                    </a>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class='card-body'>
                                                @if(!empty(session('select')))
                                                    <div class="alert alert-danger" id='error-message'>
                                                        {{ session('select') }}
                                                    </div>
                                                @endif
                                                <table class="shop_table shop_table_responsive cart">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-product"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($this->carts as $cart)
                                                        @php
                                                            $cart_product = $cart->getProduct();
                                                        @endphp
                                                        @if($cart_product->store && $cart_product->store->id === $store->id)
                                                            @php
                                                                $isMethod = $this->isMethod($cart_product);
                                                            @endphp
                                                            <tr class='row'>
                                                                <td class='product-product'>
                                                                    <li class="item list-unstyled">
                                                                        <div class="item-main cf">

                                                                          <div class="item-block ib-info cf">
                                                                            <img class="product-img" src="http://fakeimg.pl/150/e5e5e5/adadad/?text=IMG" />
                                                                            <div class="ib-info-meta">
                                                                              <span class="title">Drink Up Nalgene Water Bottle</span>
                                                                              <span class="itemno">#3498765</span>
                                                                              <span class="styles">
                                                                                <span><strong>Color</strong>: Neon Green</span>
                                                                                <span><strong>Size</strong>: 32oz</span>
                                                                                <span><strong>Warranty</strong>: 3 Years</span>
                                                                                <span class="blue-link">Edit Details</span>
                                                                              </span>
                                                                            </div>
                                                                          </div>
                                                                          <div class="item-block ib-qty">
                                                                            <input type="text" value="3" class="qty" />
                                                                            <span class="price"><span>x</span> $25.00</span>
                                                                          </div>
                                                                          <div class="item-block ib-total-price">
                                                                            <span class="tp-price">$75.00</span>
                                                                            <span class="tp-remove"><i class="i-cancel-circle"></i></span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="item-foot cf">
                                                                          <div class="if-message"><p> Item/promo related messaging shows up here</p></div>
                                                                          <div class="if-left"><span class="if-status">In Stock</span></div>
                                                                          <div class="if-right"><span class="blue-link">Gift Options</span> | <span class="blue-link">Add to Registry</span> | <span class="blue-link">Add to Wishlist</span></div>
                                                                        </div>
                                                                      </li>
                                                                </td>
                                                                {{-- <td class="product-select col-1">
                                                                    <li class="wc-layered-nav-term custom-control custom-checkbox">
                                                                        <input type="checkbox" name="item[]"  class="custom-control-input item_checkbox chb_check{{ $cart->id }}"
                                                                        {{(!blank($isMethod))?'':'value="0" disabled'}}
                                                                        value="{{ $cart->id }}" id="customCheck{{$cart->id}}" data-value='item_checkbox'>
                                                                        <label class="custom-control-label"
                                                                            for="customCheck{{$cart->id}}">{{$cart->name}}</label>
                                                                    </li>
                                                                </td>
                                                                <td class="product-image col-3">
                                                                    <a href="{{route('show_product', $cart_product->slug)}}" target="_blank">
                                                                        <img width="180" height="180" alt=""
                                                                            class="wp-post-image"
                                                                            src="{{Storage::url($cart_product->image)}}">
                                                                    </a>
                                                                </td>
                                                                <td class="product-product col-6">
                                                                    <li class="item">
                                                                        <div class="item-main cf">
                                                                          <div class="item-block ib-info cf">
                                                                            <img class="product-img" src="http://fakeimg.pl/150/e5e5e5/adadad/?text=IMG" />
                                                                            <div class="ib-info-meta">
                                                                              <span class="title">Drink Up Nalgene Water Bottle</span>
                                                                              <span class="itemno">#3498765</span>
                                                                              <span class="styles">
                                                                                <span><strong>Color</strong>: Neon Green</span>
                                                                                <span><strong>Size</strong>: 32oz</span>
                                                                                <span><strong>Warranty</strong>: 3 Years</span>
                                                                                <span class="blue-link">Edit Details</span>
                                                                              </span>
                                                                            </div>
                                                                          </div>
                                                                          <div class="item-block ib-qty">
                                                                            <input type="text" value="3" class="qty" />
                                                                            <span class="price"><span>x</span> $25.00</span>
                                                                          </div>
                                                                          <div class="item-block ib-total-price">
                                                                            <span class="tp-price">$75.00</span>
                                                                            <span class="tp-remove"><i class="i-cancel-circle"></i></span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="item-foot cf">
                                                                          <div class="if-message"><p> Item/promo related messaging shows up here</p></div>
                                                                          <div class="if-left"><span class="if-status">In Stock</span></div>
                                                                          <div class="if-right"><span class="blue-link">Gift Options</span> | <span class="blue-link">Add to Registry</span> | <span class="blue-link">Add to Wishlist</span></div>
                                                                        </div>
                                                                      </li>
                                                                </td>
                                                                <td class="product-select col-2">
                                                                    <a title="Remove this item" class="remove" href="#"
                                                                    wire:click='removeCart({{$cart->id}})'></a>
                                                                </td> --}}
                                                                <{{-- td class="product-select">
                                                                    <li class="wc-layered-nav-term custom-control custom-checkbox">
                                                                        <input type="checkbox" name="item[]"  class="custom-control-input item_checkbox chb_check{{ $cart->id }}"
                                                                        {{(!blank($isMethod))?'':'value="0" disabled'}}
                                                                        value="{{ $cart->id }}" id="customCheck{{$cart->id}}" data-value='item_checkbox'>
                                                                        <label class="custom-control-label"
                                                                            for="customCheck{{$cart->id}}">{{$cart->name}}</label>
                                                                    </li>
                                                                </td>
                                                                <td class="product-thumbnail">
                                                                    <a href="{{route('show_product', $cart_product->slug)}}" target="_blank">
                                                                        <img width="180" height="180" alt=""
                                                                            class="wp-post-image"
                                                                            src="{{Storage::url($cart_product->image)}}">
                                                                    </a>
                                                                </td>
                                                                <td data-title="Product" class="product-name">
                                                                    <div class="media cart-item-product-detail">
                                                                        <a
                                                                            href="{{route('show_product',$cart_product->slug)}}" target="_blank">
                                                                            <img width="180" height="180" alt=""
                                                                                class="wp-post-image"
                                                                                src="{{Storage::url($cart_product->image)}}">
                                                                        </a>
                                                                        <div class="media-body align-self-center">
                                                                            <a
                                                                                href="{{route('show_product',$cart_product->slug)}}" target="_blank"><strong>{{$cart_product->name}}</strong></a><br/><br/>
                                                                                    @if($cart_product->IsVariable())
                                                                                    @foreach($cart->options as $key => $val)
                                                                                    @php
                                                                                        $attribute = App\Attribute::where('id', $val)->first();
                                                                                    @endphp
                                                                                    <span style='font-size:14px;'>
                                                                                        {{($attribute)? $attribute->attribute_family->name . ' : ' . $attribute->name:''}}
                                                                                    </span><br />
                                                                                    @endforeach
                                                                                    @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td data-title="Price" class="product-price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {!! curr($cart->price) !!}
                                                                    </span>
                                                                </td>
                                                                <td class="product-quantity" data-title="Quantity">
                                                                    <div class="quantity">
                                                                        <label>Quantity</label>
                                                                        <input type="number"
                                                                            name="cart[e2230b853516e7b05d79744fbd4c9c13][qty]"
                                                                            wire:change='changeCart($event.target.value, {{$cart->id}})'
                                                                            value="{{$cart->quantity}}" title="Qty"
                                                                            class="input-text qty text" size="4">
                                                                    </div>
                                                                </td>
                                                                <td data-title="shipping" class="product-shipping">
                                                                    @if($this->country)
                                                                    @if(!blank($isMethod))
                                                                    <a onclick:prevent="#" class="text-primary"
                                                                    data-toggle="modal" data-target="#shipping-methods{{$cart->id}}"
                                                                        style="cursor: pointer;">@lang('user.shipping'):
                                                                        @if(isset($this->shippings[$cart->id]))
                                                                        {!!
                                                                        curr($cart_product->calcShipping(\App\Shipping_methods::find($this->shippings[$cart->id]),
                                                                        $cart->quantity)) !!}
                                                                        @endif
                                                                    </a>
                                                                    @else
                                                                    <span class="alert alert-danger" data-toggle="modal"
                                                                        data-target="#exampleModal" style="cursor:pointer;"><i
                                                                            class="fa fa-exclamation-circle"></i></span>
                                                                    @endif
                                                                    @else
                                                                    <a class="shipping-calculator-button go_to_country" style='color:red;' data-toggle="collapse"
                                                                        href="#shipping-form" aria-expanded="false"
                                                                        aria-controls="shipping-form">@lang('user.Calculate_shipping')</a>
                                                                    @endif
                                                                </td>
                                                                <td data-title="Total" class="product-subtotal">
                                                                    {!! curr($cart->price * $cart->quantity) !!}
                                                                </td>
                                                                <td data-title="remove" class="product-select">
                                                                    <a title="Remove this item" class="remove" href="#"
                                                                    wire:click='removeCart({{$cart->id}})'></a>
                                                                </td> --}}
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endforeach
                                        @if(!blank($unknown_stores))
                                        <div class='card mb-3'>
                                            <div class='card-header'>
                                                <div class='card-title'>
                                                    <a href='#'class='mr-5'
                                                        style='color:#0063D1;'>@lang('user.unknown_stores')
                                                    </a>
                                                </div>
                                            </div>
                                            <div class='card-body'>
                                                <table class="shop_table shop_table_responsive cart">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail"></th>
                                                            <th class="product-select"></th>
                                                            <th class="product-name">@lang('user.product')</th>
                                                            <th class="product-price">@lang('user.price')</th>
                                                            <th class="product-quantity">@lang('user.quantity')</th>
                                                            <th class="product-shipping">@lang('user.shipping')</th>
                                                            <th class="product-subtotal">@lang('user.total')</th>
                                                            <th class="product-select"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($unknown_stores as $cart)
                                                        @php
                                                            $cart_product = $cart->getProduct();
                                                        @endphp
                                                        @php
                                                        $isMethod   = $this->isMethod($cart_product);
                                                        @endphp
                                                            <tr>
                                                                <td class="product-select">
                                                                    <li class="wc-layered-nav-term custom-control custom-checkbox">
                                                                        <input type="checkbox" name="item[]"  class="custom-control-input item_checkbox chb_check{{ $cart->id }}"
                                                                        {{(!blank($isMethod) )?'':'value="0" disabled'}}
                                                                        value="{{ $cart->id }}" id="customCheck{{$cart->id}}" data-value='item_checkbox'>
                                                                        <label class="custom-control-label"
                                                                            for="customCheck{{$cart->id}}">{{$cart->name}}</label>
                                                                    </li>
                                                                </td>
                                                                <td class="product-thumbnail">
                                                                    <a href="{{route('show_product', $cart_product->slug)}}" target="_blank">
                                                                        <img width="180" height="180" alt=""
                                                                            class="wp-post-image"
                                                                            src="{{Storage::url($cart_product->image)}}">
                                                                    </a>
                                                                </td>
                                                                <td data-title="Product" class="product-name">
                                                                    <div class="media cart-item-product-detail">
                                                                        <a
                                                                            href="{{route('show_product',$cart_product->slug)}}" target="_blank">
                                                                            <img width="180" height="180" alt=""
                                                                                class="wp-post-image"
                                                                                src="{{Storage::url($cart_product->image)}}">
                                                                        </a>
                                                                        <div class="media-body align-self-center">
                                                                            <a
                                                                                href="{{route('show_product',$cart_product->slug)}}" target="_blank"><strong>{{$cart_product->name}}</strong></a><br/><br/>
                                                                                    @if($cart_product->IsVariable())
                                                                                    @foreach($cart->options as $key => $val)
                                                                                    @php
                                                                                        $attribute = App\Attribute::where('id', $val)->first();
                                                                                    @endphp
                                                                                    <span style='font-size:14px;'>
                                                                                        {{($attribute)? $attribute->attribute_family->name . ' : ' . $attribute->name:''}}
                                                                                    </span><br />
                                                                                    @endforeach
                                                                                    @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td data-title="Price" class="product-price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {!! curr($cart->price) !!}
                                                                    </span>
                                                                </td>
                                                                <td class="product-quantity" data-title="Quantity">
                                                                    <div class="quantity">
                                                                        <label>@lang('user.quantity')</label>
                                                                        <input type="number"
                                                                            name="cart[e2230b853516e7b05d79744fbd4c9c13][qty]"
                                                                            wire:change='changeCart($event.target.value, {{$cart->id}})'
                                                                            value="{{$cart->quantity}}" title="Qty"
                                                                            class="input-text qty text" size="4">
                                                                    </div>
                                                                </td>
                                                                <td data-title="shipping" class="product-shipping">
                                                                    @if($this->country)
                                                                    @if(!blank($isMethod))
                                                                    <a onclick:prevent="#" class="text-primary"
                                                                        data-toggle="modal" data-target="#shipping-methods{{$cart->id}}"
                                                                        {{-- onclick="document.getElementById('id{{$cart->id}}').style.display='block'" --}}
                                                                        style="cursor: pointer;">@lang('user.shipping'):
                                                                        @if(isset($this->shippings[$cart->id]))
                                                                        {!!
                                                                        curr($cart_product->calcShipping(\App\Shipping_methods::find($this->shippings[$cart->id]),
                                                                        $cart->quantity)) !!}
                                                                        @endif
                                                                    </a>
                                                                    @else
                                                                    <span class="alert alert-danger" data-toggle="modal"
                                                                        data-target="#exampleModal" style="cursor:pointer;"><i
                                                                            class="fa fa-exclamation-circle"></i></span>
                                                                    @endif
                                                                    @else
                                                                    <a class="shipping-calculator-button go_to_country" style='color:red;' data-toggle="collapse"
                                                                        href="#shipping-form" aria-expanded="false"
                                                                        aria-controls="shipping-form">@lang('user.Calculate_shipping')</a>
                                                                    @endif
                                                                </td>
                                                                <td data-title="Total" class="product-subtotal">
                                                                    {!! curr($cart->price * $cart->quantity) !!}
                                                                </td>
                                                                <td data-title="remove" class="product-select">
                                                                    <a title="Remove this item" class="remove" href="#"
                                                                    wire:click='removeCart({{$cart->id}})'></a>
                                                                </td>
                                                            </tr>
                                                            @endforeach

                                                            @if(!empty(session()->get('select')))
                                                            <div class="alert alert-danger">
                                                                {{ session()->get('select') }}
                                                            </div>
                                                            @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif
                                        <!-- .shop_table shop_table_responsive -->
                                    </form>
                                    <!-- .woocommerce-cart-form -->
                                    <div class="cart-collaterals" style="position:relative;">
                                        <div class="cart_totals">
                                            <h2>@lang('user.Cart_totals')</h2>
                                            <table class="shop_table shop_table_responsive">
                                                <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>@lang('user.sub_total')</th>
                                                        <td data-title="Subtotal">
                                                            <span class="woocommerce-Price-amount amount">
                                                                {!! curr($this->subTotal) !!}</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="cart-subtotal">
                                                        <th>@lang('user.shipping')</th>
                                                        <td data-title="Subtotal">
                                                            <span class="woocommerce-Price-amount amount">
                                                                {!! curr($this->shipping) !!}</span>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $coupons = 0;
                                                    if(session()->get('coupon') !== null) {
                                                    foreach(session()->get('coupon') as $coupon) {
                                                    if($coupon['is_usd'] === 1) {
                                                    $coupons += $coupon['reward'];
                                                    } else {
                                                    $coupons += $this->total * $coupon['reward'] / 100;
                                                    }
                                                    }
                                                    }
                                                    @endphp
                                                    <tr class="cart-subtotal">
                                                        <th>@lang('user.coupon')</th>
                                                        <td data-title="Subtotal">
                                                            <span class="woocommerce-Price-amount amount">
                                                                {!! curr($coupons) !!}</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>@lang('user.total')</th>
                                                        <td data-title="Total">
                                                            <strong>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    @if($this->total - $coupons < 0) {!! curr(0) !!}
                                                                        @else {!! curr($this->total - $coupons) !!}
                                                                        @endif
                                                                </span>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- .shop_table shop_table_responsive -->

                                            <div class="wc-proceed-to-checkout" id='country_box'>
                                                <form class="woocommerce-shipping-calculator" method="post"
                                                    wire:submit.prevent='SelectCountry' wire:ignore>
                                                    <p>
                                                        <a class="shipping-calculator-button" style='color:red;' data-toggle="collapse"
                                                            href="#shipping-form" aria-expanded="false"
                                                            aria-controls="shipping-form">@lang('user.Calculate_shipping')</a>
                                                    </p>
                                                    <div class="collapse" id="shipping-form">
                                                        <div class="shipping-calculator-form">
                                                            <p id="calc_shipping_country_field"
                                                                class="form-row form-row-wide">
                                                                <select rel="calc_shipping_state"
                                                                    class="country_to_state"
                                                                    id="calc_shipping_country" style="width:100%;"
                                                                    name="calc_shipping_country">
                                                                    <option value="">@lang('user.select_country')
                                                                    </option>
                                                                    @foreach($countries as $country)
                                                                    <option value="{{$country->id}}" {{($country->id  == $this->country)? 'selected' :''}}>
                                                                        {{$country->country_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </p>
                                                            <p>
                                                                <button class="button" name="calc_shipping"
                                                                    type="submit">@lang('user.Update_totals')</button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- .wc-proceed-to-checkout -->
                                                <button
                                                    class="checkout-button button alt wc-forward {{($this->disabled)?'disabled':''}}"
                                                    {{($this->disabled)?'disabled':''}} wire:click='proceed_to_checkout'
                                                    style='width: 100%;'>
                                                    @lang('user.Proceed_to_checkout')</button>

                                                <a class="back-to-shopping" href="{{route('shop')}}">@lang('user.Back_to_Shopping')</a>
                                                @error('country') <span class="alert alert-danger">{{ $message }}</span>
                                                @enderror

                                                <div id="loading" wire:loading>
                                                    <div class="loader"></div>
                                                </div>
                                            </div>

                                            <!-- .wc-proceed-to-checkout -->
                                        </div>
                                        <!-- .cart_totals -->
                                    </div>
                                    <!-- .cart-collaterals -->
                                </div>
                                <!-- .cart-wrapper -->
                            </div>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .entry-content -->
                    </div>
                    <!-- .hentry -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
        </div>
        <!-- .row -->
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('user.shipping')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        @lang("user.This_item_is_not_available,_because_the_seller_doesn't_provide_delivery_to_the_shipping_address_you_selected.")
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- .col-full -->
    @foreach($this->carts as $cart)
    @php
    $cart_product = $cart->getProduct();
    @endphp
    <div class="modal fade bd-example-modal-lg" id="shipping-methods{{$cart->id}}" wire:ignore>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent='changeShipping(Object.fromEntries(new FormData($event.target)), {{$cart->id}})'>
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">@lang('user.shipping')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('user.Estimated_Delivery')</th>
                                <th>@lang('user.cost')</th>
                                <th>@lang('user.tracking')</th>
                                <th>@lang('user.shipping_method')</th>
                                <th>@lang('user.carrier')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $isMethod = $this->isMethod($cart_product);
                            @endphp

                                @if(!blank($isMethod))
                                @foreach($isMethod as $method)
                                <tr>
                                    <td>
                                        <li class="wc-layered-nav-term custom-control custom-checkbox">
                                            <input type="radio" name="radio{{$cart->id}}" class="custom-control-input item_checkboxRadio chb{{ $cart->id }}"
                                            value="{{$method->id}}"
                                            id="customRadio{{$method->id}}" data-value='item_checkboxRadio'
                                            {{(isset($this->shippings[$cart->id]) && $this->shippings[$cart->id] == $method->id)?'checked':''}}>
                                            <label class="custom-control-label"
                                                for="customRadio{{$method->id}}">{{$cart->name}}</label>
                                        </li>

                                    </td>
                                    <td>
                                        1 day
                                    </td>
                                    <td>
                                        @lang('user.shipping') {!! curr($cart_product->calcShipping($method, $cart->quantity)) !!}
                                    </td>
                                    <td>
                                        <i class='fa fa-check-circle fa-2x' style='color:#0063D1'></i>
                                    </td>
                                    <td>
                                        {{$method->name}}
                                    </td>
                                    <td>
                                        {{$method->shippingcompany->name}}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"
                    >@lang('user.save')</button>
                    <button type="button" class="btn btn-danger"
                    data-dismiss="modal">@lang('user.Close')</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- The Modal -->
@push('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $('.country_to_state').select2();
    $('.country_to_state').on('change', function (e) {
        @this.set('country', e.target.value);
    });

    $(window).resize(function(){

        if ($(window).width() <= 720) {

            $('.go_to_country').on('click', function () {
                $('html, body').animate({
                scrollTop: $("#country_box").offset().top - 250
                }, 1000);
            });
        }

    });

    if ($(window).width() <= 720) {

        $('.go_to_country').on('click', function () {
            $('html, body').animate({
            scrollTop: $("#country_box").offset().top - 250
            }, 1000);
        });
    }
    $('.check_all').on('click', function () {
        $('input[data-value="item_checkbox"]:checkbox').each(function () {
            if ($('input[class="check_all"]:checkbox:checked').length == 0) {
                $(this).prop('checked', false);
            } else {
                $(this).prop('checked', true);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        @foreach($this->carts as $indx => $cart)
        if ($(".chb{{$cart->id}}").is(':checked')) {
            @this.set('shippings.{{$cart->id}}', $(".chb{{$cart->id}}").val());
        }
        $(".chb_check{{$cart->id}}").change(function (e) {
            if ($(this).prop('disabled')) {
                $(this).prop('checked', false);
                @this.set('items.{{$cart->id}}', '');
            } else {
                if ($(".chb_check{{$cart->id}}").is(':checked')) {
                    @this.set('items.{{$cart->id}}', e.target.value);
                } else {
                    @this.set('items.{{$cart->id}}', '');
                }
            }
        });
        @endforeach

    });

</script>
@endpush
<style>
    #loading {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #EEEEEE;
        opacity: 0.8;
        top: 0;
        right:{{$direction === 'right'? '-50%':''}};
        left: 50%;
        -ms-transform: translateX(-50%) -webkit-transform: translateX(-50%);
        transform: translateX(-50%)
    }

    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        margin: 20% auto;

    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    .custom-control-input:active~.custom-control-label::before {
        color: #fff;
        background-color: #b3d7ff;
    }
    .custom-control-label::before {
        width: 1.5rem;
        height: 1.5rem;
        border: 1px solid #ccc;
        background-color: #fff;
    }
    .custom-control-label::after {
        width: 1.5rem;
        height: 1.5rem;
}
.item {
	 border-bottom: 1px solid #ccc;
	 margin-bottom: 10px;
}
 .item:last-child {
	 border-bottom: none;
	 padding-bottom: 0;
	 margin-bottom: 0;
}
 .item .item-block {
	 float: left;
}
 .item .item-block.ib-info {
	 width: 60%;
}
 .item .item-block.ib-info img.product-img {
	 float: left;
	 display: block;
	 width: 100px;
	 margin-right: 15px;
}
 .item .item-block.ib-info .ib-info-meta {
	 float: left;
}
 .item .item-block.ib-info span {
	 display: block;
	 margin-bottom: 3px;
}
 .item .item-block.ib-info span.title {
	 font-size: 1em;
}
 .item .item-block.ib-info span.itemno {
	 color: #888;
	 font-size: 0.8em;
}
 .item .item-block.ib-info span.styles {
	 border-left: 3px solid rgba(0, 0, 0, .1);
	 padding-left: 5px;
	 font-size: 0.8em;
}
 .item .item-block.ib-info span.styles strong {
	 display: inline-block;
	 min-width: 70px;
}
 .item .item-block.ib-info span.styles .blue-link {
	 font-size: 0.8em;
}
 .item .item-block.ib-qty {
	 width: 20%;
	 text-align: right;
}
 .item .item-block.ib-qty input {
	 text-align: center;
	 font-size: 16px;
	 border-radius: 0;
	 outline: none;
	 border: 1px solid #ccc;
	 width: 50px;
	 height: 40px;
	 vertical-align: middle;
	 color: #555;
}
 .item .item-block.ib-qty input:focus {
	 border-color: #7bcde8;
}
 .item .item-block.ib-qty span.price {
	 display: inline-block;
	 color: #777;
}
 .item .item-block.ib-qty span.price > span {
	 margin: 0 5px;
}
 .item .item-block.ib-total-price {
	 width: 20%;
	 text-align: right;
	 padding-top: 6px;
	 position: relative;
}
 .item .item-block.ib-total-price span {
	 color: #555;
}
 .item .item-block.ib-total-price span.tp-price {
	 font-size: 1.4em;
	 font-weight: 900;
}
 .item .item-block.ib-total-price span.tp-remove {
	 font-size: 14px;
	 margin-left: 10px;
	 position: relative;
	 top: -2px;
	 cursor: pointer;
}
 .item .item-block.ib-total-price span.tp-remove:hover {
	 color: red;
}
 .item .item-foot {
	 padding: 0 0 10px 0;
	 margin-top: 10px;
	 font-size: 0.7em;
}
 .item .item-foot i {
	 position: relative;
	 font-size: 12px;
}
 .item .item-foot .if-message {
	 float: left;
	 width: 100%;
	 margin-bottom: 10px;
	 color: #777;
}
 .item .item-foot .if-left {
	 float: left;
	 color: #ccc;
	 font-size: 115%;
	 text-transform: uppercase;
}
 .item .item-foot .if-right {
	 float: right;
	 color: #ccc;
	 padding-top: 2px;
	 text-transform: uppercase;
}
 .item .item-foot .if-status {
	 font-weight: 900;
	 color: #333;
}
 .item .bundle-block {
	 padding: 0 0 10px 50px;
	 position: relative;
}
 .item .bundle-block ul li {
	 position: relative;
	 display: block;
	 width: 100%;
	 margin-top: 10px;
	 padding-top: 5px;
}
 .item .bundle-block ul li i.i-down-right-arrow {
	 display: block;
	 position: absolute;
	 left: -30px;
	 font-size: 12px;
	 top: 50%;
	 margin-top: -6px;
	 color: #999;
}
 .item .bundle-block ul li img {
	 width: 100%;
	 max-width: 48px;
	 display: block;
	 float: left;
	 margin-right: 15px;
}
 .item .bundle-block ul li span {
	 display: block;
}
 .item .bundle-block ul li span.bundle-title {
	 font-size: 0.85em;
}
 .item .bundle-block ul li span.bundle-itemno {
	 color: #888;
	 font-size: 0.7em;
}

</style>
