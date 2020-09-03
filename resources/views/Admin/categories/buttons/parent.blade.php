@if($model->parent == null)
<td>@lang('admin.No_Parent')</td>
@else
<td>{{$model->parent->name}}</td>
@endif
