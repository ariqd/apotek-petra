<?php

use App\Http\Controllers\LimitController;
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [LimitController::class, 'index']);

    Route::resource('/obat', MedicineController::class);
});
