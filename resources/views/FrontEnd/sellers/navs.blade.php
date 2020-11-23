<ul role="tablist" class="shop-view-switcher nav nav-tabs justify-content-end" >
    <li class="nav-item">
        <a href="{{route('seller_dashboard', ['store'=> $store->slug])}}" title="@lang('user.dashboard')"
            class="nav-link {{(Route::current()->getName() == 'seller_dashboard')?'active':''}}">
            @lang('user.dashboard')
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('seller_frontend_products', ['store'=> $store->slug])}}" title="@lang('user.products')"
            class="nav-link {{(Route::current()->getName() == 'seller_frontend_products')?'active':''}}">
            @lang('user.products')
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('seller_frontend_orders', ['store'=> $store->slug])}}" title="@lang('user.orders')"
            class="nav-link {{(Route::current()->getName() == 'seller_frontend_orders')?'active':''}}">
            @lang('user.orders')
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('store_profile', ['store'=> $store->slug])}}" title="@lang('user.store_profile')"
            class="nav-link {{(Route::current()->getName() == 'store_profile')?'active':''}}">
            @lang('user.store_profile')
        </a>
    </li>
</ul>
