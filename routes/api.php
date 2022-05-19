<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\TiketController;
use App\Http\Controllers\Api\WisataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// protected routes
Route::middleware('auth:sanctum')->group(function () {
    // route auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // route kategori
    Route::post('/kategori', [KategoriController::class, 'storeKategori']);
    Route::get('/kategori', [KategoriController::class, 'getKategori']);
    // route wisata
    Route::post('/wisata', [WisataController::class, 'storeWisata']);
    Route::get('/wisata', [WisataController::class, 'getWisata']);
    Route::get('/wisata/{id}', [WisataController::class, 'getWisataById']);
    Route::post('/update/wisata/{id}', [WisataController::class, 'updateWisata']);
    Route::delete('/delete/wisata/{id}', [WisataController::class, 'deleteWisata']);
    // route booking
    Route::post('/booking', [BookingController::class, 'storeBooking']);
    Route::get('/booking', [BookingController::class, 'getBooking']);
    Route::get('/booking/{id}', [BookingController::class, 'getBookingById']);
    // route tiket
    Route::get('/tiket/{id}', [TiketController::class, 'getTiketById']);
});
