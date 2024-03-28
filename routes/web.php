<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;

use App\Http\Controllers\AksesUserController as AksesUser;

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

Route::middleware('auth')->group(function () {
  Route::get('/', [HomePage::class, 'index'])->name('home');
});

Route::prefix('superadmin')->middleware(['auth', 'isAdmin'])->group(function () {
  Route::prefix('manajemen-akses')->controller(AksesUser::class)->group(function () {
    Route::get('/', 'index')->name('manajemen-akses.index');
    Route::put('/', 'manipulate_admin')->name('manajemen-akses.manipulate_admin');
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
