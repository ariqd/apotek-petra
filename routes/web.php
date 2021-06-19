<?php

// use App\Http\Controllers\CalculateController;
// use App\Http\Controllers\CriteriaController;
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

    // Route::get('obat', [ObatController::class, 'index'])->name('obat.index');
    // Route::get('obat/create', [ObatController::class, 'create'])->name('obat.create');
    // Route::get('obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');

    // Route::prefix('setting')->name('setting.')->group(function () {
    //     Route::get('/', [SettingController::class, 'index'])->name('index');
    // });

    // Route::get('dynamicModal/{id}', [
    //     'as' => 'dynamicModal',
    //     'uses' => 'ObatController@loadModal'
    // ]);
});
