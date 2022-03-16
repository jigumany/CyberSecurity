<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Admin Login Routes
Route::get('login', [LoginController::class, 'index'])->name('admin.login');
Route::post('login', [LoginController::class, 'store'])->name('login.store')->middleware('guest');
Route::delete('logout', [LoginController::class, 'destroy'])->name('logout');





Route::middleware('admin')->group(function(){
    Route::get('/', [DashboardController::class, 'create']);
});



