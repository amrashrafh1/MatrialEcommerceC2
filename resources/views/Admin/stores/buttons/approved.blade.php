@if(!$approved)
<a href='{{route('show_app', $id)}}' class='btn btn-info'>@lang('admin.accept')</a>
@else
<a href='#' disabled class='disabled btn btn-dark'>@lang('admin.approved')</a>
@endif
