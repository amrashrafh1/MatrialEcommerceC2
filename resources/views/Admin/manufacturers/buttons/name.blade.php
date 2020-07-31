@php
    $mall = \App\Manufacturer::where('id', $id)->first();
@endphp
{{$mall->name}}
