<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index']);

Route::get('/test', function () {
    // Define the directory and file path
    $directory = 'custom';
    $fileName = 'custom.php';
    $filePath = $directory . '/' . $fileName;

    // Define the content you want to write into the file
    $content = "<?php\n\n// Custom PHP content\n\n echo 'Hello from custom.php!';";

    // Step 1: Check if directory exists, if not create it
    if (!Storage::exists($directory)) {
        Storage::makeDirectory($directory); // Creates the /custom directory
    }

    // Step 2: Create the custom.php file with the content
    Storage::put($filePath, $content);
});
