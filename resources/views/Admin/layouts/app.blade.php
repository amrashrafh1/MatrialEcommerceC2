<!DOCTYPE html>
<html lang="{{LaravelLocalization::setLocale()}}"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Material Dashboard Laravel - Free Frontend Preset for Laravel') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
 <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    @if(\LaravelLocalization::setLocale() == 'ar'))
    <link href="{{ asset('material') }}/css/material-dashboard-rtl.css?v=1.1" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Cairo&amp;subset=arabic" rel="stylesheet">
    @endif
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/custom.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="{{ asset('assets/addchat/css/addchat.min.css') }}" rel="stylesheet">
    @if(\Cookie::get('color') != NULL)
        <link href="{{ asset('css') }}/colors/{{\Cookie::get('color')}}.css" rel="stylesheet"/>
    @endif
    @if(
       Route::current()->getName() == 'products.create'
    || Route::current()->getName() == 'products.edit'
    || Route::current()->getName() == 'cmss_create_products'
    || Route::current()->getName() == 'product_variations'
    || Route::current()->getName() == 'add_accessories'
    || Route::current()->getName() == 'discounts.create'
    || Route::current()->getName() == 'attributes.create' )
    @livewireStyles
    @livewireScripts
    @endif
</head>

<body class="{{ $class ?? '' }}">
    @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('Admin.layouts.page_templates.auth')
    @endauth
    @guest()
    @include('layouts.page_templates.guest')
    @endguest



