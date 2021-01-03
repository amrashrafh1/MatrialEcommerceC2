<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('home', function ($message) {
    return $message;
});

Broadcast::channel('chat.{conv_id}', function ($message, $conv_id) {
    return $message;
});

Broadcast::channel('is-readed', function ($message_id) {
    return $message_id;
});
/* Broadcast::channel('status-offline', function ($user) {
    return $user->id;
});
*/

Broadcast::channel('status', function ($data) {
    return $data;
});


Broadcast::channel('new-seller', function ($message) {
    return $message;
});
Broadcast::channel('new-order', function ($message) {
    return $message;
});

Broadcast::channel('new-message.{id}', function ($message) {
    return $message;
});
