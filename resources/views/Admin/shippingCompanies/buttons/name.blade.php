@php
    $mall = \App\ShippingCompany::where('id', $id)->first();
@endphp
{{$mall->name}}
