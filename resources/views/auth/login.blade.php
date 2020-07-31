@extends('layouts.app')

@section('content')
<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{ url('/') }}">@lang('user.home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>@lang('user.my_account')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger"> {{$error}}</div>
            @endforeach
            @endif
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="kpx_login m-3">
                    <div class="row kpx_row-sm-offset-3 kpx_socialButtons justify-content-center">
                        <div class="col-xs-2 col-sm-2">
                            <a href="{{url('/login/github')}}" class="btn  btn-block kpx_btn-github" data-toggle="tooltip" data-placement="top" title="GitHub">
                              <i class="fa fa-github fa-2x"></i>
                              <span class="hidden-xs"></span>
                            </a>
                          </div>
                        <div class="col-xs-2 col-sm-2">
                          <a href="#" class="btn  btn-block kpx_btn-facebook" data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="fa fa-facebook fa-2x"></i>
                            <span class="hidden-xs"></span>
                          </a>
                        </div>
                        <div class="col-xs-2 col-sm-2">
                          <a href="#" class="btn  btn-block kpx_btn-twitter" data-toggle="tooltip" data-placement="top" title="Twitter">
                            <i class="fa fa-twitter fa-2x"></i>
                            <span class="hidden-xs"></span>
                          </a>
                        </div>
                        <div class="col-xs-2 col-sm-2">
                          <a href="#" class="btn  btn-block kpx_btn-google-plus" data-toggle="tooltip" data-placement="top" title="Google Plus">
                            <i class="fa fa-google-plus fa-2x"></i>
                            <span class="hidden-xs"></span>
                          </a>
                        </div>
                  </div>
                    </div>
                    <div class="type-page hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="customer-login-form">
                                    <span class="or-text">or</span>
                                    <div id="customer_login" class="u-columns col2-set">
                                        <div class="u-column1 col-1">
                                            <h2>@lang('admin.login')</h2>
                                            <form  method="POST" action="{{ route('login') }}" class="woocomerce-form woocommerce-form-login login">
                                                @csrf
                                                <p class="form-row form-row-wide">
                                                    <label for="username">@lang('user.email_address')
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="email" class="input-text" name="email" id="username" value="{{ old('email') }}" />
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label for="password">@lang('admin.password')
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input class="input-text" type="password" name="password" id="password" />
                                                </p>
                                                <p class="form-row">
                                                    <input class="woocommerce-Button button" type="submit" value="Login">
                                                    <label for="rememberme" style="margin-top:20px;" class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox" id="rememberme" /> {{ __('Remember Me') }}
                                                    </label>
                                                </p>
                                                <p class="woocommerce-LostPassword lost_password">
                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a>
                                                    @endif
                                                </p>
                                            </form>
                                            <!-- .woocommerce-form-login -->
                                        </div>
                                        <!-- .col-1 -->
                                        <div class="u-column2 col-2">
                                            <h2>Register</h2>
                                            <form class="register" method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <p class="before-register-text">
                                                    @lang('user.Create_new_account_today_to_reap_the_benefits_of_a_personalized_shopping_experience._Praesent_placerat,_est_sed_aliquet_finibus.')
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label for="reg_name">@lang('admin.name')
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="name" value="{{ old('name') }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="reg_name" class="woocommerce-Input woocommerce-Input--text  input-text @error('name') is-invalid @enderror">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label for="reg_email">@lang('user.email_address')
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="email" value="{{ old('email') }}" id="reg_email" name="email" class="woocommerce-Input woocommerce-Input--text input-text @error('email') is-invalid @enderror">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label for="reg_password">Password
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="password" id="reg_password" name="password" class="woocommerce-Input woocommerce-Input--text input-text @error('password') is-invalid @enderror">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label for="password-confirm">{{ __('Confirm Password') }}
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="password" id="password-confirm" name="password_confirmation" class="woocommerce-Input woocommerce-Input--text input-text">
                                                </p>
                                                <p class="form-row">
                                                    <input type="submit" class="woocommerce-Button button" name="register" value="Register" />
                                                </p>
                                                <div class="register-benefits">
                                                    <h3>@lang('user.Sign_up_today_and_you_will_be_able_to_:')</h3>
                                                    <ul>
                                                        <li>@lang('user.Speed_your_way_through_checkout')</li>
                                                        <li>@lang('user.Track_your_orders_easily')</li>
                                                        <li>@lang('user.Keep_a_record_of_all_your_purchases')</li>
                                                    </ul>
                                                </div>
                                            </form>
                                            <!-- .register -->
                                        </div>
                                        <!-- .col-2 -->
                                    </div>
                                    <!-- .col2-set -->
                                </div>
                                <!-- .customer-login-form -->
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
    <!-- .col-full -->
</div>
<style>
    a{
    color:#ff5400;
}
    a:hover {
    opacity: 0.8;
    color:#ff5400;
    text-decoration:none;
}
.kpx_login .kpx_authTitle {
    text-align: center;
    line-height: 300%;
}

.kpx_login .kpx_socialButtons a {
    color: white; // In yourUse @body-bg
	opacity:0.9;
}
.kpx_login .kpx_socialButtons a:hover {
    color: white;
	opacity:1;
}

