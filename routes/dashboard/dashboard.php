<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboards',[DashboardController::class,'index'])->name('dashboard');
Route::group([
    'prefix'=>'dashboard',
    'as'=>'dashboard.'
],function(){
    /**
     * Project Routes
     */
    Route::resource('project',ProjectController::class);

    /**
     * Task Routes
     */
    Route::group([
        'prefix'=>'project',
        'as'=>'project.'
    ],function(){
        Route::get('{project_id}/tasks',[TaskController::class,'index'])->name('tasks.index');
        Route::get('{project_id}/tasks/{task_id}',[TaskController::class,'show'])->name('tasks.show');
        Route::get('{project_id}/tasks/create',[TaskController::class,'create'])->name('tasks.create');
        Route::post('{project_id}/tasks',[TaskController::class,'store'])->name('tasks.store');
        Route::get('{project_id}/tasks/{task_id}/edit',[TaskController::class,'edit'])->name('tasks.edit');
        Route::put('{project_id}/tasks/{task_id}',[TaskController::class,'update'])->name('tasks.update');
        Route::delete('{project_id}/tasks/{task_id}',[TaskController::class,'destroy'])->name('tasks.destroy');
    });
    
});
// Route::resource('companies',CompanyController::class);

