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
                                <div class="cart-wrapper">
                                    <form method="post" action="#" class="woocommerce-cart-form">
                                        <table class="shop_table shop_table_responsive cart">
                                            <thead>
                                                <tr>
                                                    <th class="product-seller">@lang('user.seller')</th>
                                                    <th class="product-select">
                                                        <input type="checkbox" class="check_all"
                                                            wire:model='checkAll' />
                                                        <span>@lang('user.select_all')</span>
                                                    </th>
                                                    <th class="product-thumbnail"></th>
                                                    <th class="product-name">@lang('user.product')</th>
                                                    <th class="product-options">@lang('user.options')</th>
                                                    <th class="product-price">@lang('user.price')</th>
                                                    <th class="product-quantity">@lang('user.quantity')</th>
                                                    <th class="product-shipping">@lang('user.shipping')</th>
                                                    <th class="product-subtotal">@lang('user.total')</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach(Cart::content() as $cart)
                                                @php
                                                $country_id = $this->country;
                                                $isMethod = [];
                                                if($country_id) {
                                                $isMethod = $cart->buyable->methods()->whereHas('zone', function
                                                ($query) use($country_id){
                                                $query->whereHas('countries', function ($q) use($country_id){
                                                $q->where('id', $country_id);
                                                });
                                                })->get();
                                                if(count($isMethod) <= 0) {
                                                    $defaultShipping=\App\Setting::orderBy('id','desc')->first();
                                                    if($defaultShipping->default_shipping == 1) {
                                                    if($defaultShipping->shipping !== null) {
                                                    $isDefaultMethod =
                                                    $defaultShipping->shipping()->whereHas('zone',function ($q) use
                                                    ($country_id){
                                                    $q->whereHas('countries', function ($query) use ($country_id) {
                                                    $query->where('id',$country_id);
                                                    });
                                                    })->first();

                                                    }
                                                    }
                                                    }
                                                    }
                                                    @endphp
                                                    <tr>
                                                        <td data-title="seller" class="product-seller">
                                                            {{$cart->buyable->seller->name}}
                                                        </td>
                                                        <td class="product-select">
                                                            <input type="checkbox" name="item[]"
                                                                data-value='item_checkbox'
                                                                class="item_checkbox chb_check{{ $cart->id }}"
                                                                {{(count($isMethod) > 0 || !empty($isDefaultMethod))?'':'value="0" disabled'}}
                                                                value="{{ $cart->id }}">
                                                        </td>
                                                        <td class="product-thumbnail">
                                                            <a href="{{route('show_product', $cart->buyable->slug)}}">
                                                                <img width="180" height="180" alt=""
                                                                    class="wp-post-image"
                                                                    src="{{Storage::url($cart->buyable->image)}}">
                                                            </a>
                                                        </td>
                                                        <td data-title="Product" class="product-name">
                                                            <div class="media cart-item-product-detail">
                                                                <a
                                                                    href="{{route('show_product',$cart->buyable->slug)}}">
                                                                    <img width="180" height="180" alt=""
                                                                        class="wp-post-image"
                                                                        src="{{Storage::url($cart->buyable->image)}}">
                                                                </a>
                                                                <div class="media-body align-self-center">
                                                                    <a
                                                                        href="{{route('show_product',$cart->buyable->slug)}}">{{$cart->buyable->name}}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="product-options">
                                                            @if($cart->buyable->IsVariable())
                                                            @foreach($cart->options as $key => $val)
                                                            <strong>
                                                                {{$key}} : {{$val}}
                                                            </strong><br />
                                                            @endforeach
                                                            @endif
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
                                                            @if(count($isMethod) > 0)
                                                            <a onclick:prevent="#" class="text-primary"
                                                                onclick="document.getElementById('id{{$cart->id}}').style.display='block'"
                                                                style="cursor: pointer;">@lang('user.shipping'):
                                                                @if(isset($this->shippings[$cart->id]))
                                                                {!!
                                                                curr($cart->buyable->calcShipping(\App\Shipping_methods::find($this->shippings[$cart->id]),
                                                                $cart->quantity)) !!}
                                                                @endif
                                                            </a>
                                                            @elseif(!empty($isDefaultMethod))
                                                            <a onclick:prevent="#" class="text-primary"
                                                                onclick="document.getElementById('id{{$cart->id}}').style.display='block'"
                                                                style="cursor: pointer;">@lang('user.shipping'):
                                                                @if(isset($this->shippings[$cart->id]))
                                                                {!! curr($cart->buyable->calcShipping($isDefaultMethod,
                                                                $cart->quantity)) !!}
                                                                @endif
                                                            </a>
                                                            @else
                                                            <span class="alert alert-danger" data-toggle="modal"
                                                                data-target="#exampleModal" style="cursor:pointer;"><i
                                                                    class="fa fa-exclamation-circle"></i></span>
                                                            @endif
                                                            @else
                                                            <a class="shipping-calculator-button" data-toggle="collapse"
                                                                href="#shipping-form" aria-expanded="false"
                                                                aria-controls="shipping-form">@lang('user.Calculate_shipping')</a>
                                                            @endif
                                                        </td>
                                                        <td data-title="Total" class="product-subtotal">
                                                            {!! curr($cart->price * $cart->quantity) !!}
                                                            <a title="Remove this item" class="remove" href="#"
                                                                wire:click='removeCart({{$cart->id}})'>×</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @if(!empty(session()->get('select')))
                                                    <div class="alert alert-danger">
                                                        {{ session()->get('select') }}
                                                    </div>
                                                    @endif
                                                    <tr>
                                                        @auth
                                                        <td class="actions" colspan="12">
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
                                                    </tr>
                                            </tbody>
                                        </table>
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

                                            <div class="wc-proceed-to-checkout">
                                                <form class="woocommerce-shipping-calculator" method="post"
                                                    wire:submit.prevent='SelectCountry' wire:ignore>
                                                    <p>
                                                        <a class="shipping-calculator-button" data-toggle="collapse"
                                                            href="#shipping-form" aria-expanded="false"
                                                            aria-controls="shipping-form">@lang('user.Calculate_shipping')</a>
                                                    </p>
                                                    <div class="collapse" id="shipping-form">
                                                        <div class="shipping-calculator-form">
                                                            <p id="calc_shipping_country_field"
                                                                class="form-row form-row-wide">
                                                                <select rel="calc_shipping_state"
                                                                    class="country_to_state" wire:model='country'
                                                                    id="calc_shipping_country" style="width:100%;"
                                                                    name="calc_shipping_country">
                                                                    <option value="">@lang('user.select_country')
                                                                    </option>

                                                                    @foreach(\App\Country::select('id',
                                                                    'country_name')->get() as $country)
                                                                    <option value="{{$country->id}}">
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
                                                    style='    width: 100%;'>
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
    @foreach(Cart::content() as $cart)
    <div class="modal" id="id{{$cart->id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Shipping</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('user.cost')</th>
                                <th>@lang('user.carrier')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $country_id = $this->country;
                            $method_countries = $cart->buyable->methods()->whereHas('zone',function ($q) use
                            ($country_id){
                            $q->whereHas('countries', function ($query) use ($country_id) {
                            $query->where('id',$country_id);
                            });
                            })->get();
                            if(count($method_countries) <= 0) { $defaultShipping=\App\Setting::orderBy('id','desc')->
                                first();
                                if($defaultShipping->default_shipping == 1) {
                                if($defaultShipping->shipping !== null) {
                                $default_method = $defaultShipping->shipping()->whereHas('zone',function ($q) use
                                ($country_id){
                                $q->whereHas('countries', function ($query) use ($country_id) {
                                $query->where('id',$country_id);
                                });
                                })->first();
                                }

                                }
                                }
                                @endphp

                                @if(count($method_countries) > 0)
                                @foreach($method_countries as $method_index => $method)
                                <tr>
                                    <td>
                                        <input type="radio" name="radio{{$cart->id}}" class="chb{{$cart->id}}"
                                            wire:click='$set("shippings.{{$cart->id}}", {{$method->id}})'
                                            value="{{$cart->buyable->calcShipping($method, $cart->quantity)}}"
                                            {{(isset($this->shippings[$cart->id]) && $this->shippings[$cart->id] == $cart->buyable->calcShipping($method, $cart->quantity))?'checked':''}} />
                                    </td>
                                    <td>
                                        {!! curr($cart->buyable->calcShipping($method, $cart->quantity)) !!}
                                    </td>
                                    <td>
                                        {{$method->name}}
                                    </td>
                                </tr>
                                @endforeach
                                @elseif(!empty($default_method))
                                <tr>
                                    <td>
                                        <input type="radio" name="radio{{$cart->id}}" class="chb{{$cart->id}}"
                                            wire:click='$set("shippings.{{$cart->id}}", {{$default_method->id}})'
                                            value="{{$cart->buyable->calcShipping($default_method, $cart->quantity)}}"
                                            {{(isset($this->shippings[$cart->id]) && $this->shippings[$cart->id] == $cart->buyable->calcShipping($default_method, $cart->quantity))?'checked':''}} />
                                    </td>
                                    <td>
                                        {!! curr($cart->buyable->calcShipping($default_method, $cart->quantity)) !!}
                                    </td>
                                    <td>
                                        {{$default_method->name}}
                                    </td>
                                </tr>
                                @endif
                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        onclick="document.getElementById('id{{$cart->id}}').style.display='none'">Close</button>
                </div>

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
        @foreach(Cart::content() as $indx => $cart)
        /* $(".chb{{$cart->id}}").change(function(e) {
            $(".chb{{$cart->id}}").prop('checked', false);
            $(this).prop('checked', true);
           @this.set('shippings.{{$cart->id}}','');
           @this.set('shippings.{{$cart->id}}', e.target.value);
        }); */
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

</style>
