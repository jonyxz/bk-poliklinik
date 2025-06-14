<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\PeriksaController;
use App\Http\Controllers\Pasien\JanjiPeriksaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');
    
    Route::prefix('obat')->group(function () {
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });

    Route::prefix('jadwal-periksa')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, 'Index'])->name('dokter.jadwal_periksa.index');
        Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal_periksa.create');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal_periksa.store');
        Route::get('/{id}/edit', [JadwalPeriksaController::class, 'edit'])->name('dokter.jadwal_periksa.edit');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal_periksa.update');
        Route::delete('/{id}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwal_periksa.destroy');
        Route::patch('/jadwal_periksa/{id}/toggle-status', [JadwalPeriksaController::class, 'toggleStatus'])->name('dokter.jadwal_periksa.toggleStatus');
    });
    Route::prefix('periksa')->group(function () {
        Route::get('/', [PeriksaController::class, 'index'])->name('dokter.periksa.index');
        Route::get('/{janjiPeriksa}/create', [PeriksaController::class, 'create'])->name('dokter.periksa.create');
        Route::post('/{id}/store', [PeriksaController::class, 'store'])->name('dokter.periksa.store');
    });
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    Route::prefix('janji-periksa')->group(function () {
        Route::get('/', [JanjiPeriksaController::class, 'Index'])->name('pasien.janji_periksa.index');
        Route::get('/create', [JanjiPeriksaController::class, 'create'])->name('pasien.janji_periksa.create');
        Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji_periksa.store');
        Route::get('/{id}/edit', [JanjiPeriksaController::class, 'edit'])->name('pasien.janji_periksa.edit');
        Route::patch('/{id}', [JanjiPeriksaController::class, 'update'])->name('pasien.janji_periksa.update');
        Route::delete('/{id}', [JanjiPeriksaController::class, 'destroy'])->name('pasien.janji_periksa.destroy');
    });
});

require __DIR__.'/auth.php';
