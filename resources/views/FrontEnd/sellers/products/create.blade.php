@extends('layouts.app')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                <a href="{{route('seller_frontend_products')}}">{{auth()->user()->name}} @lang('user.dashboard')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>@lang('user.create')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area" style="flex: 0 0 100%;
            max-width: 100%;
            order: 2;">
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{$error}}</div>
                @endforeach
                @endif
                @livewire('sellers.product-seller-create')
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! $Validator->selector('#create-product') !!}
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script>
    $('.delete').on('click', function(e) {
        e.preventDefault();
    });
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
    <script>
        <?php foreach(\LaravelLocalization::getSupportedLocales() as $locale => $props) { ?>
                CKEDITOR.replace('short_description_{{$locale}}');
                CKEDITOR.replace('description_{{$locale}}');

        <?php } ?>
  $('form').keypress(function(e){
      if(e.keyCode==13)
      //$('#linkadd').click();
      e.preventDefault();
    });
        </script>
@endpush
<style>
.bootstrap-tagsinput {
    min-height: 120px;
}
.label-info {
    background-color: #5bc0de;
    padding: 2px;
    border-radius: 3px;
}
.form-group.required .control-label:after {
        content: "*";
        margin: 10px;
        color: red;
}
</style>
