<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonsController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;

// ============================================
// ROUTE HALAMAN UTAMA
// ============================================
Route::get('/', [PublicController::class, 'index'])->name('home');

// ============================================
// ROUTE DASHBOARD
// ============================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ============================================
// ROUTE PROFILE
// ============================================
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// ============================================
// ROUTE WEBGIS UMKM BARUREJO
// ============================================
Route::get('/map', [MapController::class, 'index'])->name('map');
Route::get('/table', [TableController::class, 'index'])->name('table');

// Route tambahan untuk navigasi
Route::get('/umkm', [PublicController::class, 'umkm'])->name('umkm');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// ============================================
// ROUTE CRUD POINT, POLYLINE, POLYGON
// ============================================
Route::resource('points', PointsController::class);
Route::resource('polylines', PolylinesController::class);
Route::resource('polygons', PolygonsController::class);

// ============================================
// ROUTE API UNTUK WEBGIS
// ============================================
Route::prefix('api')->group(function () {
    // UMKM
    Route::get('/umkm', [ApiController::class, 'umkm'])->name('api.umkm');
    Route::get('/umkm/{id}', [ApiController::class, 'umkmDetail'])->name('api.umkm.detail');
    Route::get('/umkm/category/{category}', [ApiController::class, 'umkmByCategory'])->name('api.umkm.category');
    Route::get('/umkm/stats', [ApiController::class, 'umkmStats'])->name('api.umkm.stats');
    Route::get('/umkm/search', [ApiController::class, 'umkmSearch'])->name('api.umkm.search');

    // Points
    Route::get('/points', [ApiController::class, 'points'])->name('api.points');
    Route::get('/points/{id}', [ApiController::class, 'pointDetail'])->name('api.points.detail');

    // Polylines
    Route::get('/polylines', [ApiController::class, 'polylines'])->name('api.polylines');
    Route::get('/polylines/{id}', [ApiController::class, 'polylineDetail'])->name('api.polylines.detail');

    // Polygons
    Route::get('/polygons', [ApiController::class, 'polygons'])->name('api.polygons');
    Route::get('/polygons/{id}', [ApiController::class, 'polygonDetail'])->name('api.polygons.detail');
});

// ============================================
// ROUTE AUTH (BAWAAN LARAVEL)
// ============================================
require __DIR__ . '/auth.php';
