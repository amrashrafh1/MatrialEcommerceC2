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
    <link rel="stylesheet" type="text/css" href="{{url('')}}/FrontEnd/css/style.css" media="all" />
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
    <link rel="shortcut icon" href="{{\App\Setting::latest('id')->first()?Storage::url(\App\Setting::latest('id')->first()->icon):''}}">
    @livewireAssets
@stack('css')
</head>

