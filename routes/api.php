<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukDashboardController;
use App\Http\Controllers\PenarikanSaldoController;
use App\Http\Controllers\BahanBakuController;
use Illuminate\Support\Facades\Artisan;


Route::post('/login', [AuthController::class, 'login']);

Route::get('/search/{nama}', [PemesananController::class, 'searchByNamaProduk']);
Route::get('/searchCustomer/{email}', [CustomerController::class, 'searchByEmail']);

Route::get('/sendEmailLink/{nama}', [PasswordResetController::class, 'sendResetLink']);
Route::get('/resetPassword/{id}/{verify_key}', [PasswordResetController::class, 'show']);
Route::put('/customers/{id}/updatePassword', [PasswordResetController::class, 'updatePassword'])->name('updatePassword');
Route::get('/updateBerhasil', [PasswordResetController::class, 'indexBerhasil'])->name('updateBerhasil');

Route::apiResource('customer', CustomerController::class);
Route::apiResource('detailPesanan', DetailPesananController::class);

Route::get('/detailPesanan/search/{id}/{nama}', [DetailPesananController::class, 'searchByNamaProduk']);
Route::get('/history/{id}', [DetailPesananController::class, 'gethistory']);

Route::get('/presensi', [PresensiController::class, 'showAllPresensi']);
Route::get('/presensi/{namaKaryawan}', [PresensiController::class, 'searchPresensiByNamaEmployee']);
Route::put('/presensi/{idPresensi}', [PresensiController::class, 'updatePresensi']);
Route::post('/presensi/generate-presensi', [PresensiController::class, 'generatePresensi']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/produkdashboard', [ProdukDashboardController::class, 'index']);

Route::get('/penarikansaldo/{id}', [PenarikanSaldoController::class, 'getAllPenarikan']);
Route::get('/penarikansaldo/{id}/{tanggal}', [PenarikanSaldoController::class, 'searchHistoryPenarikanByDate']);
Route::post('/penarikansaldo/create', [PenarikanSaldoController::class, 'store']);

Route::get('/bahanbaku', [BahanBakuController::class, 'index']);