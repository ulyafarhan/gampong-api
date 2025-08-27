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

// Protected Routes (untuk Panel Admin)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/articles', [ArticleController::class, 'adminIndex']);
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
    Route::get('/admin/articles/{slug}', [ArticleController::class, 'showForAdmin']);
    
    // Guide Routes
    Route::apiResource('guides', GuideController::class)->except(['index', 'show']); // Cara praktis
    Route::get('/admin/guides', [GuideController::class, 'index']); // Endpoint admin
    Route::get('/admin/guides/{slug}', [GuideController::class, 'show']);

    // Event Routes
    Route::get('/admin/events', [EventController::class, 'adminIndex']);
    Route::apiResource('events', EventController::class)->except(['index', 'show']);
    Route::get('/admin/events/{slug}', [EventController::class, 'show']);

    // Gallery Routes
    Route::apiResource('galleries', GalleryController::class)->except(['index', 'show']);
    Route::get('/admin/galleries', [GalleryController::class, 'index']);
    Route::get('/admin/galleries/{id}', [GalleryController::class, 'show']);

    // Government Structure Routes
    Route::apiResource('government-structures', GovernmentStructureController::class)->except(['index', 'show']);
    Route::get('/admin/government-structures', [GovernmentStructureController::class, 'index']);
    Route::get('/admin/government-structures/{id}', [GovernmentStructureController::class, 'show']);
});