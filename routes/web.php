<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Root route for welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route for dashboard page (requires auth and email verification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grouped routes that require authentication
Route::middleware('auth')->group(function () {
    // Resource routes for managing movies (CRUD operations)
    Route::resource('movies', MovieController::class);
    
    // Profile-related routes (edit, update, delete)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Require the authentication routes (Laravel Breeze or other auth package)
require __DIR__.'/auth.php';
