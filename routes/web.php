<?php


use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ImagesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home route
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Images
    Route::get('/img/{path}', [ImagesController::class, 'show'])
        ->where('path', '.*')
        ->name('image');
});



