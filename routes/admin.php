<?php

use App\Http\Controllers\Admin\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Admin Login Routes
Route::group(['middleware' => ['guest']], function () {
  Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
});



