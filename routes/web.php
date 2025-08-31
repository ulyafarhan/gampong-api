<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GovernmentStructureController;


Route::get('/', function () {
    return view('welcome');
});

// Admin Authentication
Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('admin/login', [AuthController::class, 'login']);
});

// Admin Panel Routes
Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Resourceful CRUD routes
    Route::resource('articles', ArticleController::class);
    Route::resource('guides', GuideController::class);
    Route::resource('events', EventController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('government-structures', GovernmentStructureController::class);
});