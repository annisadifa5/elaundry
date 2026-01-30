<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PembayaranController;

Route::post('/pemesanan', [PemesananController::class, 'store']);
Route::get('/pemesanan/{id}', [PemesananController::class, 'show']);
Route::patch('/pemesanan/{id}/status', [PemesananController::class, 'updateStatus']);

Route::get('/customers', [CustomerController::class, 'index']);

Route::post('/pembayaran', [PembayaranController::class, 'store']);
