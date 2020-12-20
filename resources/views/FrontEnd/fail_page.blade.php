<!DOCTYPE html>
<html lang="{{LaravelLocalization::setLocale()}}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('user.fail_payment')</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.css">
    <!-- CSS Files -->
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,700,600);

        .container {
            padding: 20px;
        }

        body {
            background-color: #f6f4f4;
            font-family: 'Raleway', sans-serif;
        }

        .teal {
            background-color: #ffc952 !important;
            color: #444444 !important;
            margin-top: 10px !important;
        }

        a {
            color: #47b8e0 !important;
        }

        .message {
            text-align: left;
        }

        .price1 {
            font-size: 40px;
            font-weight: 200;
            display: block;
            text-align: center;
        }

        .ui.message p {
            margin: 5px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="ui middle aligned center aligned grid">
            <div class="ui eight wide column">

                <div class="ui large form">

                    <div class="ui icon negative message">
                        <i class="warning icon"></i>
                        <div class="content">
                            <div class="header">
                                @lang('user.Oops_Something_went_wrong')
                            </div>
                            <p>{{isset($message) ? $message : trans('user.While_trying_to_reserve_money_from_your_account') }}</p>
                        </div>

                    </div>

                    <a href='{{route('show_checkout')}}'
                        class="ui large teal submit fluid button">@lang('user.Try_again')</a>
                    <a href='{{route('home')}}'
                        class="ui large teal submit fluid button">@lang('user.Home')</a>

                </div>
            </div>
        </div>
    </div>
</body>


</html>
