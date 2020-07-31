@if(empty($logo))
No Logo yet
@else
<img src="{{Storage::url($logo)}}" style="height:60px; width:100px;">
@endif
