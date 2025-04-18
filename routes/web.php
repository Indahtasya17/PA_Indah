<?php

use App\Http\Controllers\PelabuhanController;
use Illuminate\Support\Facades\Route;


Route::prefix("pelabuhan")->group(function () {
    Route::get('', [PelabuhanController::class, 'index'])->name('pelabuhan');
    Route::get('create', [PelabuhanController::class, 'create'])->name('pelabuhan.create');
    Route::get('{id}/edit', [PelabuhanController::class, 'edit'])->name('pelabuhan.edit');
});