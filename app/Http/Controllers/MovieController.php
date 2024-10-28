<?php

namespace App\Http\Controllers;

use App\Models\Movie; // Import the Movie model
use Illuminate\Http\Request; // Import Request class
use App\Http\Controllers\Controller; // Import the base Controller class

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $movies = auth()->user()->movies;
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'genre' => 'required',
            'status' => 'required|in:to_watch,currently_watching,watched',
            'rating' => 'nullable|integer|between:1,5',
        ]);

        auth()->user()->movies()->create($request->all());
        return redirect()->route('movies.index');
    }

    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $this->authorize('update', $movie);
        $request->validate([
            'title' => 'required|max:255',
            'genre' => 'required',
            'status' => 'required|in:to_watch,currently_watching,watched',
            'rating' => 'nullable|integer|between:1,5',
        ]);

        $movie->update($request->all());
        return redirect()->route('movies.index');
    }

    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movie->delete();
        return redirect()->route('movies.index');
    }
}
