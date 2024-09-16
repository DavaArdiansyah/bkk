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

Route::get('', [App\Http\Controllers\Halaman\DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'role:Admin BKK'])->name('admin.')->group(function () {
    Route::get('laporan', [App\Http\Controllers\Halaman\LaporanController::class, 'index'])->name('laporan');
    Route::resource('akun-pengguna', App\Http\Controllers\AkunPengguna::class)->parameters(['akun-pengguna' => 'user'])->except('create', 'store', 'destroy');
    Route::resource('info-lowongan', App\Http\Controllers\Lowongan\AdminController::class)->parameters(['info-lowongan' => 'loker']);
});
