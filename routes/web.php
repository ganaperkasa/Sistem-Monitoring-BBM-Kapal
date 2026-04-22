<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonsumsiBBMController;
use App\Http\Controllers\JenisBBMController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.store');


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Konsumsi BBM (alias halaman utama user)
    Route::get('/konsumsi-bbm', [KonsumsiBBMController::class, 'index'])->name('konsumsi-bbm');

    // Operasional
    Route::prefix('operasional')->name('operasional.')->group(function () {
        Route::get('/', [KonsumsiBBMController::class, 'index'])->name('');
        Route::get('/create', [KonsumsiBBMController::class, 'create'])->name('create');
        Route::post('/store', [KonsumsiBBMController::class, 'store'])->name('store');
        Route::get('/data', [KonsumsiBBMController::class, 'data'])->name('data');
        Route::get('/{id}', [KonsumsiBBMController::class, 'show'])->name('show');
        Route::get('/{id}/pdf', [KonsumsiBBMController::class, 'cetakPdf'])->name('pdf');
    });

    // Jenis BBM
    Route::prefix('jenis-bbm')->name('jenisbbm.')->group(function () {
        Route::get('/', [JenisBBMController::class, 'index'])->name('');
        Route::get('/create', [JenisBBMController::class, 'create'])->name('create');
        Route::post('/store', [JenisBBMController::class, 'store'])->name('store');
        Route::get('/data', [JenisBBMController::class, 'data'])->name('data');
    });

});
