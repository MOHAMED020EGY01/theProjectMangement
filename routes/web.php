<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/dashboards');

Route::middleware([
    'lastActive',
])->group(function () {
    require __DIR__.'/dashboard/dashboard.php';
    require __DIR__.'/auth/socialLogin.php';
});