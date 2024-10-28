@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold text-orange-800 dark:text-orange-300 mb-6">Add New Movie</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('movies.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full p-2 rounded border">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200">Genre</label>
            <input type="text" name="genre" value="{{ old('genre') }}" class="w-full p-2 rounded border">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200">Status</label>
            <select name="status" class="w-full p-2 rounded border">
                <option value="to_watch" {{ old('status') == 'to_watch' ? 'selected' : '' }}>Want to Watch</option>
                <option value="currently_watching" {{ old('status') == 'currently_watching' ? 'selected' : '' }}>Currently Watching</option>
                <option value="watched" {{ old('status') == 'watched' ? 'selected' : '' }}>Watched</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200">Rating (1-10)</label>
            <input type="number" name="rating" min="1" max="10" value="{{ old('rating') }}" class="w-full p-2 rounded border">
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Movie</button>
    </form>
</div>
@endsection
