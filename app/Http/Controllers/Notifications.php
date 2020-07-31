<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;

class Notifications extends Controller
{
    public  function notification() {
        $user = auth()->user();

        broadcast(new NewNotification($user))->toOthers();
    }
}
