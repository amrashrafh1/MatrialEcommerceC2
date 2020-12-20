<div class="actions">
    <div class="btn-group">
        @if($product_type == 'variable')
        <div class="mr-3">
            <li class="list-unstyled">
                <a href="{{ route('seller_frontend_products_variations', $slug)}}" class="btn btn-primary btn-sm"><i
                        class="fe fe-plus"></i> {{trans('admin.Variations')}}</a>
            </li>
        </div>
        @endif
        @if($has_accessories == 'yes')
        <div class="mr-3">
            <li class="list-unstyled">
                <a href="{{ route('seller_frontend_products_accessories', $slug)}}" class="btn  btn-primary btn-sm"><i class="fe fe-plus"></i>
                    {{trans('admin.accessories')}}</a>
            </li>
        </div>
        @endif
        <div class="pull-right">
            <a class="btn btn-default btn-outlines btn-circle btn-sm" href="javascript:;" data-toggle="dropdown"
                data-hover="dropdown" data-close-others="true" aria-expanded="false">
                <i class="fa fa-wrench"></i>
                {{ trans('admin.actions') }}
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                <li class='p-2'>
                    <a href="{{ route('seller_frontend_products_edit', $slug)}}"><i class="fe fe-edit"></i> {{trans('admin.edit')}}</a>
                </li>
                <li class="divider"> </li>
                <li class='p-2'>
                    <a href="{{ route('show_product', $slug)}}" target="_blank"><i class="fa fa-eye"></i> {{trans('admin.show')}}</a>
                </li>
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
                'route' => ['seller_frontend_products_delete', $slug]
                ]) !!}
                {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
