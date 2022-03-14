<?php


use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home route
Route::group(['middleware' => ['guest']], function () {
  Route::get('/', [HomeController::class, 'index'])->name('home');
});

