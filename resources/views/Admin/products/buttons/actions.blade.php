<div class="actions">
    <div class="btn-group">
        <div class="pull-right">
            <a class="btn btn-default btn-outlines btn-circle btn-sm" href="javascript:;" data-toggle="dropdown"
                data-hover="dropdown" data-close-others="true" aria-expanded="false">
                <i class="fa fa-wrench"></i>
                {{ trans('admin.actions') }}
                <i class="fa fa-angle-down"></i>
                <span class='badge bg-danger p-1 ml-1' style='font-size:14px;'>{{$model->getNotApprovedRatings($id, 'desc')->count()}}</span>
            </a>
            <ul class="dropdown-menu pull-right">
                <li class='p-2'>
                    <a href="{{ route('products.edit', $id)}}"><i
                        class="material-icons">
                        edit
                    </i> {{trans('admin.edit')}}</a>
                </li>
                <li class="divider"> </li>
                <li class='p-2'>
                    <a href="{{ route('show_product', $slug)}}" target="_blank"><i class="fa fa-eye"></i> {{trans('admin.show')}}</a>
                </li>
                @if($product_type == 'variable')
                <li class="list-unstyled">
                    <a href="{{ route('product_variations', $id)}}"><i class="material-icons">
                        list
                    </i>
                        {{trans('admin.Variations')}}</a>
                </li>
                @endif
                @if($has_accessories == 'yes')
                <li class="list-unstyled mt-3">
                    <a href="{{ route('add_accessories', $id)}}">
                        <i class="material-icons">
                            store
                        </i>
                        {{trans('admin.accessories')}}</a>
                </li>
                @endif
                @if($model->getNotApprovedRatings($id, 'desc')->count())
                <li class="list-unstyled mt-3">
                    <a href="{{ route('products.reviews', $id)}}">
                        <i class="material-icons">
                            edit_attributes
                        </i>
                        {{trans('admin.reviews')}}</a>
                </li>
                @endif
                <li class='p-2'>
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
                'route' => ['products.destroy', $id]
                ]) !!}
                {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
