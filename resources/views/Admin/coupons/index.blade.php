@extends('Admin.layouts.app', ['activePage' => 'coupons-management', 'titlePage' => trans('admin.coupons')])
@section('content')
<div class="container-fluid mt-5 pt-8">
    <div class="col-md-12">
        @include('sweetalert::alert')
        <div class="card light bordered">
            @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger"> {{$error}}</div>
            @endforeach
            @endif
            <div class="card-header">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {!! Form::open([
                    "method" => "post",
                    "url" => [route('coupons_destroy_all')],
                    'id' => 'form_data'
                    ]) !!}
                    {!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable
                    dataTable no-footer"],true) !!}
                    <div class="clearfix"></div>
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
</div>
@push('js')
<script>
    delete_all();
    $('.coupon').on('click', function () {
        console.log('asdf')
        $('#coupon').modal('show');
    })

</script>
{!! $dataTable->scripts() !!}
@endpush
{!! Form::close() !!}

<!-- Modal -->
<div class="modal fade" id="coupon" tabindex="-1" role="dialog" aria-labelledby="coupon" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coupon">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    {!!
                    Form::open(['url'=>route('coupons.store'),'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('rules',trans('admin.rules'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-12">
                            {!!
                            Form::select('rules',[
                            'all_users'=> trans('admin.all_users'),'new_sign_up' => trans('admin.new_sign_up'),
                            'specific_user' => trans('admin.specific_user')
                            ],old('rules'),['class'=>'form-control','id'=>'rules','placeholder'=>trans('admin.rules')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row" id='user_id'>
                        <div class="col-md-12">
                            {!! Form::label('user_id',trans('admin.user_email'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-12">
                            {!!
                            Form::email('user_id',old('user_id'),['class'=>'form-control','id'=>'user_id','placeholder'=>trans('admin.user_email')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('expire_at',trans('admin.expire_at_number_of_days'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-12">
                            {!!
                            Form::number('expire_at',old('expire_at'),['class'=>'form-control','placeholder'=>trans('admin.expire_at_number_of_days')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('amount',trans('admin.Number_of_promocodes_to_generate'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-12">
                            {!!
                            Form::dateTime('amount',old('amount'),['class'=>'form-control
                            datetimepicker','placeholder'=>trans('admin.Number_of_promocodes_to_generate'), 'max' => 10000])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('is_usd',trans('admin.type'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-12">
                            {!!
                            Form::select('is_usd',[
                            'is_usd'=> trans('admin.USD'),'percentage' => trans('admin.percentage')
                            ],old('is_usd'),['class'=>'form-control','id'=>'Type','placeholder'=>trans('admin.type')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('reward',trans('admin.reward_USD'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-12">
                            {!!
                            Form::number('reward',old('reward'),['class'=>'form-control','placeholder'=>trans('admin.reward_USD')])
                            !!}
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('quantity',trans('admin.quantity_if_null'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-12">
                            {!!
                            Form::number('quantity',old('quantity'),['class'=>'form-control','placeholder'=>trans('admin.quantity')])
                            !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">@lang('user.save')</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
@push('js')
<script>
    $('#rules').on('change', function (e) {
        if($(this).val() == 'all_users' || $(this).val() == 'new_sign_up') {
            $('#user_id').hide();
        } else {
            $('#user_id').show();
        }
    });
</script>
@endpush
