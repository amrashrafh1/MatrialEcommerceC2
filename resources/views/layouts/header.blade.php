<!DOCTYPE html>
<html lang="{{LaravelLocalization::setLocale()}}" itemscope="itemscope" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" itemtype="http://schema.org/WebPage">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/font-awesome.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/bootstrap-grid.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/bootstrap-reboot.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/font-techmarket.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/slick.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/techmarket-font-awesome.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/slick-style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/animate.min.css" media="all" />
    @if(LaravelLocalization::getCurrentLocaleDirection() === 'rtl')
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/style-rtl.min.css" media="all" />
    @else
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/style.min.css" media="all" />
    @endif
    @auth
    @role('seller')
    <!-- 3. AddChat JS -->
    <!-- Modern browsers -->
    <link href="{{ asset('assets/addchat/css/addchat.min.css') }}" rel="stylesheet">
    @endrole
    @endauth
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/colors/blue.css" media="all" />

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,900" rel="stylesheet">
    <link rel="shortcut icon" href="{{$setting?Storage::url($setting->icon):''}}">
    @livewireStyles
    <style>
        #botmanWidgetRoot > div{
            min-width: 100px !important;
            min-height: 120px !important;
        }
        #shop-loading {
        position  : absolute;
        width     : 100%;
        height    : 100%;
        background: #999;
        opacity   : 0.8;
        top       : 0;
        left      : 0;
        right     : 0;
        bottom    : 0;
        z-index   : 9999;

    }
    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width        : 120px;
        height       : 120px;
        animation    : spin 2s linear infinite;
        margin       : 20% auto;

    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    .yith-wcwl-add-to-wishlist a {
        position: absolute;
        @if($direction === 'right')
        left:0;
        @else
        right:0;
        @endif
        top     : 0px;
        cursor  : pointer;
    }
    .product_shipping {
        height: 16px;
    margin-bottom: 2px;
    font-size: 12px;
    line-height: 16px;
    color: #666;
    }
    @media (max-width: 767px) {
        .handheld-header .custom-logo-link svg {
            max-width:135px !important;
            min-width: 135px !important;
        }
    }
    </style>
@stack('css')
</head>

