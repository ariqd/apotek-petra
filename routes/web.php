<?php

use App\Http\Controllers\CalculateController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\LimitController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [LimitController::class, 'index']);

    Route::resource('/obat', MedicineController::class);
    Route::resource('/kriteria', CriteriaController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/perhitungan', CalculateController::class);
    Route::resource('/skor', ScoreController::class);
});
