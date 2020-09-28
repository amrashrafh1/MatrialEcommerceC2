@extends('Admin.layouts.app', ['activePage' => 'methods-management', 'titlePage' => trans('admin.methods')])
@section('content')
<div class="container-fluid mt-6 pt-8">
    <div class="col-md-12">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger"> {{$error}}</div>
        @endforeach
        @endif
        <div class="widget-extra body-req card light bordered">
            <div class="card-header card-header-primary">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a href="{{aurl('/methods')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger"> {{$error}}</div>
                    @endforeach
                    @endif
                    {!!
                    Form::open(['url'=>route('methods.rates_store',
                    $method->id),'method'=>'post','id'=>'users','class'=>'form-horizontal
                    form-row-seperated', 'id' =>'create-methods']) !!}

                    <ol id="list">
                        <li class="list_var">
                            <div class="form-group">
                                <div class="col-md-12 row" id='list_0'>
                                    <div class='col m-1'>
                                    <input type='number' value='{{old('from')}}' name='from[]' placeholder='{{trans('admin.range_from')}}' class='form-control'>
                                    </div>
                                    <div class='col m-1'>
                                        <input type='number' value='{{old('to')}}' name='to[]' placeholder='{{trans('admin.range_to')}}' class='form-control'>
                                    </div>
                                    <div class='col m-1'>
                                        <input type='number' value='{{old('value')}}' name='value[]' placeholder='{{trans('admin.cost')}}' class='form-control'>
                                    </div>
                                </div>
                            </div>
                            {{-- <button class="list_del btn btn-danger"><i class='fa fa-trash'></i></button> --}}
                        </li>
                    </ol>
                    <button type='button' class="list_add btn btn-primary"><i class='fa fa-plus'></i></button>

                    <br />
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        {!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script type="text/javascript" src="{{ asset('/js/add-input-area.min.js')}}"></script>
<script>
$(document).ready(function() {
	var max_fields      = 20; //maximum input boxes allowed
	var wrapper   		= $("#list"); //Fields wrapper
	var add_button      = $(".list_add"); //Add button ID

	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append("<li class='list_var'><div class='form-group'><div class='col-md-12 row' id='list_0'><div class='col m-1'><input type='number' value='{{old('from')}}' name='from[]' placeholder='{{trans('admin.range_from')}}' class='form-control'></div><div class='col m-1'><input type='number' value='{{old('to')}}' name='to[]' placeholder='{{trans('admin.range_to')}}' class='form-control'></div><div class='col m-1'><input type='number' value='{{old('value')}}' name='value[]' placeholder='{{trans('admin.cost')}}' class='form-control'></div></div></div><button class='list_del btn btn-danger'><i class='fa fa-trash'></i></button></li>"); //add input box
		}
	});

	$(wrapper).on("click",".list_del", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('li').remove(); x--;
	})
});
</script>
@endpush
@stop
