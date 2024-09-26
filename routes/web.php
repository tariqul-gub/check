<?php

use App\Class\FileCommand;
use App\Class\MakeController;
use App\Class\MakeModel;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index']);

Route::get('/test', function () {
    $table = 'user_details';

    new MakeController($table);
    new MakeModel($table);
});
