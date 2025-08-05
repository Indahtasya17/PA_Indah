<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SortiranController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PelabuhanController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\MitraController;



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

    Route::prefix('barang-masuk')->name('barang-masuk.')->group(function () {
        Route::get('', [BarangMasukController::class, 'index'])->name('index');
        Route::get('create', [BarangMasukController::class, 'create'])->name('create');
        Route::get('{id}/edit', [BarangMasukController::class, 'edit'])->name('edit');
        Route::get('{id}/detail', [BarangMasukController::class, 'detail'])->name('detail');
        Route::post('store', [BarangMasukController::class, 'store'])->name('store');
        Route::put('{id}/update', [BarangMasukController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [BarangMasukController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('barang-keluar')->name('barang-keluar.')->group(function () {
        Route::get('', [BarangKeluarController::class, 'index'])->name('index');
        Route::get('create', [BarangKeluarController::class, 'create'])->name('create');
        Route::get('{id}/edit', [BarangKeluarController::class, 'edit'])->name('edit');
        Route::get('{id}/detail', [BarangKeluarController::class, 'detail'])->name('detail');
        Route::post('store', [BarangKeluarController::class, 'store'])->name('store');
        Route::put('{id}/update', [BarangKeluarController::class, 'update'])->name('barang.update');
        Route::delete('{id}/destroy', [BarangKeluarController::class, 'destroy'])->name('destroy');
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

    Route::prefix("laporan")->group(function () {
        Route::get('', [LaporanController::class, 'index'])->name('laporan');
        Route::get('create', [LaporanController::class, 'create'])->name('laporan.create');
        Route::get('{id}/detail', [LaporanController::class, 'detail'])->name('laporan.detail');
        Route::get('print', [LaporanController::class, 'print'])->name('laporan.print');
        Route::get('print', [LaporanController::class, 'print'])->name('laporan.print');

    });

    Route::prefix("konfirmasi")->group(function () {
        Route::get('', [KonfirmasiController::class, 'index'])->name('konfirmasi.index');
        Route::get('{id}/detail', [KonfirmasiController::class, 'konfirmasi'])->name('konfirmasi.detail');
        Route::post('{id}/store', [KonfirmasiController::class, 'store'])->name('konfirmasi.store');
    });

    Route::prefix("supplier")->group(function () {
        Route::get('', [SupplierController::class, 'index'])->name('supplier');
        Route::get('create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::get('{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::put('{id}/update', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('{id}/destroy', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });

    Route::prefix("mitra")->group(function () {
        Route::get('', [MitraController::class, 'index'])->name('mitra.index');
        Route::get('create', [MitraController::class, 'create'])->name('mitra.create');
        Route::get('{id}/edit', [MitraController::class, 'edit'])->name('mitra.edit');
        Route::post('store', [MitraController::class, 'store'])->name('mitra.store');
        Route::put('{id}/update', [MitraController::class, 'update'])->name('mitra.update');
        Route::delete('{id}/destroy', [MitraController::class, 'destroy'])->name('mitra.destroy');
    });

    Route::prefix('auth')->group(function () {
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function () {
    Route::get('', [LoginController::class, 'loginPage'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.process');
});


Route::get('reset', function () {
    Artisan::call('migrate:fresh --seed');
    return redirect()->route('beranda');
});