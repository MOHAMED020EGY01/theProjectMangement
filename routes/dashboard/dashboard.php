<?php

use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboard');

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'middleware'=>'password.confirm'
], function () {
    Route::resource('company',CompanyController::class);
    /**
     * Project Routes
     */
    Route::resource('project', ProjectController::class);

    /**
     * Task Routes
     */
    Route::group([
        'prefix' => 'project',
        'as' => 'project.',
        
    ], function () {
        Route::delete('{project_id}/tasks/{task_id}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::patch('{project_id}/tasks/{task_id}/update', [TaskController::class, 'update'])->name('tasks.update');
        Route::get('{project_id}/tasks/{task_id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::get('{project_id}/tasks/{task_id}/show', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('{project_id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::get('{project_id}/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('{project_id}/tasks', [TaskController::class, 'store'])->name('tasks.store');

    });
});

/**
 * Comment Routes
 */
Route::group([
    'prefix'=>'tasks',
    'as'=>'tasks.'
],function(){
    Route::post('{task}/comments', [CommentController::class, 'store'])->name('comments.store');
});
require __DIR__ . '/chat.php';