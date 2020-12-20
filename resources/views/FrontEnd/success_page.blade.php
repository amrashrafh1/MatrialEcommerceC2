<!DOCTYPE html>
<html lang="{{LaravelLocalization::setLocale()}}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('user.Payment_Complete')</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
</head>

<body>

    <div class="bg">

        <div class="card">

            <span class="card__success"><i class="fa fa-check"></i></span>

            <h1 class="card__msg">@lang('user.Payment_Complete')</h1>
            <h2 class="card__submsg">@lang('user.Thank_you_for_your_transfer')</h2>

            <div class="card__body">
                @auth
                <img src="{{Storage::url(auth()->user()->image)}}" class="card__avatar">
                @endauth
                <div class="card__recipient-info">
                    <p class="card__recipient">{{$order->billing_name}}</p>
                    <p class="card__email">{{$order->billing_email}}</p>
                </div>

                <h1 class="card__price"><span>{!! curr($order->grand_total)!!}</span></h1>

                <p class="card__method">@lang('user.Payment_method')</p>
                <div class="card__payment">
                    <img src="https://seeklogo.com/images/V/VISA-logo-F3440F512B-seeklogo.com.png"
                        class="card__credit-card">
                    <div class="card__card-details">
                        <p class="card__card-type">Credit / debit card</p>
                        <p class="card__card-number"></p>
                    </div>
                </div>

            </div>

            <div class="card__tags">
                <span class="card__tag">@lang('user.completed')</span>
                <span class="card__tag">#{{$order->id}}</span>
            </div>

        </div>

    </div>
</body>
<script>
    setTimeout(function () {
        window.location.href = '{{url('')}}'; // the redirect goes here

    }, 10000); // 10 seconds

</script>
<style>
    .bg {
        background-color: #6c7bee;
        width: 480px;
        overflow: hidden;
        margin: 0 auto;
        box-sizing: border-box;
        padding: 40px;
        font-family: 'Roboto';
        margin-top: 40px;
    }

    .card {
        background-color: #fff;
        width: 100%;
        float: left;
        margin-top: 40px;
        border-radius: 5px;
        box-sizing: border-box;
        padding: 80px 30px 25px 30px;
        text-align: center;
        position: relative;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .card__success {
        position: absolute;
        top: -50px;
        left: 145px;
        width: 100px;
        height: 100px;
        border-radius: 100%;
        background-color: #60c878;
        border: 5px solid #fff;
    }

    .card__success i {
        color: #fff;
        line-height: 100px;
        font-size: 45px;
    }

    .card__msg {
        text-transform: uppercase;
        color: #55585b;
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .card__submsg {
        color: #959a9e;
        font-size: 16px;
        font-weight: 400;
        margin-top: 0px;
    }

    .card__body {
        background-color: #f8f6f6;
        border-radius: 4px;
        width: 100%;
        margin-top: 30px;
        float: left;
        box-sizing: border-box;
        padding: 30px;
    }

    .card__avatar {
        width: 50px;
        height: 50px;
        border-radius: 100%;
        display: inline-block;
        margin-right: 10px;
        position: relative;
        top: 7px;
    }

    .card__recipient-info {
        display: inline-block;
    }

    .card__recipient {
        color: #232528;
        text-align: left;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .card__email {
        color: #838890;
        text-align: left;
        margin-top: 0px;
    }

    .card__price {
        color: #232528;
        font-size: 70px;
        margin-top: 25px;
        margin-bottom: 30px;
    }

    .card__price span {
        font-size: 60%;
    }

    .card__method {
        color: #d3cece;
        text-transform: uppercase;
        text-align: left;
        font-size: 11px;
        margin-bottom: 5px;
    }

    .card__payment {
        background-color: #fff;
        border-radius: 4px;
        width: 100%;
        height: 100px;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card__credit-card {
        width: 50px;
        display: inline-block;
        margin-right: 15px;
    }

    .card__card-details {
        display: inline-block;
        text-align: left;
    }

    .card__card-type {
        text-transform: uppercase;
        color: #232528;
        font-weight: 600;
        font-size: 12px;
        margin-bottom: 3px;
    }

    .card__card-number {
        color: #838890;
        font-size: 12px;
        margin-top: 0px;
    }

    .card__tags {
        clear: both;
        padding-top: 15px;
    }

    .card__tag {
        text-transform: uppercase;
        background-color: #f8f6f6;
        box-sizing: border-box;
        padding: 3px 5px;
        border-radius: 3px;
        font-size: 10px;
        color: #d3cece;
    }

</style>

</html>
