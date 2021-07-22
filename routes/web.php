<?php

 use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('dynamicModal/{obat}', [ObatController::class, 'loadModal'])->name('dynamicModal');

    Route::resource('obat', ObatController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('users', UserController::class);
});
