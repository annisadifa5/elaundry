<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\LacakController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\KaryawanController;


//AUTH
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.register'))->name('register');

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//RESERVASI
Route::prefix('reservasi')->name('reservasi.')->group(function () {
    Route::get('/', [ReservasiController::class, 'create'])->name('create');
    Route::post('/', [ReservasiController::class, 'store'])->name('store');
});

//PEMESANAN
Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
    Route::get('/', fn () => view('pemesanan.create'))->name('create');
    Route::post('/', [PemesananController::class, 'store'])->name('store');
    Route::get('/{id}', [PemesananController::class, 'show'])->name('show');
    Route::patch('/{id}/status', [PemesananController::class, 'updateStatus'])
        ->name('updateStatus');
});

//LACAK PEMESANAN 
Route::get('/lacak', [LacakController::class, 'index'])->name('lacak.index');

//RIWAYAT PEMESANAN
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

//MANAJEMEN PROMO
Route::prefix('manajemen')->name('manajemen.')->group(function () {
    Route::get('/', [PromoController::class, 'index'])->name('indexpromo');
    Route::get('/create', [PromoController::class, 'create'])->name('createpromo');
});

//PENGATURAN OUTLET
Route::prefix('outlet')->group(function () {
    Route::get('/', [OutletController::class, 'index'])->name('outlet.index');

    Route::get('/create', [OutletController::class, 'create'])->name('outlet.create');
    Route::post('/', [OutletController::class, 'store'])->name('outlet.store');

    Route::get('/{id}', [OutletController::class, 'show'])->name('outlet.show');
});

// PENGATURAN KARYAWAN
Route::prefix('pengaturan/karyawan')->name('karyawan.')->group(function () {

    Route::get('/', [KaryawanController::class, 'index'])->name('index');

    Route::get('/create', [KaryawanController::class, 'create'])->name('create');
    Route::post('/', [KaryawanController::class, 'store'])->name('store');

    Route::get('/{id}', [KaryawanController::class, 'show'])->name('show');
    Route::put('/{id}', [KaryawanController::class, 'update'])->name('update');
    Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('destroy');
});


