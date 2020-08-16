@if(!$approved)
<a href='{{route('products.approved', $id)}}' class='btn btn-info'>@lang('admin.accept')</a>
@else
<a href='#' disabled class='disabled btn btn-dark'>@lang('admin.approved')</a>
@endif
