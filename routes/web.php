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
    Route::livewire('/users/create', 'pages::user.create')->name('user.create');
    Route::livewire('/users/{user}', 'pages::user.show')->name('user.show');
    Route::livewire('/users/{user}/edit', 'pages::user.edit')->name('user.edit');
    Route::livewire('/users/{user}/change-password', 'pages::user.change-password')->name('user.change-password');
    Route::livewire('/users/{user}/assign', 'pages::user.assign')->name('user.assign');

    // RBAC - Roles
    Route::livewire('/rbac/roles', 'pages::rbac.role.index')->name('rbac.role.index');
    Route::livewire('/rbac/roles/create', 'pages::rbac.role.create')->name('rbac.role.create');
    Route::livewire('/rbac/roles/{role}/edit', 'pages::rbac.role.edit')->name('rbac.role.edit');
    Route::livewire('/rbac/roles/{role}', 'pages::rbac.role.show')->name('rbac.role.show');

    // RBAC - Permissions
    Route::livewire('/rbac/permissions', 'pages::rbac.permission.index')->name('rbac.permission.index');
    Route::livewire('/rbac/permissions/create', 'pages::rbac.permission.create')->name('rbac.permission.create');
    Route::livewire('/rbac/permissions/{permission}/edit', 'pages::rbac.permission.edit')->name('rbac.permission.edit');
    Route::livewire('/rbac/permissions/{permission}', 'pages::rbac.permission.show')->name('rbac.permission.show');

    // Sample - Items
    Route::livewire('/sample/items', 'pages::sample.item.index')->name('sample.item.index');
    Route::livewire('/sample/items/{item}', 'pages::sample.item.show')->name('sample.item.show');

});

require __DIR__.'/settings.php';

// API Documentation
if (! app()->isProduction()) {
    Route::get('/api/docs', fn () => redirect('/api/documentation'));

    // sample pages
    Route::view('blank', 'static.blank')->name('static.blank');
    Route::view('blank2', 'static.blank2')->name('static.blank2');
    Route::view('blank3', 'static.blank3')->name('static.blank3');

    Route::middleware(['guest'])->group(function () {
        Route::livewire('/login-as', 'pages::auth.login-as')->name('login-as');
    });
}
