<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @lang('user.Checkout')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div class="content-area" id="primary">
                <main class="site-main" id="main">
                    <div class="type-page hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                @guest
                                <div class="woocommerce-info">@lang('user.Returning_customer?') <a
                                        data-toggle="collapse" href="#login-form" aria-expanded="false"
                                        aria-controls="login-form"
                                        class="showlogin">@lang('user.Click_here_to_login')</a>
                                </div>
                                <div class="collapse" id="login-form">
                                    {!! Form::open(['url' => route('login'), 'method' => 'post', 'class' =>
                                    'woocomerce-form woocommerce-form-login login']) !!}
                                    <p class="form-row form-row-first">
                                        <label for="username">@lang('user.email')
                                            <span class="required">*</span>
                                        </label>
                                        <input type="email" name="email" id="username" value="{{ old('email') }}"
                                            class="input-text">
                                        @if ($errors->has('email'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                            style="display: block;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                        @endif
                                    </p>
                                    <p class="form-row form-row-last">
                                        <label for="password">@lang('user.password')
                                            <span class="required">*</span>
                                        </label>
                                        <input type="password" id="password" name="password" class="input-text">
                                        @if ($errors->has('password'))
                                        <div id="password-error" class="error text-danger pl-3" for="email"
                                            style="display: block;">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                        @endif
                                    </p>
                                    <div class="clear"></div>
                                    <p class="form-row">
                                        <input class="woocommerce-Button button" type="submit" value="Login">
                                        <label for="rememberme" style="margin-top:20px;"
                                            class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                            <input class="woocommerce-form__input woocommerce-form__input-checkbox"
                                                name="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox"
                                                id="rememberme" /> {{ __('Remember Me') }}
                                        </label>
                                    </p>
                                    <p class="woocommerce-LostPassword lost_password">
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </p>
                                    <div class="clear"></div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- .collapse -->
                                @endguest
                                <div class="woocommerce-info">@lang('user.Have_a_coupon?') <a data-toggle="collapse"
                                        href="#checkoutCouponForm" aria-expanded="false"
                                        aria-controls="checkoutCouponForm"
                                        class="showlogin">@lang('user.Click_here_to_enter_your_code')</a>
                                </div>
                                <div class="collapse" id="checkoutCouponForm" wire:ignore.self>
                                    <div class="checkout_coupon">
                                        <p class="form-row form-row-first">
                                            <input type="text" value="" id="coupon_code" wire:model.lazy='coupon'
                                                placeholder="@lang('user.Coupon_code')" class="input-text"
                                                name="coupon_code" autocomplete='off'>
                                        </p>
                                        <p class="form-row form-row-last">
                                            <input type="submit" value="@lang('user.Apply_coupon')"
                                                wire:click='CheckCoupon' name="apply_coupon" class="button">
                                        </p>
                                        <div class="clear"></div>
                                    </div>
                                    @error('coupon') <span class="alert alert-danger">{{ $message }}</span> @enderror
                                    @if($this->message)
                                    <div class="coupon alert alert-danger">
                                        {{$this->message}}
                                    </div>
                                    @elseif($this->success)
                                    <div class="coupon alert alert-success">
                                        {{$this->success}}
                                    </div>
                                    @endif
                                </div>
                                @if($errors->any())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-danger"> {{$error}}</div>
                                @endforeach
                                @endif
                                <!-- .collapse -->

                                <div class='row justify-content-center text-center'>
                                    @if($setting)
                                    @if($setting->paypal)
                                    <a class='col-md-2 m-2 {{$this->payment === 'paypal'? 'active_payment':''}}' style='border:1px solid #e8e8e8'
                                         href='{{route('show_checkout', ['payment' => 'paypal'])}}'>@lang('user.pay_with_paypal')
                                            <div  class=''>
                                                <img class="payment-icon-image " style='width: 92px;margin: auto;' src="{{url('/')}}/FrontEnd/images/credit-cards/paypal.svg" alt="paypal" />
                                            </div>
                                        </a>
                                        @endif
                                        @if($setting->stripe)
                                    <a class='col-md-2 m-2 {{$this->payment === 'stripe'? 'active_payment':''}}' style='border:1px solid #e8e8e8' href='{{route('show_checkout', ['payment' => 'stripe'])}}'>@lang('user.pay_with_card')
                                        <div  class='row'>
                                            <img class="payment-icon-image" style='width: 75px;margin: auto;' src="{{url('/')}}/FrontEnd/images/credit-cards/mastercard.svg" alt="mastercard" />
                                            <img class="payment-icon-image" style='width: 75px;margin: auto;' src="{{url('/')}}/FrontEnd/images/credit-cards/visa.svg" alt="visa" />
                                            <img class="payment-icon-image" style='width: 75px;margin: auto;' src="{{url('/')}}/FrontEnd/images/credit-cards/maestro.svg" alt="maestro" />
                                        </div>
                                    </a>
                                    @endif
                                    @endif
                                </div>
                                {!! Form::open(['url' => route('payment'), 'class' => 'checkout
                                woocommerce-checkout',
                                'method' => 'post', 'id' => 'payment-form']) !!}
                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="woocommerce-billing-fields">
                                            <h3>@lang('user.Billing_Details')</h3>
                                            <div class="woocommerce-billing-fields__field-wrapper-outer">
                                                <div class="woocommerce-billing-fields__field-wrapper">
                                                    <p id="billing_first_name_field"
                                                        class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field">
                                                        <label class=""
                                                            for="billing_first_name">@lang('user.First_Name')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text"
                                                            value="{{old('billing_first_name', Auth::check()?auth()->user()->name:'')}}"
                                                            placeholder="@lang('user.First_Name')"
                                                            id="billing_first_name" name="billing_first_name"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="billing_last_name_field"
                                                        class="form-row form-row-last validate-required">
                                                        <label class="" for="billing_last_name">@lang('user.Last_Name')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text"
                                                        value="{{old('billing_last_name', Auth::check() ? auth()->user()->last_name:'')}}"
                                                        placeholder="@lang('user.Last_Name')" id="billing_last_name"
                                                            name="billing_last_name" class="input-text ">
                                                    </p>
                                                    <div class="clear"></div>
                                                    <p id="billing_country_field"
                                                        class="form-row form-row-wide validate-required validate-email">
                                                        <label class="" for="billing_country">@lang('user.country')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <select autocomplete="country"
                                                            class="country_to_state country_select select2-hidden-accessible"
                                                            id="billing_country" name="billing_country" tabindex="-1"
                                                            aria-hidden="true">
                                                            @foreach(\App\Country::all() as $country)
                                                            <option value="{{$country->id}}"
                                                                {{(Auth::check() && auth()->user()->country_id === $country->id)?'selected':''}}>
                                                                {{$country->country_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                    <div class="clear"></div>
                                                    <p id="billing_address_1_field"
                                                        class="form-row form-row-wide address-field validate-required">
                                                        <label class=""
                                                            for="billing_address_1">@lang('user.Street_address')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text"
                                                            value="{{old('billing_address_1', Auth::check()?auth()->user()->address : '')}}"
                                                            placeholder="@lang('user.Street_address')"
                                                            id="billing_address_1" name="billing_address_1"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="billing_address_2_field"
                                                        class="form-row form-row-wide address-field">
                                                        <input type="text" value=""
                                                            placeholder="@lang('user.Apartment,_suite,_unit_etc._(optional)')"
                                                id="billing_address_2" name="billing_address_2" value="{{old('billing_address_2')}}"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="billing_city_field"
                                                        class="form-row form-row-wide address-field validate-required"
                                                        data-o_class="form-row form-row form-row-wide address-field validate-required">
                                                        <label class="" for="billing_city">@lang('user.Town_City')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text"
                                                            value="{{old('billing_city', Auth::check()?auth()->user()->city : '')}}"
                                                            placeholder="" id="billing_city" name="billing_city"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="shipping_state_field"
                                                        class="form-row form-row-wide address-field validate-state woocommerce-invalid woocommerce-invalid-required-field validate-required"
                                                        data-o_class="form-row form-row-wide address-field validate-required validate-state woocommerce-invalid woocommerce-invalid-required-field">
                                                        <label class="" for="shipping_state">@lang('user.State')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" autocomplete="address-level2"
                                                            value="{{old('billing_state', Auth::check()?auth()->user()->state : '')}}"
                                                            placeholder="@lang('user.State')" id="states"
                                                            name="billing_state" class="input-text ">
                                                    </p>
                                                    <p id="billing_postcode_field"
                                                        class="form-row form-row-wide address-field validate-postcode validate-required"
                                                        data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode">
                                                        <label class=""
                                                            for="billing_postcode">@lang('user.Postcode_ZIP')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text"
                                                            value="{{old('billing_state', Auth::check()?auth()->user()->postcode : '')}}"
                                                            placeholder="@lang('user.Postcode_ZIP')"
                                                            id="billing_postcode" name="billing_postcode"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="billing_phone_field"
                                                        class="form-row form-row-last validate-required validate-phone">
                                                        <label class="" for="billing_phone">@lang('user.Phone')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="tel"
                                                            value="{{old('billing_phone', Auth::check()?auth()->user()->phone : '')}}"
                                                            placeholder="@lang('user.Phone')" id="billing_phone"
                                                            name="billing_phone" class="input-text ">
                                                    </p>
                                                    <p id="billing_email_field"
                                                        class="form-row form-row-first validate-required validate-email">
                                                        <label class="" for="billing_email">@lang('user.Email_Address')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="email"
                                                            value="{{old('billing_phone', Auth::check()?auth()->user()->email : '')}}"
                                                            placeholder="@lang('user.Email_Address')" id="billing_email"
                                                            name="billing_email" class="input-text ">
                                                    </p>

                                                </div>
                                            </div>
                                            <!-- .woocommerce-billing-fields__field-wrapper-outer -->
                                        </div>
                                        <!-- .woocommerce-billing-fields -->
                                        @guest
                                        <div class="woocommerce-account-fields">
                                            <p class="form-row form-row-wide woocommerce-validated">
                                                <label
                                                    class="collapsed woocommerce-form__label woocommerce-form__label-for-checkbox checkbox"
                                                    data-toggle="collapse" data-target="#createLogin"
                                                    aria-controls="createLogin">
                                                    <input type="checkbox" value="1" name="createaccount"
                                                        class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox">
                                                    <span>@lang('user.Create_an_account?')</span>
                                                </label>
                                            </p>

                                            <div class="create-account collapse" id="createLogin">
                                                <p data-priority="" id="account_password_field"
                                                    class="form-row validate-required woocommerce-invalid woocommerce-invalid-required-field">
                                                    <label class=""
                                                        for="account_password">@lang('usre.Account_password')
                                                        <abbr title="required" class="required">*</abbr>
                                                    </label>
                                                    <input type="password" value="" placeholder="@lang('user.password')"
                                                        id="account_password" name="account_password"
                                                        class="input-text ">
                                                </p>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        @endguest
                                        <!-- .woocommerce-account-fields -->
                                    </div>

                                    <!-- .col-1 -->
                                    <div class="col-2">
                                        <div class="woocommerce-shipping-fields">
                                            <h3 id="ship-to-different-address">
                                                <label
                                                    class="collapsed woocommerce-form__label woocommerce-form__label-for-checkbox checkbox"
                                                    data-toggle="collapse" data-target="#shipping-address"
                                                    aria-controls="shipping-address">
                                                    <input id="ship-to-different-address-checkbox"
                                                        class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                                                        type="checkbox" value="{{old('ship_to_different_address')}}" name="ship_to_different_address">
                                                    <span>@lang('user.Ship_to_a_different_address?')</span>
                                                </label>
                                            </h3>
                                            <div class="shipping_address collapse" id="shipping-address">
                                                <div class="woocommerce-shipping-fields__field-wrapper">
                                                    <p id="shipping_first_name_field"
                                                        class="form-row form-row-first validate-required">
                                                        <label class=""
                                                            for="shipping_first_name">@lang('user.First_Name')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" autofocus="autofocus"
                                                            autocomplete="given-name" value="{{old('shipping_first_name')}}"
                                                            placeholder="@lang('user.First_Name')"
                                                            id="shipping_first_name" name="shipping_first_name"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="shipping_last_name_field"
                                                        class="form-row form-row-last validate-required">
                                                        <label class="" for="shipping_last_name">@lang('user.Last_Name')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" autocomplete="family-name" value="{{old('shipping_last_name')}}"
                                                            placeholder="@lang('user.Last_Name')"
                                                            id="shipping_last_name" name="shipping_last_name"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="shipping_country_field"
                                                        class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                        <label class="" for="shipping_country">@lang('user.country')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <select autocomplete="country"
                                                            class="country_to_state country_select select2-hidden-accessible"
                                                            id="shipping_country" name="shipping_country" tabindex="-1"
                                                            aria-hidden="true" value='{{old('shipping_country')}}'>
                                                            @foreach(\App\Country::all() as $country)
                                                            <option value="{{$country->id}}">{{$country->country_name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                    <p id="shipping_address_1_field"
                                                        class="form-row form-row-wide address-field validate-required">
                                                        <label class=""
                                                            for="shipping_address_1">@lang('user.Street_address')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" autocomplete="address-line1" value="{{old('shipping_address_1')}}"
                                                            placeholder="@lang('user.House_number_and_street_name')"
                                                            id="shipping_address_1" name="shipping_address_1"
                                                            class="input-text " >
                                                    </p>
                                                    <p id="shipping_address_2_field"
                                                        class="form-row form-row-wide address-field">
                                                        <input type="text" autocomplete="address-line2" value="{{old('shipping_address_2')}}"
                                                            placeholder="@lang('user.Apartment,_suite,_unit_etc._(optional)')"
                                                            id="shipping_address_2" name="shipping_address_2"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="shipping_city_field"
                                                        class="form-row form-row-wide address-field validate-required"
                                                        data-o_class="form-row form-row-wide address-field validate-required">
                                                        <label class="" for="shipping_city">@lang('user.Town_City')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" autocomplete="address-level2" value="{{old('shipping_city')}}"
                                                            placeholder="@lang('user.Town_City')" id="shipping_city"
                                                            name="shipping_city" class="input-text ">
                                                    </p>
                                                    <p id="shipping_state_field"
                                                        class="form-row form-row-wide address-field validate-state woocommerce-invalid woocommerce-invalid-required-field validate-required"
                                                        data-o_class="form-row form-row-wide address-field validate-required validate-state woocommerce-invalid woocommerce-invalid-required-field">
                                                        <label class="" for="shipping_state">@lang('user.State')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" autocomplete="address-level2" value="{{old('shipping_state')}}"
                                                            placeholder="@lang('user.State')" id="states"
                                                            name="shipping_state" class="input-text ">
                                                    </p>
                                                    <p data-priority="90" id="shipping_postcode_field"
                                                        class="form-row form-row-wide address-field validate-postcode validate-required"
                                                        data-o_class="form-row form-row-wide address-field validate-required validate-postcode">
                                                        <label class=""
                                                            for="shipping_postcode">@lang('user.Postcode_ZIP')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" autocomplete="postal-code" value="{{old('shipping_postcode')}}"
                                                            placeholder="" id="shipping_postcode"
                                                            name="shipping_postcode" class="input-text ">
                                                    </p>
                                                    <p id="shipping_phone_field"
                                                        class="form-row form-row-last validate-required validate-phone">
                                                        <label class="" for="shipping_phone">@lang('user.Phone')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="tel" value="{{old('shipping_phone')}}" placeholder="@lang('user.Phone')"
                                                            id="shipping_phone" name="shipping_phone"
                                                            class="input-text ">
                                                    </p>
                                                    <p id="shipping_email_field"
                                                        class="form-row form-row-first validate-required validate-email">
                                                        <label class="" for="shipping_email">@lang('user.Email_Address')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="email" value="{{old('shipping_email')}}"
                                                            placeholder="@lang('user.Email_Address')"
                                                            id="shipping_email" name="shipping_email"
                                                            class="input-text ">
                                                    </p>
                                                </div>
                                                <!-- .woocommerce-shipping-fields__field-wrapper -->
                                            </div>
                                            <!-- .shipping_address -->
                                        </div>
                                        <!-- .woocommerce-shipping-fields -->
                                        <div class="woocommerce-additional-fields">
                                            <div class="woocommerce-additional-fields__field-wrapper">
                                                <p id="order_comments_field" class="form-row notes">
                                                    <label class=""
                                                        for="order_comments">@lang('user.Order_notes')</label>
                                                    <textarea cols="5" rows="2" value="{{old('order_comments')}}"
                                                        placeholder="@lang('user.Notes_about_your_order,_e.g._special_notes_for_delivery.')"
                                                        id="order_comments" class="input-text "
                                                        name="order_comments"></textarea>
                                                </p>
                                            </div>
                                            <!-- .woocommerce-additional-fields__field-wrapper-->
                                        </div>
                                        <!-- .woocommerce-additional-fields -->
                                    </div>
                                    <!-- .col-2 -->
                                </div>
                                <!-- .col2-set -->
                                <h3 id="order_review_heading">@lang('user.Your_order')</h3>
                                <div class="woocommerce-checkout-review-order" id="order_review">
                                    <div class="order-review-wrapper">
                                        <h3 class="order_review_heading">@lang('user.Your_order')</h3>
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">@lang('user.product')</th>
                                                    <th class="product-total">@lang('user.total')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(session()->get('items') !== null)
                                                @foreach(session()->get('items') as $cart)
                                                @php
                                                $cc = Cart::content()->find($cart['item']);
                                                $findSHipping = \App\Shipping_methods::where('id', $cart['shipping'])->first();
                                                if($findSHipping !== null) {
                                                    $this->shippings +=
                                                    $cc->buyable->calcShipping($findSHipping,
                                                    $cc->quantity);
                                                } else {
                                                    $defaultShipping = \App\Setting::orderBy('id','desc')->first();
                                                    if($defaultShipping->default_shipping == 1) {
                                                        $this->shippings +=
                                                        $cc->buyable->calcShipping($defaultShipping->shipping,
                                                        $cc->quantity);
                                                    }
                                                }
                                                $this->subtotal += $cc->price * $cc->quantity;
                                                @endphp
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <strong class="product-quantity">{{intval($cc->quantity)}}
                                                            ×</strong> {!! curr($cc->price) !!}" {{$cc->buyable->name}}
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount">
                                                            {!! curr($cc->price * $cc->quantity) !!}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @elseif(Cart::content()->isEmpty())

                                                @else
                                                @foreach(Cart::content() as $cart)
                                                @php
                                                $findSHipping = $cart->buyable->methods->first();
                                                if($findSHipping !== null) {
                                                    $this->shippings +=
                                                    $cart->buyable->calcShipping($findSHipping,
                                                    $cart->quantity);
                                                } else {
                                                    $defaultShipping = \App\Setting::orderBy('id','desc')->first();
                                                    if($defaultShipping->default_shipping == 1) {
                                                        $this->shippings +=
                                                        $cart->buyable->calcShipping($defaultShipping->shipping,
                                                        $cart->quantity);
                                                    }
                                                }
                                                $this->subtotal += $cart->price * $cart->quantity;
                                                @endphp
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <strong class="product-quantity">{{intval($cart->quantity)}}
                                                            ×</strong> {!! curr($cart->price) !!}"
                                                        {{$cart->buyable->name}}
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount">
                                                            {!! curr($cart->price * $cart->quantity) !!}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>@lang('user.subtotal')</th>
                                                    <td>
                                                        <span class="woocommerce-Price-amount amount">
                                                            {!! curr($this->subtotal) !!}</span>
                                                    </td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th>@lang('user.shippings')</th>
                                                    <td>
                                                        <span class="woocommerce-Price-amount amount">
                                                            {!! curr($this->shippings) !!}</span>
                                                    </td>
                                                </tr>
                                                @php
                                                    if(session()->get('coupon') !== null) {
                                                        foreach(session()->get('coupon') as $coupon) {
                                                        if($coupon['is_usd'] === 1) {
                                                            $this->coupons += $coupon['reward'];
                                                        } else {
                                                             $this->coupons += ($this->subtotal + $this->shippings) * $coupon['reward'] / 100;
                                                        }
                                                    }
                                                }
                                                @endphp
                                                <tr class="cart-subtotal">
                                                    <th>@lang('user.coupon')</th>
                                                    <td>
                                                        <span class="woocommerce-Price-amount amount">
                                                            {!! curr($this->coupons) !!}</span>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>@lang('user.total')</th>
                                                    <td>
                                                        <strong>
                                                            <span class="woocommerce-Price-amount amount">
                                                                {!! curr($this->subtotal - $this->coupons + $this->shippings)
                                                                !!}</span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <!-- /.woocommerce-checkout-review-order-table -->
                                        <div class="woocommerce-checkout-payment" id="payment">
                                            @if($setting)
                                            <ul class="wc_payment_methods payment_methods methods">
                                                @if($setting->stripe && $this->payment === 'stripe')
                                                <li class="wc_payment_method payment_method_bacs">
                                                    <input type="radio" data-order_button_text="" checked="checked"
                                                        value="card" name="payment_method"
                                                        class="input-radio" id="payment_method_bacs">
                                                    <label for="payment_method_bacs">@lang('user.pay_with_card')</label>

                                                </li>
                                                @endif
                                                @if($setting->paypal && $this->payment === 'paypal')
                                                <li class="wc_payment_method payment_method_cheque">
                                                    <input type="radio" data-order_button_text=""  value="paypal" checked="checked"
                                                        name="payment_method" class="input-radio"
                                                        id="payment_method_cheque">
                                                    <label
                                                        for="payment_method_cheque">@lang('user.pay_with_paypal')</label>

                                                </li>
                                                @endif
                                            </ul>
                                            @endif
                                            <div class="form-row place-order" id='orders'>
                                                <p class="form-row terms wc-terms-and-conditions woocommerce-validated" style="margin-bottom: 15px;">
                                                    <label
                                                        class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                                        <input type="checkbox" id="terms" name="terms"
                                                            class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" required>
                                                        <span>@lang('user.I’ve_read_and_accept_the') <a
                                                                class="woocommerce-terms-and-conditions-link"
                                                                href="{{route('terms-and-conditions')}}">@lang('user.terms_&amp;conditions')</a></span>
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="hidden" value="1" name="terms-field">
                                                </p>
                                                <ul class="list-payment-icons nav justify-content-center" style="margin: 14px;">
                                                    <li class="nav-item" style="width:25%;">
                                                        <img class="payment-icon-image" src="{{url('/')}}/FrontEnd/images/credit-cards/mastercard.svg" alt="mastercard" />
                                                    </li>
                                                    <li class="nav-item" style="width:25%;">
                                                        <img class="payment-icon-image" src="{{url('/')}}/FrontEnd/images/credit-cards/visa.svg" alt="visa" />
                                                    </li>
                                                    <li class="nav-item" style="width:25%;">
                                                        <img class="payment-icon-image" src="{{url('/')}}/FrontEnd/images/credit-cards/paypal.svg" alt="paypal" />
                                                    </li>
                                                    <li class="nav-item" style="width:25%;">
                                                        <img class="payment-icon-image" src="{{url('/')}}/FrontEnd/images/credit-cards/maestro.svg" alt="maestro" />
                                                    </li>
                                                </ul>
                                                @if($setting && $setting->stripe)
                                                <div class="form-row" id="stripePayment" wire:ignore>
                                                    <label for="card-element">
                                                      @lang('user.Credit_or_debit_card')
                                                    </label>
                                                    <div id="card-element">
                                                      <!-- A Stripe Element will be inserted here. -->
                                                    </div>

                                                    <!-- Used to display form errors. -->
                                                    <div id="card-errors" role="alert"></div>
                                                </div>
                                                @endif
                                                <input type="submit" value="@lang('user.buy')"
                                                    class="button wc-forward text-center">
                                            </div>

                                        </div>
                                        <!-- /.woocommerce-checkout-payment -->
                                    </div>
                                    <!-- /.order-review-wrapper -->
                                </div>
                                <!-- .woocommerce-checkout-review-order -->
                                {!! Form::close() !!}
                                <!-- .woocommerce-checkout -->
                            </div>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .entry-content -->
                    </div>
                    <!-- #post-## -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</div>
@if($setting && $setting->stripe && $this->payment === 'stripe')
@push('js')
  <script src="https://js.stripe.com/v3/"></script>
  <script>

  var stripe = Stripe('pk_test_7Jhph2iY4AnOx3zXz1dLAcJP00k3I2hjjO');

  // Create an instance of Elements.
  var elements = stripe.elements();

  // Custom styling can be passed to options when creating an Element.
  // (Note that this demo uses a wider set of styles than the guide below.)
  var style = {
    base: {
      color: '#32325d',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: '#aab7c4'
      }
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };

  // Create an instance of the card Element.
  var card = elements.create('card', {style: style});

  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');

  // Handle real-time validation errors from the card Element.
  card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  // Handle form submission.
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
      if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
      }
    });
  });

  // Submit the form with the token ID.
  function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
  }

/*   $(document).ready(function(){
    $('.wc_payment_method input[type="radio"]').on('change', function () {
    if($(this).val() === 'paypal') {
        $('#stripePayment').appendTo('#stripes');
    } else {
        $('#stripePayment').appendTo('#orders');
    }
  });
}); */
  </script>
  @endpush
  @endif
  @push('css')

  <style>
      /**
   * The CSS shown here will not be introduced in the Quickstart guide, but shows
   * how you can use CSS to style your Element's container.
   */
  .StripeElement {
      width:100%;
    box-sizing: border-box;

    height: 40px;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
  }

  .StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
  }

  .StripeElement--invalid {
    border-color: #fa755a;
  }

  .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
  }
  .active_payment {
    border: 1px solid red !important;
    background: rgb(61, 156, 210, .2)  !important;
  }
  </style>
  @endpush
