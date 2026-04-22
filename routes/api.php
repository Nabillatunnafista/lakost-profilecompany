<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KostApiController;
use App\Http\Controllers\Api\KategoriApiController;
use App\Http\Controllers\Api\WilayahApiController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\PembayaranApiController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/kost', [KostApiController::class, 'index']);
Route::get('/kost/{id}', [KostApiController::class, 'show']);

Route::get('/kategori', [KategoriApiController::class, 'index']);

Route::get('/wilayah', [WilayahApiController::class, 'index']);

Route::get('/booking', [BookingApiController::class, 'index']);
Route::post('/booking', [BookingApiController::class, 'store']);

Route::get('/pembayaran', [PembayaranApiController::class, 'index']);
Route::post('/pembayaran', [PembayaranApiController::class, 'store']);