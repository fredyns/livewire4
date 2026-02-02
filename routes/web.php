<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // S3 Storage actions
    Route::prefix('s3')->name('s3.')->group(function () {

        // File Download Routes - Serve files from S3/MinIO through application domain
        Route::prefix('download')->name('download.')->group(function () {

            Route::get('inline/{path}', \App\Http\Controllers\Storage\Download\InlineController::class)
                ->where('path', '.*')
                ->name('inline');

            Route::get('force/{path}', \App\Http\Controllers\Storage\Download\ForceController::class)
                ->where('path', '.*')
                ->name('force');
        });

        // Generic Upload Routes for MinIO
        Route::prefix('upload')->name('upload.')->group(function () {
            Route::post('docs', \App\Http\Controllers\Storage\Upload\DocsController::class)->name('docs');
            Route::post('image', \App\Http\Controllers\Storage\Upload\ImageController::class)->name('image');
        });
    });

    // User App
    Route::livewire('/users', 'pages::user.index')->name('user.index');
    Route::livewire('/users/{user}', 'pages::user.show')->name('user.show');

});

require __DIR__.'/settings.php';

// API Documentation
if (! app()->isProduction()) {
    Route::get('/api/docs', fn () => redirect('/api/documentation'));
}
