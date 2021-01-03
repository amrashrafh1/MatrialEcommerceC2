<div class="top-bar top-bar-v1">
    <div class="col-full">
        <ul id="menu-top-bar-left" class="nav justify-content-center">
            <li class="menu-item animate-dropdown">
                <a title="@auth @lang('user.my_account') @else @lang('user.login_register') @endif"
                 href="{{(Auth::check())?route('profile'):route('login')}}">@auth @lang('user.my_account') @else @lang('user.login_register') @endif</a>
            </li>
            <li class="menu-item animate-dropdown">
                <a title="@lang('user.visit_shop')" href="{{route('shop')}}">@lang('user.visit_shop')</a>
            </li>
            <li class="menu-item animate-dropdown">
                <a title="@lang('user.contact_us')" href="{{route('contact_us')}}"> @lang('user.contact_us')</a>
            </li>
            <li class="menu-item animate-dropdown">
                <a title="@lang('user.Checkout')" href="{{route('show_checkout')}}"> @lang('user.Checkout')</a>
            </li>
            <li class="menu-item animate-dropdown">
                <a href="{{route('show_chat', ['memberTypeTo'=>'chat', 'seq'=>'asd'])}}" class='notification'>
                    <span class='m{{($direction === 'right')?'l':'r'}}-2'>
                    @lang('user.chat')
                    </span>
                    <i class="fa fa-envelope fa-2x" style='color:#3265B0; padding-right:.1rem'></i>
                    <span class="badge messages_count" style="{{($direction === 'right')?'right: 140px;':''}};
                    background: red;color: #fff;border-radius: 50%;margin-bottom: 12px;">
                    @auth {{auth()->user()->unReadedMessages->count()}}@else 0 @endif</span>
                </a>
            </li>
            @php
            $country = App\Country::where('id', session('country'))->first();
            @endphp
            <li class="menu-item animate-dropdown" style='position:relative;'>
                <a title="{{($country) ? $country->country_name : trans('user.select_country')}}"
                     data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true" href="#">
                                {{($country) ? $country->country_name : trans('user.select_country')}}
                                <span class="caret"></span>
                            </a>
                <ul role="menu" class=" dropdown-menu" style='overflow-y:scroll; height:250px;'>
                    @foreach(App\Country::get() as  $country)
                    <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-489 animate-dropdown">
                        <a title="{{ $country->country_name }}"
                        href="{{'?country=' . $country->country_name}}">{{ $country->country_name }}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <!-- .nav -->
    </div>
    <!-- .col-full -->
</div>

