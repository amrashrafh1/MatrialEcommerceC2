
		<div class="actions">
            <div class="btn-group">
                @if($product_type == 'variable')
                <div class="mr-3">
                    <li class="list-unstyled">
                        <a href="{{ route('seller_frontend_products_variations', $slug)}}" class="btn btn-primary"><i class="fe fe-plus"></i> {{trans('admin.Variations')}}</a>
                    </li>
                </div>
                @endif
                @if($has_accessories == 'yes')
                <div class="mr-3">
                    <li class="list-unstyled">
                        <a href="{{ route('seller_frontend_products_accessories', $slug)}}" class="btn btn-primary"><i class="fe fe-plus"></i> {{trans('admin.add_accessories')}}</a>
                    </li>
                </div>
                @endif

                <div class="mr-3">
                    <li class="list-unstyled">
                        <a href="{{route('seller_add_discount',$id)}}" class="btn btn-success"><i class="fe fe-plus"></i> {{trans('user.add_discount')}}</a>
                    </li>
                </div>
                <div class="pull-right"  style="
                background-color: #999999;
                border-color: #999999;
                box-shadow: 0 2px 2px 0 rgba(153, 153, 153, 0.14), 0 3px 1px -2px rgba(153, 153, 153, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);
            ">
                    <a class="btn btn-default btn-outlines btn-circle" style="color: #fff !important;" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                    {{ trans('admin.actions') }}
                            <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right p-2">
                            <li class='padding:10px;'>
                                    <a href="{{ route('seller_frontend_products_edit', $slug)}}"><i class="fe fe-edit"></i> {{trans('admin.edit')}}</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                    <a href="{{ route('show_product', $slug)}}"><i class="fa fa-eye"></i> {{trans('admin.show')}}</a>
                            </li>
                            <li>
                                    <a data-toggle="modal" data-target="#delete_record{{$id}}" href="#">
                    <i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                            </li>
                    </ul>
                </div>
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
                                    'route' => ['seller_frontend_products_delete', $slug]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                            </div>
                    </div>
            </div>
    </div>
