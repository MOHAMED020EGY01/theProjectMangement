<?php

use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboard');

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    //'middleware'=>'password.confirm'
], function () {
    Route::resource('company',CompanyController::class);
    /**
     * Project Routes
     */
    Route::resource('project', ProjectController::class);
});

/**
 * Comment Routes
 */
Route::group([
    'prefix'=>'tasks',
    'as'=>'tasks.'
],function(){
    Route::any('{task}/comments', [CommentController::class, 'store'])->name('comments.store');
});

/**
 * Chat Routes
 */
require __DIR__ . '/chat.php';
/**
 * Notification Routes
 */
require __DIR__ . '/notification.php';
/**
 * Task Routes
 */
require __DIR__ . '/task.php';
/**
 * Profile Routes
 */
require __DIR__ .'/profile.php';
/**
 * User Routes
 */
require __DIR__ .'/user.php';