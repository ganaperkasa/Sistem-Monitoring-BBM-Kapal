<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonsumsiBBMController;
use App\Http\Controllers\JenisBBMController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/konsumsi-bbm', [KonsumsiBBMController::class, 'index'])->name('konsumsi-bbm')->middleware('auth');

ROute::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.store');

Route::get('/operasional', [KonsumsiBBMController::class, 'index'])->name('operasional')->middleware('auth');
Route::get('/operasional/create', [KonsumsiBBMController::class, 'create'])->name('operasional.create');
Route::post('/operasional/store', [KonsumsiBBMController::class, 'store']);
Route::get('/operasional/data', [KonsumsiBBMController::class, 'data'])->name('operasional.data');
Route::get('/operasional/{id}', [KonsumsiBBMController::class, 'show'])->name('operasional.show');
Route::get('/operasional/{id}/pdf', [KonsumsiBBMController::class, 'cetakPdf'])->name('operasional.pdf');

Route::get('/jenis-bbm', [JenisBBMController::class, 'index'])->name('jenis-bbm')->middleware('auth');
Route::get('/jenisbbm/create', [JenisBBMController::class, 'create'])->name('jenisbbm.create')->middleware('auth');
Route::post('/jenisbbm/store', [JenisBBMController::class, 'store'])->name('jenisbbm.store')->middleware('auth');
Route::get('/jenis-bbm/data', [JenisBBMController::class, 'data'])->name('jenisbbm.data')->middleware('auth');
// Route::get('/', function () {
//     return view('dashboard');
// });
