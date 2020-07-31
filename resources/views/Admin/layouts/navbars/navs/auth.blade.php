<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#">{{ $titlePage }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <form id="searchForm" class="navbar-form" action="{{aurl('/result')}}" method="GET">
                <div class="search_container">
                    <input type="text" name="q" id="speechText" class="form-control"
                        placeholder="{{ trans('admin.search') }}..." />
                    <img style="margin-left: -10px; cursor: pointer;" onclick="startRecording()"
                        src="//i.imgur.com/cHidSVu.gif" />
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                    </button>
                    <div class="ripple-container"></div>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Stats') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownProducts" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="material-icons" style="color:red;">
                            warning
                        </i>
                        <span id="ProductNotificationCounter"
                            class="notification">{{count(auth()->user()->unreadNotifications->where('type','App\Notifications\ProductNotifications'))}}</span>
                        <p class="d-lg-none d-md-block">
                            {{ __('Some Actions') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProducts">
                        @foreach(auth()->user()->unreadNotifications->where('type',
                        'App\Notifications\ProductNotifications') as $noty)
                        <a class="dropdown-item product-dropdown-item"
                            href="{{aurl('/markasread/'. $noty->id)}}">{{  $noty->data['message'] }} <span class="ml-2">
                                {{\Carbon\Carbon::createFromTimeStamp(strtotime($noty->created_at))->diffForHumans()}}</span>
                            <span class="ml-2"
                                style="font-size: 12px; color: blue;">@lang('admin.markasread')</span></a>
                        @endforeach
                        <div id="markallasread" href="{{aurl('/markallasread')}}" class="text-center"><a
                                style="color: blue; background: transparent; box-shadow: none; cursor:pointer;">@lang('admin.markallasread')</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification"
                            id="NotificationCounter">{{count(auth()->user()->unreadNotifications->where('type','App\Notifications\NotificationSent'))}}</span>
                        <p class="d-lg-none d-md-block">
                            {{ __('Some Actions') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" id="notificationMenu"
                        aria-labelledby="navbarDropdownMenuLink">
                        @foreach(auth()->user()->unreadNotifications->where('type',
                        'App\Notifications\NotificationSent') as $noty)
                        <a class="dropdown-item" href="#">{{  $noty->data['title'] }} <span class="ml-2">
                                {{\Carbon\Carbon::createFromTimeStamp(strtotime($noty->created_at))->diffForHumans()}}</span></a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-language fa-2x"></i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Some Actions') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Account') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{trans('admin.profile')}}</a>
                        <a class="dropdown-item" href="{{route('settings')}}">{{trans('admin.Settings')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{trans('admin.logout')}}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script>
    //var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $('#navbarDropdownMenuLink').on('click', function () {
        axios.get('/admin/markasread')
            .then(res => {
                $('#NotificationCounter').text(0);
            });
    });

    $('.product-dropdown-item').on('click', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var thi = $(this);
        axios.get(href)
            .then(res => {
                $('#ProductNotificationCounter').text($('#ProductNotificationCounter').text() - 1);
                $(thi).remove();
            });
    });
    $('#markallasread').on('click', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var thi = $(this);
        axios.get(href)
            .then(res => {
                $('#ProductNotificationCounter').text(0);
                $('.product-dropdown-item').remove();
                $(thi).remove();
            });
    });

</script>
@endpush
