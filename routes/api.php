<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/loginCus', [AuthController::class, 'loginCustomer']);
Route::post('/loginEmp', [AuthController::class, 'loginEmployee']);

Route::get('/search/{nama}', [PemesananController::class, 'searchByNamaProduk']);
Route::get('/searchCustomer/{nama}', [CustomerController::class, 'searchByName']);

Route::get('/sendEmailLink/{nama}', [PasswordResetController::class, 'sendResetLink']);
Route::get('/resetPassword/{id}/{verify_key}', [PasswordResetController::class, 'show']);
Route::put('/customers/{id}/updatePassword', [PasswordResetController::class, 'updatePassword'])->name('updatePassword');
Route::get('/updateBerhasil', [PasswordResetController::class, 'indexBerhasil'])->name('updateBerhasil');

Route::apiResource('customer', CustomerController::class);
Route::apiResource('presensi', PresensiController::class);
Route::apiResource('pemesanan', PemesananController::class);