<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonsumsiBBMController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/konsumsi-bbm', [KonsumsiBBMController::class, 'index'])->name('konsumsi-bbm')->middleware('auth');

Route::get('/operasional', [KonsumsiBBMController::class, 'index']);
Route::get('/operasional/create', [KonsumsiBBMController::class, 'create'])->name('operasional.create');
Route::post('/operasional/store', [KonsumsiBBMController::class, 'store']);
Route::get('/operasional/data', [KonsumsiBBMController::class, 'data'])->name('operasional.data');

// Route::get('/', function () {
//     return view('dashboard');
// });
