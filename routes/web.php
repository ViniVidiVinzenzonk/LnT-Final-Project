<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserBarangController;
use App\Http\Controllers\AuthController;

// redirect root ke login aj biar rapi
Route::get('/', function () {
    return redirect('/login');
});

// --- AUTH ROUTES ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// --- USER ROUTES (harus login) ---
Route::middleware(['authuser'])->group(function () {
    Route::get('/barang', [UserBarangController::class, 'index']);
    Route::post('/barang/{id}/keranjang', [UserBarangController::class, 'tambahKeranjang']);
    Route::post('/keranjang/{id}/hapus', [UserBarangController::class, 'hapusKeranjang']);
    Route::post('/keranjang/{id}/update', [UserBarangController::class, 'updateKeranjang']);
    Route::get('/faktur/buat', [UserBarangController::class, 'createFaktur']);
    Route::post('/faktur/simpan', [UserBarangController::class, 'storeFaktur']);
    Route::get('/faktur/{id}', [UserBarangController::class, 'showFaktur']);
});

// --- ADMIN ROUTES (harus admin) ---
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/barang', [BarangController::class, 'index']);
    Route::get('/admin/barang/create', [BarangController::class, 'create']);
    Route::post('/admin/barang', [BarangController::class, 'store']);
    Route::get('/admin/barang/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/admin/barang/{id}', [BarangController::class, 'update']);
    Route::post('/admin/barang/{id}/delete', [BarangController::class, 'destroy']);

    // kelola kategori
    Route::get('/admin/kategori', [BarangController::class, 'kategoriIndex']);
    Route::post('/admin/kategori', [BarangController::class, 'kategoriStore']);
    Route::post('/admin/kategori/{id}/delete', [BarangController::class, 'kategoriDestroy']);
});

// route karyawan lama tetep jalan
Route::get('/karyawans', [karyawanController::class, 'index']);
Route::get('/karyawans/create', [karyawanController::class, 'create']);
Route::post('/karyawans', [karyawanController::class, 'store']);
Route::get('/karyawans/{id}/edit', [karyawanController::class, 'edit']);
Route::put('/karyawans/{id}/edit', [karyawanController::class, 'update']);
Route::post('/karyawans/{id}/delete', [karyawanController::class, 'destroy']);