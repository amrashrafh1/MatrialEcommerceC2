@extends('layouts.app')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>{{$store->name}} @lang('user.dashboard')
            </nav>
            @include('sweetalert::alert')
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area" style="flex: 0 0 100%;
            max-width: 100%;
            order: 2;">
                <main id="main" class="site-main">
                    <div class="shop-archive-header" wire:ignore>
                        <div class="jumbotron">
                            <div class="jumbotron-img">
                                <img width="416" height="283" alt="" src="{{Storage::url($store->image)}}"
                                    class="jumbo-image alignright">
                            </div>
                            <div class="jumbotron-caption">
                                <h3 class="jumbo-title">{{$store->name}}</h3>
                                <p class="jumbo-subtitle">

                                </p>
                            </div>
                            <!-- .jumbotron-caption -->
                        </div>
                        <!-- .jumbotron -->
                    </div>
                </main>
                <div class="">
                    <!-- .handheld-sidebar-toggle -->
                    <h1 class="woocommerce-products-header__title page-title">@lang('user.dashboard')</h1>

                    @include('FrontEnd.sellers.navs')
                    <!-- .shop-view-switcher -->
                    <!-- .techmarket-advanced-pagination -->
                </div>
                <div class="tab-content mt-5">
                    <!-- .tab-pane -->
                    <div id="grid-extended" class="tab-pane active" role="tabpanel">
                        {!! Form::open([
                            "method" => "delete",
                            "url" => [route('seller_frontend_products_destroy_all')],
                            'id' => 'form_data'
                            ]) !!}
                        {!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mutlipleDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title">{{trans("admin.delete")}} </h4>
            </div>
            <div class="modal-body">
                <div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("admin.ask-delete")}}
                    <span id="count"></span> {{trans("admin.record")}} ! </div>
                <div class="check_delete">{{trans("admin.check-delete")}}</div>
            </div>
            <div class="modal-footer">
                {!! Form::submit(trans("admin.approval"), ["class" => "btn btn-danger del_all"]) !!}
                <a class="btn btn-default" data-dismiss="modal">{{trans("admin.cancel")}}</a>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection

@push('js')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{url("/js/dataTables.buttons.min.js")}}"></script>
<script src="{{url("/js/buttons.server-side.js")}}"></script>
{!! $dataTable->scripts() !!}
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
        delete_all();
        </script>
@endpush
