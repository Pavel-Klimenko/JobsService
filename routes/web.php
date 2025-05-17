<?php
use App\Domains\Chat\Http\Controllers\ChatController;

Route::group(['prefix' => 'chat', 'controller' => ChatController::class], function () {
    Route::get('/', 'index');
    Route::get('/messages', 'messages');
    Route::post('/send', 'send');
});

