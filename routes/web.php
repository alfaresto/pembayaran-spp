<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SppController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applicati`o`n. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
Route::resource('/login-admin', LoginController::class);

Route::get('/login-siswa', [LoginController::class, 'index2']);
Route::post('/login-siswa', [LoginController::class, 'store2']);

Route::get('/logout', [LoginController::class, 'logout']);


Route::get('/dashboard', [IndexController::class, 'index']);
Route::resource('/kelas', KelasController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/spp', SppController::class);
Route::resource('/petugas', PetugasController::class);

// transaksi history
Route::resource('/transaksi', PembayaranController::class);
Route::get('/cetak-laporan', [PembayaranController::class, 'cetak_laporan']);
Route::get('/history', [PembayaranController::class, 'index2']);
Route::get('/history/{nisn}/{nominal}', [PembayaranController::class, 'show']);
Route::get('/history/{nisn}', [PembayaranController::class, 'show2']);