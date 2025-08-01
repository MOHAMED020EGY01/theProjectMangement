<?php

use App\Http\Controllers\Dashboard\ChatController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'chat.'
],function () {
    Route::group([
        'middleware' => 'auth'
    ],function () {
        Route::get('/chat', [ChatController::class, 'index'])->name('index');
        Route::get('/chat/messages/{user}', [ChatController::class, 'fetchMessages'])->name('messages');
        Route::post('/chat/send/{user}', [ChatController::class, 'sendMessage'])->name('send');
    });
});