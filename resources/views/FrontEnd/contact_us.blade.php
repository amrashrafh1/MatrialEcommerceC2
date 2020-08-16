@extends('layouts.app')

@section('content')
<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @lang('user.Compare')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="type-page hentry">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <div class="alert alert-danger"> {{$error}}</div>
                            @endforeach
                        @endif
                        @if(session()->get('success'))
                            <div class="alert alert-success"> {{session()->get('success')}}</div>
                        @endif
                        <header class="entry-header">
                            <div class="page-header-caption">
                                <h1 class="entry-title">@lang('user.Contact_Us')</h1>
                            </div>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-block">
                                        <h2 class="contact-page-title">@lang('user.Leave_us_a_Message')</h2>
                                    </div>
                                    <div class="contact-form">
                                        <div role="form" class="wpcf7" id="wpcf7-f425-o1" lang="en-US" dir="ltr">
                                            <div class="screen-reader-response"></div>
                                        <form class="wpcf7-form" novalidate="novalidate" method='post' action='{{route('contact_us_store')}}'>
                                                @csrf
                                                <div style="display: none;">
                                                    <input type="hidden" name="_wpcf7" value="425" />
                                                    <input type="hidden" name="_wpcf7_version" value="4.5.1" />
                                                    <input type="hidden" name="_wpcf7_locale" value="en_US" />
                                                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f425-o1" />
                                                    <input type="hidden" name="_wpnonce" value="e6363d91dd" />
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-xs-12 col-md-6">
                                                        <label>@lang('user.name')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <br>
                                                        <span class="wpcf7-form-control-wrap first-name">
                                                            <input type="text" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text"  value="{{old('name')}}" name="name">
                                                        </span>
                                                    </div>
                                                    <!-- .col -->
                                                    <div class="col-xs-12 col-md-6">
                                                        <label>@lang('user.email')
                                                            <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <br>
                                                        <span class="wpcf7-form-control-wrap last-name">
                                                            <input type="email" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text"  value="{{old('email')}}" name="email">
                                                        </span>
                                                    </div>
                                                    <!-- .col -->
                                                </div>
                                                <!-- .form-group -->
                                                <div class="form-group">
                                                    <label>@lang('user.mobile')</label>
                                                    <br>
                                                    <span class="wpcf7-form-control-wrap mobile">
                                                        <input type="text" aria-invalid="false" class="wpcf7-form-control wpcf7-validates-as-required wpcf7-text input-text"  value="{{old('mobile')}}" name="mobile">
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label>@lang('user.subject')</label>
                                                    <br>
                                                    <span class="wpcf7-form-control-wrap subject">
                                                        <input type="text" aria-invalid="false" class="wpcf7-form-control wpcf7-validates-as-required wpcf7-text input-text"  value="{{old('subject')}}" name="subject">
                                                    </span>
                                                </div>
                                                <!-- .form-group -->
                                                <div class="form-group">
                                                    <label>@lang('user.your_message')</label>
                                                    <br>
                                                    <span class="wpcf7-form-control-wrap your-message">
                                                    <textarea aria-invalid="false" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" rows="10" cols="40" name="message">{{old('message')}}</textarea>
                                                    </span>
                                                </div>
                                                <div class="form-group" style="display: none;">
                                                    <label for="faxonly">Fax Only
                                                     <input type="checkbox" name="faxonly" id="faxonly"/>
                                                    </label>
                                                </div>
                                                <!-- .form-group-->
                                                <div class="form-group clearfix">
                                                    <p>
                                                        <input type="submit" value="@lang('user.Send_Message')" class="wpcf7-form-control wpcf7-submit" />
                                                    </p>
                                                </div>
                                                <!-- .form-group-->
                                                <div class="wpcf7-response-output wpcf7-display-none"></div>
                                            </form>
                                            <!-- .wpcf7-form -->
                                        </div>
                                        <!-- .wpcf7 -->
                                    </div>
                                    <!-- .contact-form7 -->
                                </div>
                                <!-- .col -->
                                <div class="col-md-6 store-info store-info-v2">
                                    <div class="google-map">
                                        <iframe height="288" allowfullscreen="" style="border:0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2481.593303940039!2d-0.15470444843858283!3d51.53901886611164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761ae62edd5771%3A0x27f2d823e2be0249!2sPrincess+Rd%2C+London+NW1+8JR%2C+UK!5e0!3m2!1sen!2s!4v1458827996435"></iframe>
                                    </div>
                                    <!-- .google-map -->

                                    <div class="kc-elm kc-css-773435 kc_text_block">
                                        <h2 class="contact-page-title">@lang('user.Our_Address')</h2>
                                        <p>{{$setting->location}}
                                            <br> @lang('user.support:') {{$setting->mobile}}
                                            <br> @lang('user.email:') <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                                        </p>

                                    </div>
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- .row -->
                        </div>
                        <!-- .entry-header -->
                    </div>
                    <!-- .hentry -->
                </main>
                <!-- #main -->
            </div>
        </div>
    </div>
</div>

@endsection


