<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// Admin Login Routes
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'store'])->name('login.store')->middleware('guest');
Route::delete('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('admin');


// Only logged in admins can see these pages
Route::middleware('admin')->group(function(){

    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/modules', [ModuleController::class, 'index']);
    Route::get('/topics', [TopicController::class, 'index']);
    Route::get('/managers', [ManagerController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);

    // Admins
    Route::get('admins', [AdminController::class, 'index'])
        ->name('admins');
    Route::get('admins/create', [AdminController::class, 'create'])
        ->name('admins.create');
    Route::post('admins', [AdminController::class, 'store'])
        ->name('admins.store');
    Route::get('admins/{user}/edit', [AdminController::class, 'edit'])
        ->name('admins.edit');
    Route::put('admins/{user}', [AdminController::class, 'update'])
        ->name('admins.update');
    Route::delete('admins/{user}', [AdminController::class, 'destroy'])
        ->name('admins.destroy');
    Route::put('admins/{user}/restore', [AdminController::class, 'restore'])
        ->name('admins.restore');

    // Organizations
    Route::get('modules', [ModuleController::class, 'index'])
        ->name('modules');
    Route::get('modules/create', [ModuleController::class, 'create'])
        ->name('modules.create');
    Route::post('modules', [ModuleController::class, 'store'])
        ->name('modules.store');
    Route::get('modules/{module}/edit', [ModuleController::class, 'edit'])
        ->name('modules.edit');
    Route::put('modules/{module}', [ModuleController::class, 'update'])
        ->name('modules.update');
    Route::delete('modules/{module}', [ModuleController::class, 'destroy'])
        ->name('modules.destroy');
    Route::put('modules/{module}/restore', [ModuleController::class, 'restore'])
        ->name('modules.restore');
});





