        @if(\App\User::find($id)->seller_info !== null)
            <a class="btn btn-success" href="{{route('show_app',$id)}}">@lang('admin.new_seller_application')</a>
        @endif
            <div class="actions">
				<div class="btn-group">
						<a class="btn btn-default btn-outlines btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
								<i class="fa fa-wrench"></i>
						{{ trans('admin.actions') }}
								<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
								<li>
									<a href="{{ route('user.edit', $id)}}"><i class="material-icons">
                                        edit
                                        </i> {{trans('admin.edit')}}</a>
								</li>
								<li class="divider"> </li>

								<li>
                                    <a data-toggle="modal" data-target="#delete_record{{$id}}" href="#">
                                    <i class="material-icons">restore_from_trash</i> {{trans('admin.delete')}}</a>
								</li>
						</ul>
				</div>
		</div>
		<div class="modal fade" id="delete_record{{$id}}">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
								</div>
								<div class="modal-body">
										<i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$id}}) ؟
								</div>
								<div class="modal-footer">
										{!! Form::open([
										'method' => 'DELETE',
										'route' => ['user.destroy', $id]
										]) !!}
										{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
										<a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
										{!! Form::close() !!}
								</div>
						</div>
				</div>
		</div>
