<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Redirect root to movies from TMDb API
Route::get('/', [MovieController::class, 'movies'])->name('movies.api-index');

// Authentication Routes
require __DIR__.'/auth.php';

// Movies from TMDb API
Route::get('/movies/api', [MovieController::class, 'movies'])->name('movies.api-index');

// User's Movies (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/my-movies', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});
