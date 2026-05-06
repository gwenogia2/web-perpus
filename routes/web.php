<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\AnggotaController;
use App\Http\Controllers\Master\BukuController;
use App\Http\Controllers\Transaksi\TransaksiController;


Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth.check'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    // CRUD ANGGOTA
    Route::get('/anggota', [AnggotaController::class, 'index']);
    Route::get('/anggota/create', [AnggotaController::class, 'create']);
    Route::post('/anggota/store', [AnggotaController::class, 'store']);
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit']);
    Route::post('/anggota/update/{id}', [AnggotaController::class, 'update']);
    Route::get('/anggota/delete/{id}', [AnggotaController::class, 'destroy']);

    //CRUD BUKU
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/create', [BukuController::class, 'create']);
    Route::post('/buku/store', [BukuController::class, 'store']);
    Route::get('/buku/edit/{id}', [BukuController::class, 'edit']);
    Route::post('/buku/update/{id}', [BukuController::class, 'update']);
    Route::get('/buku/delete/{id}', [BukuController::class, 'destroy']);

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);
    Route::post('/transaksi/store', [TransaksiController::class, 'store']);
    Route::get('/transaksi/kembali/{id}', [TransaksiController::class, 'kembali']);

    Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail']);

});


