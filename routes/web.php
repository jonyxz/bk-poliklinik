<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dokter\ObatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
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
        Route::get('/', [ObatController::class, 'jadwalPeriksaIndex'])->name('dokter.jadwal-periksa.index');
        Route::get('/create', [ObatController::class, 'jadwalPeriksaCreate'])->name('dokter.jadwal-periksa.create');
        Route::post('/', [ObatController::class, 'jadwalPeriksaStore'])->name('dokter.jadwal-periksa.store');
        Route::get('/{id}/edit', [ObatController::class, 'jadwalPeriksaEdit'])->name('dokter.jadwal-periksa.edit');
        Route::patch('/{id}', [ObatController::class, 'jadwalPeriksaUpdate'])->name('dokter.jadwal-periksa.update');
        Route::delete('/{id}', [ObatController::class, 'jadwalPeriksaDestroy'])->name('dokter.jadwal-periksa.destroy');
    });

    // Route::prefix('profile')->group(function () {
    //     Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    // Route::prefix('profile')->group(function () {
    //     Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });
});

require __DIR__.'/auth.php';
