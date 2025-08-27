<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\GuideController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GovernmentStructureController;
// Import controller lainnya di sini...

// Public Routes (untuk frontend Astro)
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{slug}', [ArticleController::class, 'show']);
Route::get('/guides', [GuideController::class, 'index']);
Route::get('/guides/{slug}', [GuideController::class, 'show']);
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{slug}', [EventController::class, 'show']);
Route::get('/galleries', [GalleryController::class, 'index']);
Route::get('/galleries/{id}', [GalleryController::class, 'show']);
Route::get('/government-structures', [GovernmentStructureController::class, 'index']);
Route::get('/government-structures/{id}', [GovernmentStructureController::class, 'show']);

// Tambahkan route publik lainnya di sini

// The protected routes for admin panel are now managed in routes/web.php