@php
    $order = \App\Order::find($order_id);
@endphp
<div class="actions">
    <div class="btn-group">
            <a class="btn btn-default btn-outlines btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                    <i class="fa fa-wrench"></i>
            {{ trans('admin.actions') }}
                    <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                <li class="p-2">
                    <a href="{{ route('seller_frontend_orders_show', $order->id)}}"><i class="fa fa-eye"></i> {{trans('admin.show')}}</a>
                </li>
                <li class="p-2">
                    <a href="{{ route('export_invoice', $id)}}" class="p-1"><i class="fa fa-file-pdf-o"></i> {{trans('admin.invoice')}}</a>
                </li>
            </ul>
    </div>
</div>
