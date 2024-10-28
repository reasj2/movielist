<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TMDbService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        // **Hardcoded API Key**
        $this->apiKey  = 'eb585d064d58ee87c333b4a33f97ec21';
        $this->baseUrl = 'https://api.themoviedb.org/3';
    }

    // Fetch now playing movies
    public function getNowPlayingMovies()
    {
        $response = Http::get("{$this->baseUrl}/movie/now_playing", [
            'api_key'  => $this->apiKey,
            'language' => 'en-US',
            'region'   => 'US',
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            // Log the error
            Log::error('TMDb API Error (Now Playing):', [
                'status' => $response->status(),
                'error'  => $response->body(),
            ]);

            return [];
        }
    }

    // Fetch genres
    public function getGenres()
    {
        $response = Http::get("{$this->baseUrl}/genre/movie/list", [
            'api_key'  => $this->apiKey,
            'language' => 'en-US',
        ]);

        if ($response->successful()) {
            $genres = [];
            foreach ($response->json()['genres'] as $genre) {
                $genres[$genre['id']] = $genre['name'];
            }
            return $genres;
        } else {
            // Log the error
            Log::error('TMDb API Error (Genres):', [
                'status' => $response->status(),
                'error'  => $response->body(),
            ]);

            return [];
        }
    }
}
