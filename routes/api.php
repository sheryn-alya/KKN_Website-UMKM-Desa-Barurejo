<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ============================================
// ROUTE UMKM
// ============================================
Route::get('/umkm', [ApiController::class, 'umkm']);
Route::get('/umkm/{id}', [ApiController::class, 'umkmDetail']);
Route::get('/umkm/category/{category}', [ApiController::class, 'umkmByCategory']);
Route::get('/umkm/stats', [ApiController::class, 'umkmStats']);
Route::get('/umkm/search', [ApiController::class, 'umkmSearch']);

// ============================================
// ROUTE POINT
// ============================================
Route::get('/points', [ApiController::class, 'points']);
Route::get('/points/{id}', [ApiController::class, 'pointDetail']);

// ============================================
// ROUTE POLYLINE
// ============================================
Route::get('/polylines', [ApiController::class, 'polylines']);
Route::get('/polylines/{id}', [ApiController::class, 'polylineDetail']);

// ============================================
// ROUTE POLYGON
// ============================================
Route::get('/polygons', [ApiController::class, 'polygons']);
Route::get('/polygons/{id}', [ApiController::class, 'polygonDetail']);
