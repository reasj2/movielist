@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 bg-orange-100 dark:bg-gray-900 rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-semibold text-orange-800 dark:text-orange-300 mb-6">Edit Movie 🎥</h1>
    <form action="{{ route('movies.update', $movie->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block font-medium text-orange-800 dark:text-orange-200">Movie Title</label>
            <input type="text" name="title" id="title" value="{{ $movie->title }}" class="w-full p-2 rounded-md" placeholder="e.g., The Nightmare Before Christmas" required>
        </div>

        <div>
            <label for="description" class="block font-medium text-orange-800 dark:text-orange-200">Description</label>
            <textarea name="description" id="description" class="w-full p-2 rounded-md" placeholder="Add a short description...">{{ $movie->description }}</textarea>
        </div>

        <div>
            <label for="genre" class="block font-medium text-orange-800 dark:text-orange-200">Genre</label>
            <select name="genre" id="genre" class="w-full p-2 rounded-md">
                <option value="Action" {{ $movie->genre == 'Action' ? 'selected' : '' }}>Action</option>
                <option value="Drama" {{ $movie->genre == 'Drama' ? 'selected' : '' }}>Drama</option>
                <option value="Comedy" {{ $movie->genre == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                <option value="Fantasy" {{ $movie->genre == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                <option value="Horror" {{ $movie->genre == 'Horror' ? 'selected' : '' }}>Horror</option>
            </select>
        </div>

        <div>
            <label for="status" class="block font-medium text-orange-800 dark:text-orange-200">Status</label>
            <select name="status" id="status" class="w-full p-2 rounded-md">
                <option value="to_watch" {{ $movie->status == 'to_watch' ? 'selected' : '' }}>Want to Watch</option>
                <option value="currently_watching" {{ $movie->status == 'currently_watching' ? 'selected' : '' }}>Currently Watching</option>
                <option value="watched" {{ $movie->status == 'watched' ? 'selected' : '' }}>Watched</option>
            </select>
        </div>

        <div>
            <label for="rating" class="block font-medium text-orange-800 dark:text-orange-200">Rating</label>
            <input type="number" name="rating" id="rating" min="1" max="5" value="{{ $movie->rating }}" class="w-full p-2 rounded-md" placeholder="Rate 1-5">
        </div>

        <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700 transition ease-in-out duration-200">Save Changes</button>
    </form>
</div>
@endsection
