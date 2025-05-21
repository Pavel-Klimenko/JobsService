<?php
use Illuminate\Support\Facades\Route;
use App\Domains\Chat\Http\Controllers\ChatController;

Route::get('/chat', [ChatController::class, 'index']);
