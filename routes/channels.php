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

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\ChatChannel;

//Broadcast::channel('chat', ChatChannel::class);

Broadcast::routes();

Broadcast::channel('chat', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});
