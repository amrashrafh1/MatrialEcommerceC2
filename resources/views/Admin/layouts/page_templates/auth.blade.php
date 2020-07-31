<div class="wrapper ">
  @include('Admin.layouts.navbars.sidebar')
  <div class="main-panel">
    @include('Admin.layouts.navbars.navs.auth')
    @yield('content')
    @include('Admin.layouts.footers.auth')
  </div>
</div>