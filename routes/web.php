<?php

use App\Http\Controllers\DpaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\SppController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {

    Route::resource('rab', RabController::class);
    Route::post('/rab/{rab}/verifikasi', [RabController::class, 'verifikasi'])->name('rab.verifikasi');
    Route::post('/rab/{rab}/tolak', [RabController::class, 'tolak'])->name('rab.tolak');

    // DPA
    Route::get('/dpa', [DpaController::class, 'index'])->name('dpa.index');

    Route::get('/dpa/create/{rab}', [DpaController::class, 'create'])
        ->name('dpa.create');

    Route::post('/dpa/store/{rab}', [DpaController::class, 'store'])
        ->name('dpa.store');

    Route::get('/dpa/{dpa}', [DpaController::class, 'show'])
        ->name('dpa.show');

    Route::delete('/dpa/{dpa}', [DpaController::class, 'destroy'])
        ->name('dpa.destroy');


    // Daftar RAB untuk bendahara
    Route::get('/rab/bendahara', [RabController::class, 'indexBendahara'])->name('rab.bendahara');
    // Daftar SPP
    Route::get('/spp', [SppController::class, 'index'])->name('spp.index');
    Route::get('/spp/{spp}', [SppController::class, 'show'])->name('spp.show');
    Route::get('/spp/create/{rab_id}', [SppController::class, 'create'])->name('spp.create');
    Route::post('/spp/store/{rab_id}', [SppController::class, 'store'])->name('spp.store');
    Route::post('/spp/{spp}/verifikasi', [SppController::class, 'verifikasi'])->name('spp.verifikasi');
    Route::post('/spp/{spp}/tolak', [SppController::class, 'tolak'])->name('spp.tolak');
    Route::delete('/spp/{spp}', [SppController::class, 'destroy'])->name('spp.destroy');
    Route::get('/pembayaran/create/{spp}', [PembayaranController::class, 'create'])
        ->name('pembayaran.create');

    Route::post('/pembayaran/store/{spp}', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])
        ->name('pembayaran.index');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/{id}', [LaporanController::class, 'show'])
        ->name('laporan.show');

    // routes/web.php
    Route::get('/laporan/{rab}/pdf', [LaporanController::class, 'pdf'])
        ->name('laporan.pdf');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('rab', RabController::class);

    Route::post('/rab/{rab}/verifikasi', [RabController::class, 'verifikasi'])->name('rab.verifikasi');
    Route::post('/rab/{rab}/tolak', [RabController::class, 'tolak'])->name('rab.tolak');
});



require __DIR__ . '/auth.php';
