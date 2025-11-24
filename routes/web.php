<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\ReservasiController;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management - Only Admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Ruangan Management - Admin & Petugas
    Route::middleware('role:admin,petugas')->group(function () {
        Route::resource('ruangans', RuanganController::class);
    });

    // Reservasi
    Route::get('/reservasis', [ReservasiController::class, 'index'])->name('reservasis.index');
    
    Route::middleware('role:karyawan')->group(function () {
        Route::get('/reservasis/create', [ReservasiController::class, 'create'])->name('reservasis.create');
        Route::post('/reservasis', [ReservasiController::class, 'store'])->name('reservasis.store');
    });

    Route::middleware('role:admin,petugas')->group(function () {
        Route::post('/reservasis/{reservasi}/verify', [ReservasiController::class, 'verify'])->name('reservasis.verify');

       Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('role:admin');

    Route::get('/dashboard/petugas', [DashboardController::class, 'petugas'])
        ->middleware('role:petugas');

    Route::get('/dashboard/karyawan', [DashboardController::class, 'karyawan'])
        ->middleware('role:karyawan');
});


    });
});