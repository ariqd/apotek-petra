<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('index');
    });
    // Route::group(['middleware' => 'isUser'], function () {
    // });

    // Route::group(['middleware' => 'isAdmin'], function () {
    // });
});
