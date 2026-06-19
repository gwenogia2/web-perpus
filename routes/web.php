<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Master\AnggotaController;
use App\Http\Controllers\Master\BukuController;

use App\Http\Controllers\Transaksi\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

//auth
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);


//ADMIN
Route::middleware(['auth.check', 'role:admin'])->group(function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard-siswa', [DashboardController::class, 'siswa']);

    //user
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/create', [UserController::class, 'create']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'destroy']);

    //anggota
    Route::get('/anggota', [AnggotaController::class, 'index']);
    Route::get('/anggota/create', [AnggotaController::class, 'create']);
    Route::post('/anggota/store', [AnggotaController::class, 'store']);

    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit']);
    Route::post('/anggota/update/{id}', [AnggotaController::class, 'update']);

    Route::get('/anggota/delete/{id}', [AnggotaController::class, 'destroy']);


    //buku
    Route::get('/buku', [BukuController::class, 'index']);

    Route::get('/buku/create', [BukuController::class, 'create']);
    Route::post('/buku/store', [BukuController::class, 'store']);

    Route::get('/buku/edit/{id}', [BukuController::class, 'edit']);
    Route::post('/buku/update/{id}', [BukuController::class, 'update']);

    Route::get('/buku/delete/{id}', [BukuController::class, 'destroy']);


    //transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index']);

    Route::get('/transaksi/kembali/{id}', [TransaksiController::class, 'kembali']);

    Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail']);
});


// SISWA
Route::middleware(['auth.check', 'role:siswa'])->group(function () {

    Route::get('/dashboard-siswa', [DashboardController::class, 'siswa']);

    Route::get('/list-buku', [BukuController::class, 'list']);

    // pinjam buku
    Route::get('/pinjam', [TransaksiController::class, 'pinjam']);

    Route::post('/pinjam/store', [TransaksiController::class, 'store']);

});

Route::get('/home', function () { return view('home'); });
