@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold text-orange-800 dark:text-orange-300 mb-6">🎥 My Movies</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- List All Movies -->
    @if($movies->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($movies as $movie)
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">{{ $movie->title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Genre: {{ $movie->genre ?? 'Unknown' }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Status: {{ ucfirst(str_replace('_', ' ', $movie->status)) }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Rating: {{ $movie->rating ? '⭐ ' . $movie->rating . '/10' : 'Not Rated' }}</p>
                    <div class="mt-4 space-x-2">
                        <a href="{{ route('movies.edit', $movie) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                        <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-orange-800 dark:text-orange-300">No movies found.</p>
    @endif

    <!-- Add Movie Button -->
    <div class="mt-6">
        <a href="{{ route('movies.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add New Movie</a>
    </div>
</div>
@endsection
