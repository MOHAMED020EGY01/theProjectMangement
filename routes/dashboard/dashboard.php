<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboards',[DashboardController::class,'index'])->name('dashboard');
Route::group([
    'prefix'=>'dashboard',
    'as'=>'dashboard.'
],function(){
    Route::resource('project',ProjectController::class);
});
// Route::resource('companies',CompanyController::class);
// Route::resource('tasks',TaskController::class);

