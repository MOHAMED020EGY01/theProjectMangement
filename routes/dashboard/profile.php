<?php

use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;

Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
