@php
    $family = \App\Attribute_Family::where('id', $id)->first();
@endphp
{{$family->name}}
