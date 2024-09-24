<?php

use App\Http\Controllers\ProductController;
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
    // Step 1: Define the stub file path
    $stubFilePath = resource_path('stubs/Controller.stub');

    // Step 2: Check if the stub file exists
    if (!File::exists($stubFilePath)) {
        return 'Stub file does not exist!';
    }

    // Step 3: Get the content of the stub file
    $stubContent = File::get($stubFilePath);

    // Step 4: Replace the placeholders in the stub content
    // Assume the stub has placeholders like {{controllerName}} or {{namespace}}
    $controllerName = 'CustomController';
    $namespace = 'App\\Http\\Controllers';

    // Replace the placeholders with actual values
    $modifiedContent = str_replace(
        ['{{controllerName}}', '{{namespace}}'],  // Placeholders in stub
        [$controllerName, $namespace],            // Values to replace with
        $stubContent
    );

    // Step 5: Define the directory and file path for custom.php in the base path
    $directory = base_path('custom');
    $filePath = $directory . '/custom.php';

    // Step 6: Check if the directory exists, if not create it
    if (!File::exists($directory)) {
        File::makeDirectory($directory, 0755, true); // Create /custom directory
    }

    // Step 7: Create and write the modified content to custom.php
    File::put($filePath, $modifiedContent);

    return 'custom.php created successfully with stub content!';
});
