@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 bg-orange-100 dark:bg-gray-900 rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold text-orange-800 dark:text-orange-300 mb-6">🎥 My Movies 🎥</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($movies as $movie)
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold">{{ $movie->title }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Genre: {{ $movie->genre }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Status: {{ ucfirst(str_replace('_', ' ', $movie->status)) }}</p>
                @if($movie->rating)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Rating: ⭐ {{ $movie->rating }}/5</p>
                @endif
                <a href="{{ route('movies.edit', $movie) }}" class="bg-blue-500 text-white px-3 py-1 rounded mt-3 inline-block hover:bg-blue-600">Edit</a>
                <form action="{{ route('movies.destroy', $movie) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded mt-3 hover:bg-red-600">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
