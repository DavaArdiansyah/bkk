<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::get('login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});

Route::prefix('tmp')->name('tmp.')->group(function () {
    Route::post('files', [App\Http\Controllers\TmpController::class, 'files'])->name('files');
    Route::post('images', [App\Http\Controllers\TmpController::class, 'images'])->name('images');
});
Route::get('', [App\Http\Controllers\Halaman\DashboardController::class, 'index'])->name('dashboard');
Route::get('profil', [App\Http\Controllers\Halaman\ProfilController::class, 'index'])->name('profil');

Route::get('/get-kota/{provinsiId}', [App\Http\Controllers\WilayahController::class, 'kota']);
Route::get('/get-kecamatan/{kotaId}', [App\Http\Controllers\WilayahController::class, 'kecamatan']);
Route::get('/get-kelurahan/{kecamatanId}', [App\Http\Controllers\WilayahController::class, 'kelurahan']);

Route::middleware(['auth', 'role:Admin BKK'])->name('admin.')->group(function () {
    Route::get('laporan', [App\Http\Controllers\Halaman\LaporanController::class, 'index'])->name('laporan');
    Route::get('data-alumni/import', [App\Http\Controllers\DataAlumniController::class, 'import'])->name('data-alumni.import');
    Route::resource('data-alumni', App\Http\Controllers\DataAlumniController::class)->parameters(['data-alumni' => 'alumni'])->except('show', 'destroy');
    Route::resource('data-perusahaan', App\Http\Controllers\DataPerusahaanController::class)->parameters(['data-perusahaan' => 'perusahaan']);
    Route::post('data-perusahaan/akun', [App\Http\Controllers\DataPerusahaanController::class, 'akun'])->name('data-perusahaan.akun.create');
    Route::resource('akun-pengguna', App\Http\Controllers\AkunPengguna::class)->parameters(['akun-pengguna' => 'user'])->except('create', 'store', 'destroy');
    Route::resource('info-lowongan', App\Http\Controllers\Lowongan\AdminController::class)->parameters(['info-lowongan' => 'loker'])->only('index', 'show', 'update');
});

Route::middleware(['auth', 'role:Alumni'])->name('alumni.')->group(function () {
    Route::resource('cari-lowongan', App\Http\Controllers\Halaman\CariLowonganController::class)->parameters(['cari-lowongan' => 'loker'])->only('index', 'show');
    Route::resource('lamaran', App\Http\Controllers\Lamaran\AlumniController::class);
});
