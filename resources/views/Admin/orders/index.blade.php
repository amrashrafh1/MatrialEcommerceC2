@extends('Admin.layouts.app', ['activePage' => 'orders', 'titlePage' => trans('admin.orders')])
		@section('content')
		<div class="container-fluid mt-6 pt-8">
                @include('sweetalert::alert')

				<div class="col-md-12">
						<div class="card light bordered">
								<div class="card-header">
										<div class="caption">
												<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
										</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
										{!! Form::open([
										"method" => "post",
                                        "url" => [route('orders_edit_all')],
                                        'id' => 'form_data'
										]) !!}
										{!! $dataTable->table(["class"=> "text-center w-100 table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}
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
												<h4 class="modal-title">{{trans("admin.edit")}} </h4>
										</div>
										<div class="modal-body">
                                            <div class="col-sm-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                <label class="form-label">Status:</label></div>
                                                <select class="form-control col-md-8" name="status">
                                                    <option value="completed">@lang('admin.completed')</option>
                                                    <option value="pending">@lang('admin.pending')</option>
                                                    <option value="canceled">@lang('admin.canceled')</option>
                                                </select>
                                            </div>
                                            </div>
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
        </script>
        {!! $dataTable->scripts() !!}
		@endpush
		{!! Form::close() !!}
		@stop
