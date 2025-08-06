<?php

use App\Http\Controllers\Dashboard\TaskController;
use Illuminate\Support\Facades\Route;


    /**
     * Task Routes
     */
    Route::group([
        'prefix' => 'dashboard/project',
        'as' => 'dashboard.project.',
        
    ], function () {
        Route::delete('{project_id}/tasks/{task_id}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::patch('{project_id}/tasks/{task_id}/update', [TaskController::class, 'update'])->name('tasks.update');
        Route::get('{project_id}/tasks/{task_id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::get('{project_id}/tasks/{task_id}/show', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('{project_id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::get('{project_id}/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('{project_id}/tasks', [TaskController::class, 'store'])->name('tasks.store');

    });