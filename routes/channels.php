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

//TODO сюда перенести класс с каналом!
\Illuminate\Support\Facades\Broadcast::channel('chat', function ($user) {
    //TODO проверка на авторизованного пользователя
    return true;
});
