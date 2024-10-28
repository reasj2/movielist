<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MyMoviesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userMovies = auth()->user()->movies;
        return view('my-movies.index', compact('userMovies'));
    }

    public function create()
    {
        return view('my-movies.create');
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
        return redirect()->route('my-movies.index');
    }

    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        return view('my-movies.edit', compact('movie'));
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
        return redirect()->route('my-movies.index');
    }

    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movie->delete();
        return redirect()->route('my-movies.index');
    }
}
