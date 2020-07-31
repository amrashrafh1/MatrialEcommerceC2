@php
    $seller = \App\User::find($user_id);
@endphp
<a href="{{route('seller.edit', $user_id)}}">{{$seller->name}}</a>
