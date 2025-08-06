<?php

use App\Http\Controllers\Dashboard\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/trach', [NotificationController::class, 'trach'])->name('notifications.trach');
Route::get('/notifications/unread', [NotificationController::class, 'unreadNotification'])->name('notifications.unread');
Route::get('/notifications/read', [NotificationController::class, 'readNotification'])->name('notifications.read');
Route::delete('/notifications/forceDeleteAll', [NotificationController::class, 'forceDeleteAll'])->name('notifications.forceDeleteAll');
Route::delete('/notifications/DeleteAll', [NotificationController::class, 'DeleteAll'])->name('notifications.DeleteAll');
Route::get('/notifications/read/massage/{notification_id}', [NotificationController::class, 'read'])->name('notifications.read.massage');
Route::put('/notifications/{notification_id}/restore', [NotificationController::class, 'restore'])->name('notifications.restore');
Route::delete('/notifications/{notification_id}', [NotificationController::class, 'delete'])->name('notifications.delete');
Route::delete('/notifications/{notification_id}/forceDelete', [NotificationController::class, 'forceDelete'])->name('notifications.forceDelete');
