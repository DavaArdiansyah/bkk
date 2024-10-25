<?php

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

Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('edit/{user}', [App\Http\Controllers\Halaman\ProfilController::class, 'edit'])->name('edit');
    Route::put('update/{user}', [App\Http\Controllers\Halaman\ProfilController::class, 'update'])->name('update');
});

Route::get('/get-kota/{provinsiId}', [App\Http\Controllers\WilayahController::class, 'kota']);
Route::get('/get-kecamatan/{kotaId}', [App\Http\Controllers\WilayahController::class, 'kecamatan']);
Route::get('/get-kelurahan/{kecamatanId}', [App\Http\Controllers\WilayahController::class, 'kelurahan']);

Route::middleware(['auth', 'role:Admin BKK'])->name('admin.')->group(function () {
    Route::get('laporan', [App\Http\Controllers\Halaman\LaporanController::class, 'index'])->name('laporan');
    Route::get('data-alumni/import', [App\Http\Controllers\DataAlumniController::class, 'import'])->name('data-alumni.import');
    Route::resource('data-alumni', App\Http\Controllers\DataAlumniController::class)->parameters(['data-alumni' => 'alumni'])->except('show', 'destroy');
    Route::resource('data-perusahaan', App\Http\Controllers\DataPerusahaanController::class)->parameters(['data-perusahaan' => 'perusahaan'])->except('show', 'destroy');
    Route::prefix('data-perusahaan')->name('data-perusahaan.')->group(function () {
        Route::post('tmpData', [App\Http\Controllers\DataPerusahaanController::class, 'tmp'])->name('tmp-data');
        Route::post('import', [App\Http\Controllers\DataPerusahaanController::class, 'import'])->name('import');
        Route::get('account/create', [App\Http\Controllers\DataPerusahaanController::class, 'akun'])->name('akun.create');
        Route::put('status/{perusahaan}', [App\Http\Controllers\DataPerusahaanController::class, 'status'])->name('status.update');
    });
    Route::get('lacak-alumni', [App\Http\Controllers\LacakAlumni::class, 'index'])->name('lacak-alumni.index');
    Route::resource('akun-pengguna', App\Http\Controllers\AkunPengguna::class)->parameters(['akun-pengguna' => 'user'])->except('create', 'store', 'destroy');
    Route::put('akun-pengguna/status/{user}', [App\Http\Controllers\AkunPengguna::class, 'status'])->name('akun-pengguna.status');
    Route::get('akun-perusahaan/create', [App\Http\Controllers\AkunPengguna::class, 'perusahaan'])->name('akun-pengguna.perusahaan.create');
    Route::post('akun-perusahaan/store', [App\Http\Controllers\AkunPengguna::class, 'akunPerusahaan'])->name('akun-pengguna.perusahaan.store');
    Route::get('akun-admin/create', [App\Http\Controllers\AkunPengguna::class, 'admin'])->name('akun-pengguna.admin.create');
    Route::post('akun-admin/store', [App\Http\Controllers\AkunPengguna::class, 'akunAdmin'])->name('akun-pengguna.admin.store');
    Route::resource('ajuan-info-lowongan', App\Http\Controllers\Lowongan\AdminController::class)->parameters(['ajuan-info-lowongan' => 'loker'])->only('index', 'show', 'update');
});

Route::middleware(['auth', 'role:Alumni'])->name('alumni.')->group(function () {
    Route::resource('cari-lowongan', App\Http\Controllers\Halaman\CariLowonganController::class)->parameters(['cari-lowongan' => 'loker'])->only('index', 'show');
    Route::resource('lamaran', App\Http\Controllers\Lamaran\AlumniController::class)->only('index', 'store', 'update');
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::resource('tentang-saya', App\Http\Controllers\Profil\DeskripsiController::class)->parameters(['tentang-saya' => 'alumni'])->only('edit', 'update', 'destroy');
        Route::resource('riwayat-pendidikan-formal', App\Http\Controllers\Profil\PendidikanFormalController::class)->parameters(['riwayat-pendidikan-formal' => 'pendidikanFormal'])->except('index', 'show');
        Route::resource('riwayat-pendidikan-non-formal', App\Http\Controllers\Profil\PendidikanNonFormalController::class)->parameters(['riwayat-pendidikan-non-formal' => 'pendidikanNonFormal'])->except('index', 'show');
        Route::resource('pengalaman-kerja', App\Http\Controllers\Profil\PengalamanKerjaController::class)->parameters(['pengalaman-kerja' => 'kerja'])->except('index', 'show');
        Route::resource('keahlian', App\Http\Controllers\Profil\KeahlianController::class)->parameters(['keahlian' => 'alumni'])->only('edit', 'update');
    });
    Route::prefix('kagiatan-sekarang')->name('kegiatan-sekarang.')->group(function () {
        Route::get('', [App\Http\Controllers\Halaman\KegiatanSekarang::class, 'edit'])->name('edit');
        Route::put('{alumni}', [App\Http\Controllers\Halaman\KegiatanSekarang::class, 'update'])->name('update');
    });
});

Route::middleware(['auth', 'role:Perusahaan'])->name('perusahaan.')->group(function () {
    Route::resource('info-lowongan', App\Http\Controllers\Lowongan\PerusahaanController::class)->parameters(['info-lowongan' => 'loker']);
    Route::put('info-lowongan/status/{loker}', [App\Http\Controllers\Lowongan\PerusahaanController::class, 'status'])->name('info-lowongan.status.update');
    Route::prefix('lamaran')->name('lamaran.')->group(function () {
        Route::get('terbaru', [App\Http\Controllers\Lamaran\PerusahaanController::class, 'terbaru'])->name('terbaru');
        Route::put('update/{lamaran}', [App\Http\Controllers\Lamaran\PerusahaanController::class, 'update'])->name('update');
        Route::get('arsip', [App\Http\Controllers\Lamaran\PerusahaanController::class, 'arsip'])->name('arsip');
    });
});
