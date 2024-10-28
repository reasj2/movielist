@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('movies.create') }}" class="btn btn-primary">Add New Movie</a>
    <h1>Your Movies</h1>
    <ul>
        @foreach($movies as $movie)
            <li>
                {{ $movie->title }} - {{ $movie->status }}
                <a href="{{ route('movies.edit', $movie) }}">Edit</a>
                <form action="{{ route('movies.destroy', $movie) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
