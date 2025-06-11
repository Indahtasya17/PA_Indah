<?php

use App\Http\Controllers\BarangMasukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SortiranController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PelabuhanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\MasukLokalController;
use App\Http\Controllers\KeluarLokalController;
use App\Http\Controllers\BarangImportController;
use App\Http\Controllers\KeluarImportController;
use App\Http\Controllers\KonfirmasiController;


Route::middleware('auth')->group(function () {
    Route::prefix("pelabuhan")->group(function () {
        Route::get('', [PelabuhanController::class, 'index'])->name('pelabuhan');
        Route::get('create', [PelabuhanController::class, 'create'])->name('pelabuhan.create');
        Route::get('{id}/edit', [PelabuhanController::class, 'edit'])->name('pelabuhan.edit');
        Route::get('{id}/detail', [PelabuhanController::class, 'detail'])->name('pelabuhan.detail');
        Route::post('store', [PelabuhanController::class, 'store'])->name('pelabuhan.store');
        Route::put('{id}/update', [PelabuhanController::class, 'update'])->name('pelabuhan.update');
        Route::delete('{id}/destroy', [PelabuhanController::class, 'destroy'])->name('pelabuhan.destroy');
    });

    Route::prefix('barang-import')->name('barang-import.')->group(function () {
        Route::prefix('masuk')->name('masuk.')->group(function () {
            Route::get('', [BarangImportController::class, 'index'])->name('index');
            Route::get('create', [BarangImportController::class, 'create'])->name('create');
            Route::get('{id}/edit', [BarangImportController::class, 'edit'])->name('edit');
            Route::get('{id}/detail', [BarangImportController::class, 'detail'])->name('detail');
            Route::post('store', [BarangImportController::class, 'store'])->name('store');
            Route::put('{id}/update', [BarangImportController::class, 'update'])->name('barang.update');
        });

        Route::prefix('barang-masuk')->name('barang-masuk.')->group(function () {
        Route::prefix('masuk')->name('masuk.')->group(function () {
            Route::get('', [BarangMasukController::class, 'index'])->name('index');
            Route::get('create', [BarangMasukController::class, 'create'])->name('create');
            Route::get('{id}/edit', [BarangMasukController::class, 'edit'])->name('edit');
            Route::get('{id}/detail', [BarangMasukController::class, 'detail'])->name('detail');
            Route::post('store', [BarangMasukController::class, 'store'])->name('store');
            Route::put('{id}/update', [BarangMasukController::class, 'update'])->name('barang.update');
        });
        });

        Route::prefix('keluar')->name('keluar.')->group(function () {
            Route::get('', [KeluarImportController::class, 'index'])->name('index');
            Route::get('create', [KeluarImportController::class, 'create'])->name('create');
            Route::get('{id}/edit', [KeluarImportController::class, 'edit'])->name('edit');
            Route::get('{id}/detail', [KeluarImportController::class, 'detail'])->name('detail');
            Route::post('store', [KeluarImportController::class, 'store'])->name('store');
            Route::put('{id}/update', [KeluarImportController::class, 'update'])->name('barang.update');
        });
    });

    Route::prefix("masuk-lokal")->group(function () {
        Route::get('', [MasukLokalController::class, 'index'])->name('masuk-lokal');
        Route::get('create', [MasukLokalController::class, 'create'])->name('masuk-lokal.create');
        Route::get('{id}/edit', [MasukLokalController::class, 'edit'])->name('masuk-lokal.edit');
        Route::get('{id}/detail', [MasukLokalController::class, 'detail'])->name('masuk-lokal.detail');
        Route::post('store', [MasukLokalController::class, 'store'])->name('masuk-lokal.store');
        Route::put('{id}/update', [MasukLokalController::class, 'update'])->name('masuk-lokal.update');
    });

    Route::prefix("keluar-lokal")->group(function () {
        Route::get('', [KeluarLokalController::class, 'index'])->name('keluar-lokal');
        Route::get('create', [KeluarLokalController::class, 'create'])->name('keluar-lokal.create');
        Route::get('{id}/edit', [KeluarLokalController::class, 'edit'])->name('keluar-lokal.edit');
        Route::get('{id}/detail', [KeluarLokalController::class, 'detail'])->name('keluar-lokal.detail');
        Route::post('store', [KeluarLokalController::class, 'store'])->name('keluar-lokal.store');
        Route::put('{id}/update', [KeluarLokalController::class, 'update'])->name('keluar-lokal.update');
    });

    Route::prefix("sortiran")->group(function () {
        Route::get('', [SortiranController::class, 'index'])->name('sortiran');
        Route::get('create', [SortiranController::class, 'create'])->name('sortiran.create');
        Route::get('{id}/edit', [SortiranController::class, 'edit'])->name('sortiran.edit');
        Route::get('{id}/detail', [SortiranController::class, 'detail'])->name('sortiran.detail');
        Route::post('store', [SortiranController::class, 'store'])->name('sortiran.store');
        Route::put('{id}/update', [SortiranController::class, 'update'])->name('sortiran.update');
        Route::delete('{id}/destroy', [SortiranController::class, 'destroy'])->name('sortiran.destroy');
    });

    Route::prefix("barang")->group(function () {
        Route::get('', [BarangController::class, 'index'])->name('barang');
        Route::get('create', [BarangController::class, 'create'])->name('barang.create');
        Route::get('{id}/find', [BarangController::class, 'getById'])->name('barang.find');
        Route::get('{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::get('{id}/detail', [BarangController::class, 'detail'])->name('barang.detail');
        Route::post('store', [BarangController::class, 'store'])->name('barang.store');
        Route::put('{id}/update', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('{id}/destroy', [BarangController::class, 'destroy'])->name('barang.destroy');

    });

    Route::prefix("pemesanan")->group(function () {
        Route::get('', [PemesananController::class, 'index'])->name('pemesanan');
        Route::get('create', [PemesananController::class, 'create'])->name('pemesanan.create');
        Route::get('{id}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
        Route::get('{id}/detail', [PemesananController::class, 'detail'])->name('pemesanan.detail');
    });

    Route::prefix("laporan")->group(function () {
        Route::get('', [LaporanController::class, 'index'])->name('laporan');
        Route::get('create', [LaporanController::class, 'create'])->name('laporan.create');
        Route::get('{id}/detail', [LaporanController::class, 'detail'])->name('laporan.detail');
    });

    Route::prefix("konfirmasi")->group(function () {
        Route::get('', [KonfirmasiController::class, 'index'])->name('konfirmasi.index');
        Route::get('{id}/detail', [KonfirmasiController::class, 'konfirmasi'])->name('konfirmasi.detail');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix("supplier")->group(function () {
    Route::get('', [SupplierController::class, 'index'])->name('supplier');
    Route::get('create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::get('{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::put('{id}/update', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('{id}/destroy', [SupplierController::class, 'destroy'])->name('supplier.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('', [LoginController::class, 'loginPage'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.process');
});

