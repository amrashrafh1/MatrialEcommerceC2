<!DOCTYPE html>
<html lang="{{LaravelLocalization::setLocale()}}" itemscope="itemscope"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('user.seller_chat')</title>
    <link rel="shortcut icon" type="image/x-icon"
        href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type=""
        href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg"
        color="#111" />
    <link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet'
        type='text/css'>

    <script src="https://use.typekit.net/hoy3lrg.js"></script>
    <script>
        try {
            Typekit.load({
                async: true
            });
        } catch (e) {}

    </script>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <link rel='stylesheet prefetch'
        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    @livewireStyles

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style class="cp-pen-styles">
        body {
            min-height: 100vh;
            background: rgb(67, 95, 122, .3);
        }

        div.body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "proxima-nova", "Source Sans Pro", sans-serif;
            font-size: 1em;
            letter-spacing: 0.1px;
            color: #32465a;
            text-rendering: optimizeLegibility;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
            -webkit-font-smoothing: antialiased;
        }

        #frame {
            width: 95%;
            min-width: 360px;
            max-width: 1000px;
            height: 92vh;
            min-height: 300px;
            max-height: 720px;
            background: #E6EAEA;
        }

        @media screen and (max-width: 360px) {
            #frame {
                width: 100%;
                height: 100vh;
            }
        }

        #frame #sidepanel {
            float: left;
            min-width: 280px;
            max-width: 340px;
            width: 40%;
            height: 100%;
            background: #2c3e50;
            color: #f5f5f5;
            overflow: hidden;
            position: relative;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel {
                width: 58px;
                min-width: 58px;
            }
        }

        #frame #sidepanel #profile {
            width: 80%;
            margin: 25px auto;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile {
                width: 100%;
                margin: 0 auto;
                padding: 5px 0 0 0;
                background: #32465a;
            }
        }

        #frame #sidepanel #profile.expanded .wrap {
            height: 210px;
            line-height: initial;
        }

        #frame #sidepanel #profile.expanded .wrap p {
            margin-top: 20px;
        }

        #frame #sidepanel #profile.expanded .wrap i.expand-button {
            -moz-transform: scaleY(-1);
            -o-transform: scaleY(-1);
            -webkit-transform: scaleY(-1);
            transform: scaleY(-1);
            filter: FlipH;
            -ms-filter: "FlipH";
        }

        #frame #sidepanel #profile .wrap {
            height: 60px;
            line-height: 60px;
            overflow: hidden;
            -moz-transition: 0.3s height ease;
            -o-transition: 0.3s height ease;
            -webkit-transition: 0.3s height ease;
            transition: 0.3s height ease;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap {
                height: 55px;
            }
        }

        #frame #sidepanel #profile .wrap img {
            width: 50px;
            border-radius: 50%;
            padding: 3px;
            border: 2px solid #e74c3c;
            height: auto;
            float: left;
            cursor: pointer;
            -moz-transition: 0.3s border ease;
            -o-transition: 0.3s border ease;
            -webkit-transition: 0.3s border ease;
            transition: 0.3s border ease;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap img {
                width: 40px;
                margin-left: 4px;
            }
        }

        #frame #sidepanel #profile .wrap img.online {
            border: 2px solid #2ecc71;
        }

        #frame #sidepanel #profile .wrap img.away {
            border: 2px solid #f1c40f;
        }

        #frame #sidepanel #profile .wrap img.busy {
            border: 2px solid #e74c3c;
        }

        #frame #sidepanel #profile .wrap img.offline {
            border: 2px solid #95a5a6;
        }

        #frame #sidepanel #profile .wrap p {
            float: left;
            margin-left: 15px;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap p {
                display: none;
            }
        }

        #frame #sidepanel #profile .wrap i.expand-button {
            float: right;
            margin-top: 23px;
            font-size: 0.8em;
            cursor: pointer;
            color: #435f7a;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap i.expand-button {
                display: none;
            }
        }

        #frame #sidepanel #profile .wrap #status-options {
            position: absolute;
            opacity: 0;
            visibility: hidden;
            width: 150px;
            margin: 70px 0 0 0;
            border-radius: 6px;
            z-index: 99;
            line-height: initial;
            background: #435f7a;
            -moz-transition: 0.3s all ease;
            -o-transition: 0.3s all ease;
            -webkit-transition: 0.3s all ease;
            transition: 0.3s all ease;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options {
                width: 58px;
                margin-top: 57px;
            }
        }

        #frame #sidepanel #profile .wrap #status-options.active {
            opacity: 1;
            visibility: visible;
            margin: 75px 0 0 0;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options.active {
                margin-top: 62px;
            }
        }

        #frame #sidepanel #profile .wrap #status-options:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 8px solid #435f7a;
            margin: -8px 0 0 24px;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options:before {
                margin-left: 23px;
            }
        }

        #frame #sidepanel #profile .wrap #status-options ul {
            overflow: hidden;
            border-radius: 6px;
        }

        #frame #sidepanel #profile .wrap #status-options ul li {
            padding: 15px 0 30px 18px;
            display: block;
            cursor: pointer;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li {
                padding: 15px 0 35px 22px;
            }
        }

        #frame #sidepanel #profile .wrap #status-options ul li:hover {
            background: #496886;
        }

        #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 5px 0 0 0;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
                width: 14px;
                height: 14px;
            }
        }

        #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
            content: '';
            position: absolute;
            width: 14px;
            height: 14px;
            margin: -3px 0 0 -3px;
            background: transparent;
            border-radius: 50%;
            z-index: 0;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
                height: 18px;
                width: 18px;
            }
        }

        #frame #sidepanel #profile .wrap #status-options ul li p {
            padding-left: 12px;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li p {
                display: none;
            }
        }

        #frame #sidepanel #profile .wrap #status-options ul li#status-online span.status-circle {
            background: #2ecc71;
        }

        #frame #sidepanel #profile .wrap #status-options ul li#status-online.active span.status-circle:before {
            border: 1px solid #2ecc71;
        }

        #frame #sidepanel #profile .wrap #status-options ul li#status-away span.status-circle {
            background: #f1c40f;
        }

        #frame #sidepanel #profile .wrap #status-options ul li#status-away.active span.status-circle:before {
            border: 1px solid #f1c40f;
        }

        #frame #sidepanel #profile .wrap #status-options ul li#status-busy span.status-circle {
            background: #e74c3c;
        }

        #frame #sidepanel #profile .wrap #status-options ul li#status-busy.active span.status-circle:before {
            border: 1px solid #e74c3c;
        }

        #frame #sidepanel #profile .wrap #status-options ul li#status-offline span.status-circle {
            background: #95a5a6;
        }

        #frame #sidepanel #profile .wrap #status-options ul li#status-offline.active span.status-circle:before {
            border: 1px solid #95a5a6;
        }

        #frame #sidepanel #profile .wrap #expanded {
            padding: 100px 0 0 0;
            display: block;
            line-height: initial !important;
        }

        #frame #sidepanel #profile .wrap #expanded label {
            float: left;
            clear: both;
            margin: 0 8px 5px 0;
            padding: 5px 0;
        }

        #frame #sidepanel #profile .wrap #expanded input {
            border: none;
            margin-bottom: 6px;
            background: #32465a;
            border-radius: 3px;
            color: #f5f5f5;
            padding: 7px;
            width: calc(100% - 43px);
        }

        #frame #sidepanel #profile .wrap #expanded input:focus {
            outline: none;
            background: #435f7a;
        }

        #frame #sidepanel #search {
            border-top: 1px solid #32465a;
            border-bottom: 1px solid #32465a;
            font-weight: 300;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #search {
                display: none;
            }
        }

        #frame #sidepanel #search label {
            position: absolute;
            margin: 10px 0 0 20px;
        }

        #frame #sidepanel #search input {
            font-family: "proxima-nova", "Source Sans Pro", sans-serif;
            padding: 10px 0 10px 46px;
            width: calc(100% - 25px);
            border: none;
            background: #32465a;
            color: #f5f5f5;
        }

        #frame #sidepanel #search input:focus {
            outline: none;
            background: #435f7a;
        }

        #frame #sidepanel #search input::-webkit-input-placeholder {
            color: #f5f5f5;
        }

        #frame #sidepanel #search input::-moz-placeholder {
            color: #f5f5f5;
        }

        #frame #sidepanel #search input:-ms-input-placeholder {
            color: #f5f5f5;
        }

        #frame #sidepanel #search input:-moz-placeholder {
            color: #f5f5f5;
        }

        #frame #sidepanel #contacts {
            height: calc(100% - 177px);
            overflow-y: scroll;
            overflow-x: hidden;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts {
                height: calc(100% - 149px);
                overflow-y: scroll;
                overflow-x: hidden;
            }

            #frame #sidepanel #contacts::-webkit-scrollbar {
                display: none;
            }
        }

        #frame #sidepanel #contacts.expanded {
            height: calc(100% - 334px);
        }

        #frame #sidepanel #contacts::-webkit-scrollbar {
            width: 8px;
            background: #2c3e50;
        }

        #frame #sidepanel #contacts::-webkit-scrollbar-thumb {
            background-color: #243140;
        }

        #frame #sidepanel #contacts ul li.contact {
            position: relative;
            padding: 10px 0 15px 0;
            font-size: 0.9em;
            cursor: pointer;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact {
                padding: 6px 0 46px 8px;
            }
        }

        #frame #sidepanel #contacts ul li.contact:hover {
            background: #32465a;
        }

        #frame #sidepanel #contacts ul li.contact.active {
            background: #32465a;
            border-right: 5px solid #435f7a;
        }

        #frame #sidepanel #contacts ul li.contact.active span.contact-status {
            border: 2px solid #32465a !important;
        }

        #frame #sidepanel #contacts ul li.contact .wrap {
            width: 88%;
            margin: 0 auto;
            position: relative;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact .wrap {
                width: 100%;
            }
        }

        #frame #sidepanel #contacts ul li.contact .wrap span {
            position: absolute;
            left: 0;
            margin: -2px 0 0 -2px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 2px solid #2c3e50;
            background: #95a5a6;
        }

        #frame #sidepanel #contacts ul li.contact .wrap span.online {
            background: #2ecc71;
        }

        #frame #sidepanel #contacts ul li.contact .wrap span.away {
            background: #f1c40f;
        }

        #frame #sidepanel #contacts ul li.contact .wrap span.busy {
            background: #e74c3c;
        }

        #frame #sidepanel #contacts ul li.contact .wrap img {
            width: 40px;
            border-radius: 50%;
            float: left;
            margin-right: 10px;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact .wrap img {
                margin-right: 0px;
            }
        }

        #frame #sidepanel #contacts ul li.contact .wrap .meta {
            padding: 5px 0 0 0;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact .wrap .meta {
                display: none;
            }
        }

        #frame #sidepanel #contacts ul li.contact .wrap .meta .name {
            font-weight: 600;
        }

        #frame #sidepanel #contacts ul li.contact .wrap .meta .preview {
            margin: 5px 0 0 0;
            padding: 0 0 1px;
            font-weight: 400;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            -moz-transition: 1s all ease;
            -o-transition: 1s all ease;
            -webkit-transition: 1s all ease;
            transition: 1s all ease;
        }

        #frame #sidepanel #contacts ul li.contact .wrap .meta .preview span {
            position: initial;
            border-radius: initial;
            background: none;
            border: none;
            padding: 0 2px 0 0;
            margin: 0 0 0 1px;
            opacity: .5;
        }

        #frame #sidepanel #bottom-bar {
            position: absolute;
            width: 100%;
            bottom: 0;
        }

        #frame #sidepanel #bottom-bar button {
            float: left;
            border: none;
            width: 50%;
            padding: 10px 0;
            background: #32465a;
            color: #f5f5f5;
            cursor: pointer;
            font-size: 0.85em;
            font-family: "proxima-nova", "Source Sans Pro", sans-serif;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button {
                float: none;
                width: 100%;
                padding: 15px 0;
            }
        }

        #frame #sidepanel #bottom-bar button:focus {
            outline: none;
        }

        #frame #sidepanel #bottom-bar button:nth-child(1) {
            border-right: 1px solid #2c3e50;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button:nth-child(1) {
                border-right: none;
                border-bottom: 1px solid #2c3e50;
            }
        }

        #frame #sidepanel #bottom-bar button:hover {
            background: #435f7a;
        }

        #frame #sidepanel #bottom-bar button i {
            margin-right: 3px;
            font-size: 1em;
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button i {
                font-size: 1.3em;
            }
        }

        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button span {
                display: none;
            }
        }

        #frame .content {
            float: right;
            width: 60%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        @media screen and (max-width: 735px) {
            #frame .content {
                width: calc(100% - 58px);
                min-width: 300px !important;
            }
        }

        @media screen and (min-width: 900px) {
            #frame .content {
                width: calc(100% - 340px);
            }
        }

        #frame .content .contact-profile {
            width: 100%;
            height: 60px;
            line-height: 60px;
            background: #f5f5f5;
        }

        #frame .content .contact-profile img {
            width: 40px;
            border-radius: 50%;
            float: left;
            margin: 9px 12px 0 9px;
        }

        #frame .content .contact-profile p {
            float: left;
        }

        #frame .content .contact-profile .social-media {
            float: right;
        }

        #frame .content .contact-profile .social-media i {
            margin-left: 14px;
            cursor: pointer;
        }

        #frame .content .contact-profile .social-media i:nth-last-child(1) {
            margin-right: 20px;
        }

        #frame .content .contact-profile .social-media i:hover {
            color: #435f7a;
        }

        #frame .content .messages {
            height: auto;
            min-height: calc(100% - 93px);
            max-height: calc(100% - 93px);
            overflow-y: scroll;
            overflow-x: hidden;
            width: 100%;
        }

        @media screen and (max-width: 735px) {
            #frame .content .messages {
                max-height: calc(100% - 105px);
            }
        }

        #frame .content .messages::-webkit-scrollbar {
            width: 8px;
            background: transparent;
        }

        #frame .content .messages::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
        }

        #frame .content .messages ul li {
            display: inline-block;
            clear: both;
            float: left;
            margin: 15px 15px 5px 15px;
            width: calc(100% - 25px);
            font-size: 0.9em;
        }

        #frame .content .messages ul li:nth-last-child(1) {
            margin-bottom: 20px;
        }

        #frame .content .messages ul li.sent img {
            margin: 6px 8px 0 0;
        }

        #frame .content .messages ul li.sent p {
            background: #435f7a;
            color: #f5f5f5;
        }

        #frame .content .messages ul li.replies img {
            float: right;
            margin: 6px 0 0 8px;
        }

        #frame .content .messages ul li.replies p {
            background: #f5f5f5;
            float: right;
        }

        #frame .content .messages ul li img {
            width: 22px;
            border-radius: 50%;
            float: left;
        }

        #frame .content .messages ul li p {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 205px;
            line-height: 130%;
        }

        @media screen and (min-width: 735px) {
            #frame .content .messages ul li p {
                max-width: 300px;
            }
        }

        #frame .content .message-input {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 99;
        }

        #frame .content .message-input .wrap {
            position: relative;
        }

        #frame .content .message-input .wrap input {
            font-family: "proxima-nova", "Source Sans Pro", sans-serif;
            float: left;
            border: none;
            width: calc(100% - 90px);
            padding: 11px 32px 10px 8px;
            font-size: 0.8em;
            color: #32465a;
        }

        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap input {
                padding: 15px 32px 16px 8px;
            }
        }

        #frame .content .message-input .wrap input:focus {
            outline: none;
        }

        #frame .content .message-input .wrap .attachment {
            position: absolute;
            right: 60px;
            z-index: 4;
            margin-top: 10px;
            font-size: 1.1em;
            color: #435f7a;
            opacity: .5;
            cursor: pointer;
        }

        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap .attachment {
                margin-top: 17px;
                right: 65px;
            }
        }

        #frame .content .message-input .wrap .attachment:hover {
            opacity: 1;
        }

        #frame .content .message-input .wrap button {
            float: right;
            border: none;
            width: 50px;
            padding: 12px 0;
            cursor: pointer;
            background: #32465a;
            color: #f5f5f5;
        }

        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap button {
                padding: 16px 0;
            }
        }

        #frame .content .message-input .wrap button:hover {
            background: #435f7a;
        }

        #frame .content .message-input .wrap button:focus {
            outline: none;
        }

        .image {
            height: 120px !important;
            width: 120px !important;
            border-radius: 0 !important;
            margin-bottom: 0 !important;
            cursor: pointer;
        }

        .modal-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0.6;
            top: 0px;
            left: 0px;
            z-index: 999;

        }

        .modal-img {
            position: fixed;
            background-color: white;
            top: 0;
            z-index: 1000;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        @media screen and (max-width: 735px) {
            .modal-img {
                height: 80%;
                width: 80%;
            }

            .modal-img img {
                height: 100%;
                width: 100%;
            }

            .links {
                display: block;
            }
        }

        #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
                {
                    {
                    $direction=='right'? 'margin: -2px -12px 0 -3px !important;': ''
                }
            }
        }

        /*Huge thanks to @tobiasahlin at http://tobiasahlin.com/spinkit/ */
        /* .spinner {
  margin: 100px auto 0;
  width: 70px;
  text-align: center;
}

.spinner > div {
  width: 18px;
  height: 18px;
  background-color: #e6e6e6;

  border-radius: 100%;
  display: inline-block;
  -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
  animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}

.spinner .bounce1 {
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}

.spinner .bounce2 {
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}

@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bouncedelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
    transform: scale(0);
  } 40% {
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
  }
} */
        .dot-falling {
            position: relative;
            left: -9999px;
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #e6e6e6;
            color: #e6e6e6;
            box-shadow: 9999px 0 0 0#e6e6e6;
            animation: dotFalling 1s infinite linear;
            animation-delay: .1s;
        }

        .dot-falling::before,
        .dot-falling::after {
            content: '';
            display: inline-block;
            position: absolute;
            top: 0;
        }

        .dot-falling::before {
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #e6e6e6;
            color: #e6e6e6;
            animation: dotFallingBefore 1s infinite linear;
            animation-delay: 0s;
        }

        .dot-falling::after {
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #e6e6e6;
            color: #e6e6e6;
            animation: dotFallingAfter 1s infinite linear;
            animation-delay: .2s;
        }

        @keyframes dotFalling {
            0% {
                box-shadow: 9999px -15px 0 0 rgba(152, 128, 255, 0);
            }

            25%,
            50%,
            75% {
                box-shadow: 9999px 0 0 0#e6e6e6;
            }

            100% {
                box-shadow: 9999px 15px 0 0 rgba(152, 128, 255, 0);
            }
        }

        @keyframes dotFallingBefore {
            0% {
                box-shadow: 9984px -15px 0 0 rgba(152, 128, 255, 0);
            }

            25%,
            50%,
            75% {
                box-shadow: 9984px 0 0 0#e6e6e6;
            }

            100% {
                box-shadow: 9984px 15px 0 0 rgba(152, 128, 255, 0);
            }
        }

        @keyframes dotFallingAfter {
            0% {
                box-shadow: 10014px -15px 0 0 rgba(152, 128, 255, 0);
            }

            25%,
            50%,
            75% {
                box-shadow: 10014px 0 0 0#e6e6e6;
            }

            100% {
                box-shadow: 10014px 15px 0 0 rgba(152, 128, 255, 0);
            }
        }
        #loading {
        position     : absolute;
        width        : 100%;
        height       : 100%;
        background   : #EEEEEE;
        opacity      : 0.8;
        top          : 0;
        bottom       : 0;
        right        : {{$direction === 'right'? '-50%':''}};
        left         : 50%;
        -ms-transform: translateX(-50%) -webkit-transform: translateX(-50%);
        transform    : translateX(-50%)
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
    .contact-profile .online {
        color:green;
    }
    .contact-profile .offline {
        color:#95a5a6;
    }
    .contact-profile .away {
        color:#f1c40f;
    }
    .contact-profile .busy {
        color:#e74c3c;
    }
    </style>
