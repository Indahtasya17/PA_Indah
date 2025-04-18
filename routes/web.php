<?php

use App\Http\Controllers\BarangImportController;
use App\Http\Controllers\PelabuhanController;
use Illuminate\Support\Facades\Route;


Route::prefix("barang-masuk")->group(function () {
    Route::get('', [PelabuhanController::class, 'index'])->name('pelabuhan');
    Route::get('create', [PelabuhanController::class, 'create'])->name('pelabuhan.create');
    Route::get('{id}/edit', [PelabuhanController::class, 'edit'])->name('pelabuhan.edit');
});

Route::prefix('barang-import')->group(function () {
    Route::prefix('masuk')->group(function () {
        Route::get('', [BarangImportController::class, 'index'])->name('barang-import.masuk');
        Route::get('create', [BarangImportController::class, 'create'])->name('barang-import.masuk.create');
    });
});