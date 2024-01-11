<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\DetailPeriksaController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PasienRegistrationController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [LoginController::class, 'indexAdmin'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [LoginController::class, 'authenticateAdmin']);
Route::post('/admin/logout', [LoginController::class, 'logoutAdmin']);

Route::get('/dokter/login', [LoginController::class, 'indexDokter'])->name('dokter.login')->middleware('guest');
Route::post('/dokter/login', [LoginController::class, 'authenticateDokter']);
Route::post('/dokter/logout', [LoginController::class, 'logoutDokter']);


Route::middleware(['dokter.auth'])->group(function () {
    // Dokter
    Route::get('/dokter', [HomeController::class, 'dokter'])->name('dokter.dashboard');

    Route::get('/dokter/periksa-pasien', [PeriksaController::class, 'index'])->name('memeriksapasien');
    Route::post('/dokter/periksa-pasien/{id}', [PeriksaController::class, 'update'])->name('memeriksapasien.update');

    Route::get('/dokter/edit-periksa/{id}', [PeriksaController::class, 'edit'])->name('editperiksa');
    Route::post('/dokter/edit-periksa/{id}', [PeriksaController::class, 'updatePeriksa'])->name('editperiksa.update');

    Route::get('/dokter/riwayat-pasien', [DetailPeriksaController::class, 'index'])->name('riwayatpasien');
});

Route::middleware(['auth'])->group(function () {
    // Admin
    Route::get('/admin', [HomeController::class, 'admin'])->name('admin.dashboard');

    Route::get('/admin/obat', [ObatController::class, 'index'])->name('obat');
    Route::post('/admin/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::delete('/admin/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
    Route::post('/admin/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
});