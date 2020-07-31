@php
    $product = \App\Product::where('id', $product_id)->first();
@endphp
@if(!empty($product))
<a href="{{ route('products.edit',$product->id) }}">{{$product->name}}</a>
@endif
