<?php

// use App\Http\Controllers\CalculateController;
// use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiController;
// use App\Http\Controllers\ScoreController;
// use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('dynamicModal/{obat}', [ObatController::class, 'loadModal'])->name('dynamicModal');

    Route::resource('obat', ObatController::class);
    Route::resource('transaksi', TransaksiController::class);

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
