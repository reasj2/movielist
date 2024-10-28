@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Movie</h1>
    <form action="{{ route('movies.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Movie Title" required>
        <textarea name="description" placeholder="Description"></textarea>
        <select name="genre">
            <option value="Action">Action</option>
            <option value="Drama">Drama</option>
            <option value="Comedy">Comedy</option>
        </select>
        <select name="status">
            <option value="to_watch">To Watch</option>
            <option value="currently_watching">Currently Watching</option>
            <option value="watched">Watched</option>
        </select>
        <input type="number" name="rating" min="1" max="5" placeholder="Rating (1-5)">
        <button type="submit">Add Movie</button>
    </form>
</div>
@endsection
