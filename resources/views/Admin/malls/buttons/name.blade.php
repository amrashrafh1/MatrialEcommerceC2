@php
    $mall = \App\Mall::where('id', $id)->first();
@endphp
{{$mall->name}}
