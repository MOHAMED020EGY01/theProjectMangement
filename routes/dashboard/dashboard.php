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
});
// Route::resource('companies',CompanyController::class);
require __DIR__.'/task/task.php';
