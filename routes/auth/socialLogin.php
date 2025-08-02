<?php

use App\Http\Controllers\Auth\CompleteRegisterController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::get('auth/{provider}', [SocialLoginController::class, 'redirect'])
->name('auth.redirect');

Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])
->name('auth.callback');


Route::get('complete-register', [CompleteRegisterController::class, 'index'])
->name('complete.register');

Route::post('complete-register', [CompleteRegisterController::class, 'store'])
->name('complete.register');