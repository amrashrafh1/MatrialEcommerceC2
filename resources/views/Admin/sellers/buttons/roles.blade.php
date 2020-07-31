@php
    $user = \App\User::where('id',$id)->first();
@endphp
@foreach($user->roles as $role)
{{$role->display_name}}
@endforeach