<div class="fixed-plugin" style="top:174px; {{($direction =='right')?'left:0;right:auto;':'right:0;left:auto;'}}">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fas fa-cloud fa-3x" style="color: #fff;"></i>
            </a>
            <ul class="dropdown-menu" style="{{($direction =='right')?'right: -303px;:0;left:auto;':''}}">
                <li class="header-title"> @lang('admin.Weather')</li>
                <div class="adjustments-line d-block">
                    <div  id="app">
                        <weather></weather>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <div class="fixed-plugin" style='{{($direction =='right')?'left:0;right:auto;':''}}'>
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu" style='{{($direction =='right')?'right: -303px;:0;left:auto;':''}}'>
                <li class="header-title"> @lang('admin.Sidebar_Filters')</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger active-color">
                        <div class="badge-colors ml-auto mr-auto">
                            <span class="badge filter badge-purple" data-color="purple" onclick="changeColor('purple')"></span>
                            <span class="badge filter badge-azure" data-color="azure" onclick="changeColor('azure')"></span>
                            <span class="badge filter badge-green" data-color="green" onclick="changeColor('green')"></span>
                            <span class="badge filter badge-warning active" data-color="orange" onclick="changeColor('orange')"></span>
                            <span class="badge filter badge-danger" data-color="danger" onclick="changeColor('danger')"></span>
                            <span class="badge filter badge-rose" data-color="rose" onclick="changeColor('rose')"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="header-title">Images</li>
                <li class="active">
                    <a class="img-holder switch-trigger" href="javascript:void(0)" onclick="changeImage('{{ asset('material') }}/img/sidebar-1.jpg')">
                        <img src="{{ asset('material') }}/img/sidebar-1.jpg" alt="">
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)" onclick="changeImage('{{ asset('material') }}/img/sidebar-2.jpg')">
                        <img src="{{ asset('material') }}/img/sidebar-2.jpg" alt="">
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)" onclick="changeImage('{{ asset('material') }}/img/sidebar-3.jpg')">
                        <img src="{{ asset('material') }}/img/sidebar-3.jpg" alt="">
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)" onclick="changeImage('{{ asset('material') }}/img/sidebar-4.jpg')">
                        <img src="{{ asset('material') }}/img/sidebar-4.jpg" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
        <!-- 2. AddChat widget -->
        <div id="addchat_app"
        data-baseurl="{{ url('') }}"
        data-csrfname="{{ 'X-CSRF-Token' }}"
        data-csrftoken="{{ csrf_token() }}"
    ></div>
    <div id="app">
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Echo.channel('home')
            .listen('notificationEvent', (e) => {
                $('#notificationMenu').append('<a class="dropdown-item" href="#">'+e.message+'</a>');
                $('#NotificationCounter').text(parseInt($('#NotificationCounter').text()) + 1);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: e.message,
                    showConfirmButton: false,
                    timer: 1500
                })
        });


        Echo.channel('new-seller')
            .listen('NewSeller', (e) => {
                $('#notificationMenu').append('<a class="dropdown-item" href="#">'+e.message+'</a>');
                $('#NotificationCounter').text(parseInt($('#NotificationCounter').text()) + 1);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: e.message,
                    showConfirmButton: false,
                    timer: 1500
                })
        });
        Echo.channel('new-order')
            .listen('NewOrder', (e) => {
                $('#notificationMenu').append('<a class="dropdown-item" href="#">'+e.message+'</a>');
                $('#NotificationCounter').text(parseInt($('#NotificationCounter').text()) + 1);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: e.message,
                    showConfirmButton: false,
                    timer: 1500
                })
        });
    </script>
    <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'"></script>
    <!-- Chartist JS -->
    <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
    <!--  NewNotification Plugin    -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('material') }}/demo/demo.js"></script>
    <script src="{{ asset('material') }}/js/settings.js"></script>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{url("/js/dataTables.buttons.min.js")}}"></script>
    <script src="{{url("/js/buttons.server-side.js")}}"></script>
    <!-- 3. AddChat JS -->
    <!-- Modern browsers -->
    <script type="module" src="{{ asset('assets/addchat/js/addchat.min.js') }}"></script>
    <!-- Fallback support for Older browsers -->
    <script nomodule src="{{ asset('assets/addchat/js/addchat-legacy.min.js') }}"></script>
    <script>
        function check_all() {
            $('input[class="item_checkbox"]:checkbox').each(function () {
                if ($('input[class="check_all"]:checkbox:checked').length == 0) {
                    $(this).prop('checked', false);
                } else {
                    $(this).prop('checked', true);
                }
            });
        }

        function delete_all() {
            $(document).on('click', '.del_all', function () {
                $('#form_data').submit();
            });
            $(document).on('click', '.delBtn', function () {
                var item_checked = $('input[class="item_checkbox"]:checkbox').filter(':checked').length;
                if (item_checked > 0) {
                    $('.record_count').text(item_checked);
                    $('.not_empty_record').removeClass('hidden');
                    $('.empty_record').addClass('hidden');
                } else {
                    $('.record_count').text('');
                    $('.not_empty_record').addClass('hidden');
                    $('.empty_record').removeClass('hidden');
                }
                $('#mutlipleDelete').modal('show');
            });
        }
        $('#datetimepicker1').datetimepicker();

        /* change color (sidebar) */
        function changeColor(color) {
            $url = "{{route('changecolor')}}";
            $.post({
            url: $url,
            data: {
                _token: '{{csrf_token()}}',
                color: color
            }
            });
        }

    /* change image (sidebar) */
        function changeImage(image) {
            $url = "{{route('changeimage')}}";
            $.post({
            url: $url,
            data: {
                _token: '{{csrf_token()}}',
                image: image
            }
            });
        }


        var recognition = new webkitSpeechRecognition();

        recognition.onresult = function(event) {
            var saidText = "";
            for (var i = event.resultIndex; i < event.results.length; i++) {
                if (event.results[i].isFinal) {
                    saidText = event.results[i][0].transcript;
                } else {
                    saidText += event.results[i][0].transcript;
                }
            }
            // Update Textbox value
            document.getElementById('speechText').value = saidText;

            // Search Posts
            searchPosts(saidText);
        }

        function startRecording(){
            recognition.start();
        }

        // Search Posts
        function searchPosts(saidText){
            $('#searchForm').trigger('submit');
        }

            $('#wiconCopy').each(function () {
                $(this).attr('src', $('#wicon').attr('src')).delay(10000);
            });
            @if(Route::current()->getName() == 'add_accessories'
             || Route::current()->getName() == 'cmss_create_products'
             || Route::current()->getName() == 'discounts.create'
             || Route::current()->getName() == 'discounts.edit'
             )
            @else
            document.addEventListener("livewire:load", function(event) {
            window.livewire.beforeDomUpdate(() => {
                // Add your custom JavaScript here.
            });

        window.livewire.afterDomUpdate(() => {
            @if(Route::current()->getName() != 'attribute_families.index')
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{trans("admin.updated")}}',
            showConfirmButton: true,
            timer: 1500
            });

            @endif


        });
    });
    @endif
    </script>
    @stack('js')

</body>

</html>
