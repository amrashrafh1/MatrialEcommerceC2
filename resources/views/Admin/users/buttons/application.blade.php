@php
    $store = $model->stores->where('approved', 0)->first();
@endphp
@if($store)
<p class='notification'>
<a href='{{route('show_app', $store->id)}}' class='btn btn-success'>@lang('admin.new_seller_application')</a>
    <span class='badge'>{{$model->stores->count()}}</span>
</p>
@endif

