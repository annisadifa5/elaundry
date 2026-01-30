<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//DASHBOARD
Route::get('/dashboard', function () {return view('dashboard.index');})->name('dashboard')->middleware('auth');

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
    Route::get('/show', function () { return view('manajemen.showpromo'); })->name('show');});

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


