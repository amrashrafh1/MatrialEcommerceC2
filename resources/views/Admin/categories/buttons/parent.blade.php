@php
    $parent = \App\Category::where('id', $cat_id)->first();
@endphp
@if($parent == null)
<td>No Parent</td>
@else
<td>{{$parent->name}}</td>
@endif
