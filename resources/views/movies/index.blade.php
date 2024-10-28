@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 bg-orange-100 dark:bg-gray-900 rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-orange-800 dark:text-orange-300">
            🍁 Cozy Movie List 🍁
        </h1>
        <a href="{{ route('movies.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition ease-in-out duration-200">
            Add New Movie
        </a>
    </div>

    <!-- Movie Categories -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Want to Watch Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md border-2 border-orange-300">
            <h2 class="text-2xl font-bold text-orange-800 dark:text-orange-200 mb-4">Want to Watch 🍂</h2>
            @foreach($movies->where('status', 'to_watch') as $movie)
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">{{ $movie->title }}</h3>
                    <div class="text-gray-600 dark:text-gray-400">{{ $movie->genre }}</div>
                    <div class="flex justify-between mt-2">
                        <a href="{{ route('movies.edit', $movie) }}" class="text-orange-600 hover:text-orange-800">Edit</a>
                        <form action="{{ route('movies.destroy', $movie) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Currently Watching Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md border-2 border-orange-500">
            <h2 class="text-2xl font-bold text-orange-800 dark:text-orange-200 mb-4">Currently Watching 🎃</h2>
            @foreach($movies->where('status', 'currently_watching') as $movie)
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">{{ $movie->title }}</h3>
                    <div class="text-gray-600 dark:text-gray-400">{{ $movie->genre }}</div>
                    <div class="flex justify-between mt-2">
                        <a href="{{ route('movies.edit', $movie) }}" class="text-orange-600 hover:text-orange-800">Edit</a>
                        <form action="{{ route('movies.destroy', $movie) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Watched Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md border-2 border-blue-500">
            <h2 class="text-2xl font-bold text-orange-800 dark:text-orange-200 mb-4">Watched ❄️</h2>
            @foreach($movies->where('status', 'watched') as $movie)
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">{{ $movie->title }}</h3>
                    <div class="text-gray-600 dark:text-gray-400">{{ $movie->genre }}</div>
                    <div class="flex items-center mt-2">
                        <div class="text-yellow-500 mr-2">Rating:</div>
                        <div>
                            @for ($i = 0; $i < $movie->rating; $i++)
                                ⭐
                            @endfor
                        </div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <a href="{{ route('movies.edit', $movie) }}" class="text-orange-600 hover:text-orange-800">Edit</a>
                        <form action="{{ route('movies.destroy', $movie) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
