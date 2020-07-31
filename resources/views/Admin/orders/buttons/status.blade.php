@if($status == 'pending')
<span class="p-2" style="color:#fff; background: #FF9800; border-radius: 5px;">@lang('admin.pending')</span>
@elseif($status == 'completed')
    <span class="bg-success p-2" style="color:#fff;  border-radius: 5px;">@lang('admin.completed')</span>
@else
    <span class="bg-danger p-2" style="color:#fff;  border-radius: 5px;">@lang('admin.canceled')</span>

@endif
