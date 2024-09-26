<?php

use  Brl\Startup\Controllers\A;

use Illuminate\Support\Facades\Route;
use Brl\Startup\app\Controllers\CrudController;

Route::group(['prefix' => 'brl-startup'], function () {

    Route::get('/get-table', [CrudController::class, 'getTable']);
});
