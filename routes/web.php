<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GovernmentStructureController;
use App\Http\Controllers\PageController;


// Public Frontend Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profil', [PageController::class, 'profile'])->name('profile');
Route::get('/berita', [PageController::class, 'articlesIndex'])->name('articles.index');
Route::get('/berita/{article:slug}', [PageController::class, 'articleShow'])->name('articles.show');

Route::get('/panduan', [PageController::class, 'guidesIndex'])->name('guides.index');
Route::get('/panduan/{guide:slug}', [PageController::class, 'guideShow'])->name('guides.show');

Route::get('/kegiatan', [PageController::class, 'eventsIndex'])->name('events.index');

Route::get('/galeri', [PageController::class, 'galleriesIndex'])->name('galleries.index');

Route::get('/kontak', [PageController::class, 'contactCreate'])->name('contact.create');
Route::post('/kontak', [PageController::class, 'contactStore'])->name('contact.store');

// Generic data table page template
Route::get('/data-kegiatan', [PageController::class, 'dataTablePage'])->name('data.table');

/*
Route::get('/', function () {
    return view('welcome');
});
*/

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