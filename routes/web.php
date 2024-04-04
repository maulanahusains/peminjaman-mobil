<?php

use App\Http\Controllers\AksesUserController as AksesUser;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;

use App\Http\Controllers\KelolaData\JenisKendaraanController as KelolaJenis;
use App\Http\Controllers\KelolaData\KaryawanController as KelolaKaryawan;
use App\Http\Controllers\KelolaData\KendaraanController as KelolaKendaraan;

use App\Http\Controllers\PinjamanKendaraan as UserPinjaman;
use App\Http\Controllers\Admin\PinjamanKendaraan as AdminPinjaman;

use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\Page2;
use Illuminate\Http\Request;
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

Route::any('session-message', function (Request $request) {
  return redirect()->back()->with($request->query('type'), $request->query('message'));
})->name('session-message');

Route::middleware('auth')->group(function () {
  Route::get('/', [HomePage::class, 'index'])->name('home');

  Route::prefix('pinjaman-kendaraan')->controller(UserPinjaman::class)->name('peminjaman-kendaraan.')->group(function () {
    Route::get('/', 'index')->name('list-pengajuan');
    Route::get('/riwayat', 'riwayat')->name('riwayat');
    Route::get('/detail/{id}', 'detail')->name('detail-peminjaman');
    Route::get('/json', 'indexJSON')->name('list-pengajuan-json');
    Route::get('/berjalanjson', 'berjalanJSON')->name('list-berjalan-json');
    Route::get('/riwayatjson', 'riwayatJSON')->name('list-riwayat-json');
    Route::post('/', 'store')->name('tambah-pengajuan');
    Route::delete('/{id}', 'destroy')->name('hapus-pengajuan');
  });
});

Route::prefix('superadmin')->middleware(['auth', 'isAdmin'])->group(function () {
  Route::prefix('manajemen-akses')->controller(AksesUser::class)->group(function () {
    Route::get('/', 'index')->name('manajemen-akses.index');
    Route::put('/', 'manipulate_admin')->name('manajemen-akses.manipulate_admin');
  });

  Route::prefix('peminjaman-uang')->controller(AdminPinjaman::class)->group(function () {
    Route::get('/list-persetujuan', 'list_persetujuan')->name('superadmin.peminjaman-kendaraan.list-persetujuan');
    Route::get('/list-persetujuan/datatable', 'datatable_persetujuan')->name('superadmin.peminjaman-kendaraan.datatable-persetujuan');
    Route::get('/list-persetujuan/{id}', 'detail_persetujuan')->name('superadmin.peminjaman-kendaraan.detail-persetujuan');
    Route::put('/list-persetujuan/setuju/{id}', 'setuju')->name('superadmin.peminjaman-kendaraan.setuju');
    Route::put('/list-persetujuan/tolak/{id}', 'tolak')->name('superadmin.peminjaman-kendaraan.tolak');

    Route::get('/list-berjalan', 'list_berjalan')->name('superadmin.peminjaman-kendaraan.list-berjalan');
    Route::get('/list-persetujuan/datatable', 'datatable_berjalan')->name('superadmin.peminjaman-kendaraan.datatable-berjalan');
    Route::get('/list-berjalan/{id}', 'detail_berjalan')->name('superadmin.peminjaman-kendaraan.detail-berjalan');
    Route::put('/list-berjalan/selesai/{id}', 'selesai')->name('superadmin.peminjaman-kendaraan.selesai');
    Route::get('/recap', 'recap')->name('superadmin.peminjaman-kendaraan.recap');
  });

  Route::prefix('kelola_data')->name('kelola-data.')->group(function () {
    Route::prefix('karyawan')->controller(KelolaKaryawan::class)->name('karyawan.')->group(function () {
      Route::get('/', 'index')->name('index');
      Route::get('/json', 'indexJSON')->name('indexJSON');
      Route::post('/', 'store')->name('store');
      Route::get('/{id}', 'edit')->name('edit');
      Route::put('/{id}', 'update')->name('update');
      Route::delete('/{id}', 'destroy')->name('delete');
    });

    Route::prefix('jenis-kendaraan')->controller(KelolaJenis::class)->name('jenis-kendaraan.')->group(function () {
      Route::get('/', 'index')->name('index');
      Route::get('/json', 'indexJSON')->name('indexJSON');
      Route::post('/', 'store')->name('store');
      Route::get('/{id}', 'edit')->name('edit');
      Route::put('/{id}', 'update')->name('update');
      Route::delete('/{id}', 'destroy')->name('delete');
    });

    Route::prefix('kendaraan')->controller(KelolaKendaraan::class)->name('kendaraan.')->group(function () {
      Route::get('/', 'index')->name('index');
      Route::get('/json', 'indexJSON')->name('indexJSON');
      Route::post('/', 'store')->name('store');
      Route::get('/{id}', 'edit')->name('edit');
      Route::put('/{id}', 'update')->name('update');
      Route::delete('/{id}', 'destroy')->name('delete');
    });
  });
});

// Main Page Route
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
Route::prefix('auth')->group(function () {
  Route::get('/login', [LoginBasic::class, 'index'])->name('login');
  Route::post('/postlogin', [LoginBasic::class, 'login'])->name('postlogin');
  Route::get('/logout', [LoginBasic::class, 'logout'])->name('logout');
  Route::get('/register', [RegisterBasic::class, 'index'])->name('register');
});
