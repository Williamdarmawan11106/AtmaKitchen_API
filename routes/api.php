<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/loginCus', [AuthController::class, 'loginCustomer']);
Route::post('/loginEmp', [AuthController::class, 'loginEmployee']);

Route::apiResource('customer', CustomerController::class);
Route::apiResource('presensi', PresensiController::class);
Route::apiResource('pemesanan', PemesananController::class);