</head>

<body>
    @php
        $user_id = ($conv->user_1 != auth()->user()->id)?$conv->user_1:$conv->user_2;
    @endphp
    <div class='links mb-2'>
        <a href='{{route('home')}}' class='btn btn-outline-dark'><i class='fa fa-arrow-left'></i> @lang('user.Home')</a>
        <a href='{{route('shop')}}' class='btn btn-outline-dark'><i class='fa fa-shopping-basket'></i>
            @lang('user.Shop')</a>
    </div>
    <div id="app"></div>
    <div class='body'>
        @livewire('front-end.chat-bot', ['conv' => $conv])
        <audio id="chat_sound" controls class='d-none'>
            <source src="{{url('/')}}/mp3/facebook-messenger-tone-wapking-fm-mp3-17015-19072-43455.mp3" type="audio/mp3"
                preload="auto">
            <source src="notification.ogg" type="audio/ogg" preload="auto">
            Your browser isn't invited for super fun audio time.
        </audio>
    </div>

    <script
        src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'>
    </script>

    @livewireScripts
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>

    <script>
        //var cTime = moment().format();
        $('.timeCounter').each(function ($key, $value) {
            $(this).text(moment($(this).data('time')).startOf('second').fromNow());
        });
        setInterval(() => {
            $('.timeCounter').each(function ($key, $value) {
                $(this).text(moment($(this).data('time')).startOf('second').fromNow());
            });
        }, 5000);

        $('#imageContainer img').each(function (index) {
            if ($(this).attr('onclick') != null) {
                if ($(this).attr('onclick').indexOf("runThis()") == -1) {
                    $(this).click(function () {
                        $(this).attr('onclick');
                        var src = $(this).attr("src");
                        ShowLargeImage(src);
                    });
                }
            } else {
                $(this).click(function () {
                    var src = $(this).attr("src");
                    ShowLargeImage(src);
                });
            }
        });

        $('body').on('click', '.modal-overlay', function () {
            $('.modal-overlay, .modal-img').remove();
        });

        function ShowLargeImage(imagePath) {
            $('body').append('<div class="modal-overlay"></div><div class="modal-img"><img src="' + imagePath.replace(
                "small", "large") + '" /></div>');
        }


        function uploadedSuccess(images, replay = true) {
            if (images) {
                $now = Date.now();
                // append image
                $img =
                    `<li class="${(replay)? 'replies': 'sent'}"><img src="${(replay)? '{{Storage::url(auth()->user()->image)}}': '{{Storage::url(App\User::findOrFail($user_id)->image)}}'}" alt="" /><p style="overflow-wrap: break-word;" id="imageContainer">`;
                for (i = 1; i <= images.length; i++) {
                    $img += `<img alt="" class="image" src="${images[i - 1]}"  wire:ignore />`;
                }
                $img += '<br /> <span class="timeCounter" style="font-size:12px;float:right;" data-time="' + $now +
                    '"></span></p></li>';
                $($img).appendTo($('.messages ul'));
                // show images when click;
                $('#imageContainer img').each(function (index) {
                    if ($(this).attr('onclick') != null) {
                        if ($(this).attr('onclick').indexOf("runThis()") == -1) {
                            $(this).click(function () {
                                $(this).attr('onclick');
                                var src = $(this).attr("src");
                                ShowLargeImage(src);
                            });
                        }
                    } else {
                        $(this).click(function () {
                            var src = $(this).attr("src");
                            ShowLargeImage(src);
                        });
                    }
                });
            }
        }

    </script>
    @stack('js')
</body>

</html>
