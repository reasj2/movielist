<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\TMDbService;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function __construct()
    {
        // Apply 'auth' middleware to all methods except 'movies'
        $this->middleware('auth')->except(['movies']);
    }

    // Display movies from TMDb API
    public function movies(TMDbService $tmdbService)
    {
        $nowPlayingMovies = $tmdbService->getNowPlayingMovies();
        $genres = $tmdbService->getGenres();

        // Check if data is retrieved
        if (empty($nowPlayingMovies) || !isset($nowPlayingMovies['results'])) {
            // Optionally, flash an error message or log it
            session()->flash('error', 'Unable to fetch movies from TMDb API.');
            $nowPlayingMovies['results'] = [];
        }

        return view('movies.api-index', compact('nowPlayingMovies', 'genres'));
    }

    // List of user's movies
    public function index()
    {
        $movies = Auth::user()->movies;
        return view('movies.index', compact('movies'));
    }

    // Show form to create a new movie manually
    public function create()
    {
        return view('movies.create');
    }

    // Store a new movie
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|max:255',
            'genre'  => 'nullable',
            'status' => 'required|in:to_watch,currently_watching,watched',
            'rating' => 'nullable|integer|between:1,10',
        ]);

        Auth::user()->movies()->create($request->only(['title', 'genre', 'status', 'rating']));
        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');
    }

    // Show form to edit an existing movie
    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        return view('movies.edit', compact('movie'));
    }

    // Update an existing movie
    public function update(Request $request, Movie $movie)
    {
        $this->authorize('update', $movie);
        $request->validate([
            'title'  => 'required|max:255',
            'genre'  => 'nullable',
            'status' => 'required|in:to_watch,currently_watching,watched',
            'rating' => 'nullable|integer|between:1,10',
        ]);

        $movie->update($request->only(['title', 'genre', 'status', 'rating']));
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    // Delete a movie
    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
