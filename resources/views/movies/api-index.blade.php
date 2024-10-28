@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold text-orange-800 dark:text-orange-300 mb-6">🎬 Now Playing Movies 🎬</h1>

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if(!empty($nowPlayingMovies['results']) && count($nowPlayingMovies['results']) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
            @foreach($nowPlayingMovies['results'] as $movie)
                @php
                    $movieGenres = [];
                    if(isset($movie['genre_ids'])) {
                        foreach($movie['genre_ids'] as $genreId) {
                            if(isset($genres[$genreId])) {
                                $movieGenres[] = $genres[$genreId];
                            }
                        }
                    }
                @endphp
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    @if(isset($movie['poster_path']))
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-full h-80 object-cover rounded">
                    @endif
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mt-2">{{ $movie['title'] }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ \Illuminate\Support\Str::limit($movie['overview'], 100) }}</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">Genres: {{ implode(', ', $movieGenres) }}</p>

                    <!-- User Interaction Buttons -->
                    @auth
                        <div class="mt-4 space-y-2">
                            <form action="{{ route('movies.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="title" value="{{ $movie['title'] }}">
                                <input type="hidden" name="genre" value="{{ implode(', ', $movieGenres) }}">
                                <select name="status" class="block w-full p-2 rounded text-sm">
                                    <option value="to_watch">Want to Watch</option>
                                    <option value="currently_watching">Currently Watching</option>
                                    <option value="watched">Watched</option>
                                </select>
                                <input type="number" name="rating" min="1" max="10" placeholder="Rating (1-10)" class="block w-full p-2 mt-2 rounded text-sm">
                                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 mt-2 w-full">Add to My Movies</button>
                            </form>
                        </div>
                    @else
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Please <a href="{{ route('login') }}" class="text-blue-500">log in</a> to add this movie to your list.</p>
                    @endauth
                </div>
            @endforeach
        </div>
    @else
        <p class="text-orange-800 dark:text-orange-300">No movies found.</p>
    @endif
</div>
@endsection