.kpx_login .kpx_socialButtons .kpx_btn-facebook {background: #3b5998; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-facebook:hover {background: #172d5e}
.kpx_login .kpx_socialButtons .kpx_btn-facebook:focus {background: #fff; color:#3b5998; border-color: #3b5998;}

.kpx_login .kpx_socialButtons .kpx_btn-twitter {background: #00aced; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-twitter:hover {background: #043d52}
.kpx_login .kpx_socialButtons .kpx_btn-twitter:focus {background: #fff; color:#00aced; border-color: #00aced;}

.kpx_login .kpx_socialButtons .kpx_btn-google-plus {background: #c32f10; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-google-plus:hover {background: #6b1301}
.kpx_login .kpx_socialButtons .kpx_btn-google-plus:focus {background: #fff; color: #c32f10; border-color: #c32f10}

.kpx_login .kpx_socialButtons .kpx_btn-soundcloud {background: #ff8800; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-soundcloud:hover {background: #c73e04}
.kpx_login .kpx_socialButtons .kpx_btn-soundcloud:focus {background: #fff; color: #ff8800; border-color:#ff8800}

.kpx_login .kpx_socialButtons .kpx_btn-github {background: #666666; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-github:hover {background: #333333}
.kpx_login .kpx_socialButtons .kpx_btn-github:focus {background: #fff; color : #666666; border-color: #666666}

.kpx_login .kpx_socialButtons .kpx_btn-steam {background: #878787; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-steam:hover {background: #292929}
.kpx_login .kpx_socialButtons .kpx_btn-steam:focus {background: #fff; color : #878787; border-color: #878787}

.kpx_login .kpx_socialButtons .kpx_btn-pinterest {background: #cc2127; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-pinterest:hover {background: #780004}
.kpx_login .kpx_socialButtons .kpx_btn-pinterest:focus {background: #fff; color: #cc2127; border-color: #cc2127}

.kpx_login .kpx_socialButtons .kpx_btn-vimeo {background: #1ab7ea; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-vimeo:hover {background: #162221}
.kpx_login .kpx_socialButtons .kpx_btn-vimeo:focus {background: #fff; color: #1ab7ea;border-color: #1ab7ea}

.kpx_login .kpx_socialButtons .kpx_btn-lastfm {background: #c3000d; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-lastfm:hover {background: #5e0208}
.kpx_login .kpx_socialButtons .kpx_btn-lastfm:focus {background: #fff; color: #c3000d; border-color: #c3000d}

.kpx_login .kpx_socialButtons .kpx_btn-yahoo {background: #400191; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-yahoo:hover {background: #230052}
.kpx_login .kpx_socialButtons .kpx_btn-yahoo:focus {background: #fff; color: #400191; border-color: #400191}

.kpx_login .kpx_socialButtons .kpx_btn-vk {background: #45668e; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-vk:hover {background: #1a3352}
.kpx_login .kpx_socialButtons .kpx_btn-vk:focus {background: #fff; color: #45668e; border-color: #45668e}

.kpx_login .kpx_socialButtons .kpx_btn-spotify {background: #7ab800; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-spotify:hover {background: #3a5700}
.kpx_login .kpx_socialButtons .kpx_btn-spotify:focus {background: #fff; color: #7ab800; border-color: #7ab800}

.kpx_login .kpx_socialButtons .kpx_btn-linkedin {background: #0976b4; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-linkedin:hover {background: #004269}
.kpx_login .kpx_socialButtons .kpx_btn-linkedin:focus {background: #fff; color: #0976b4; border-color: #0976b4}

.kpx_login .kpx_socialButtons .kpx_btn-stumbleupon {background: #eb4924; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-stumbleupon:hover {background: #943019}
.kpx_login .kpx_socialButtons .kpx_btn-stumbleupon:focus {background: #fff; color: #eb4924; border-color: #eb4924}

.kpx_login .kpx_socialButtons .kpx_btn-tumblr {background: #35465c; -webkit-transition: all 0.5s ease-in-out;
     -moz-transition: all 0.5s ease-in-out;
       -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;}
.kpx_login .kpx_socialButtons .kpx_btn-tumblr:hover {background: #142030}
.kpx_login .kpx_socialButtons .kpx_btn-tumblr:focus {background: #fff; color: #35465c; border-color: #35465c}


.kpx_login .kpx_loginOr {
	position: relative;
	font-size: 1.5em;
	color: #aaa;
	margin-top: 1em;
	margin-bottom: 1em;
	padding-top: 0.5em;
	padding-bottom: 0.5em;
}
.kpx_login .kpx_loginOr .kpx_hrOr {
	background-color: #cdcdcd;
	height: 1px;
	margin-top: 0px !important;
	margin-bottom: 0px !important;
}
.kpx_login .kpx_loginOr .kpx_spanOr {
	display: block;
	position: absolute;
	left: 50%;
	top: -0.6em;
	margin-left: -1.5em;
	background-color: white;
	width: 3em;
	text-align: center;
}

.kpx_login .kpx_loginForm .input-group.i {
	width: 2em;
}
.kpx_login .kpx_loginForm  .help-block {
    color: red;
}


@media (min-width: 768px) {
    .kpx_login .kpx_forgotPwd {
        text-align: right;
		margin-top:10px;
 	}
}
</style>
@endsection
