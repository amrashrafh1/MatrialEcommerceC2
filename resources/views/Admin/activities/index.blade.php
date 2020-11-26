@extends('Admin.layouts.app', ['activePage' => 'activities-management', 'titlePage' => trans('admin.activities')])
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
										{!! $dataTable->table(["class"=> "dataTable table table-striped table-hover  table-bordered"],true) !!}
										<div class="clearfix"></div>
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
		@stop
