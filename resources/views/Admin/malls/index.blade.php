@extends('Admin.layouts.app', ['activePage' => 'mall-management', 'titlePage' =>trans('admin.malls')])
		@section('content')
		<div class="container-fluid mt-6 pt-8">
				<div class="col-md-12">
                        @include('sweetalert::alert')
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
                                        "url" => [route('malls_destroy_all')],
                                        'id' => 'form_data'
										]) !!}
										{!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable dataTable no-footer"],true) !!}
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
												<div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("admin.ask-delete")}} <span id="count"></span> {{trans("admin.record")}} ! </div>
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
        </script>
        {!! $dataTable->scripts() !!}
		@endpush
		{!! Form::close() !!}
		@stop
