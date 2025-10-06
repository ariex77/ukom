<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;

// Redirect halaman utama ke dashboard jika sudah login, ke login jika belum
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// DASHBOARD - Tampilkan controller, bukan view langsung
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Pegawai (protected, hanya jika login)
Route::middleware(['auth'])->group(function () {
    // TARUH DUA ROUTE INI DI ATAS!
    Route::get('/pegawais/export-excel', [PegawaiController::class, 'exportExcel'])->name('pegawais.exportExcel');
    Route::get('/pegawais/export-pdf', [PegawaiController::class, 'exportPdf'])->name('pegawais.exportPdf');
    Route::resource('pegawais', PegawaiController::class);
});

// Profile (protected, hanya jika login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, dll)
require __DIR__.'/auth.php';