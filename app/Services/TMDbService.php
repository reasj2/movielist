<?php

namespace App\Services;

use GuzzleHttp\Client;

class TMDbService
{
    protected $client;
    protected $apiKey;
    protected $bearerToken;

    public function __construct()
    {
        // Initialize the Guzzle client
        $this->client = new Client();

        // Retrieve API Key and Bearer Token from environment variables
        $this->apiKey = env('TMDB_API_KEY');
        $this->bearerToken = env('TMDB_BEARER_TOKEN');
        
        // Log the values to verify
        \Log::info('API Key: ' . $this->apiKey);
        \Log::info('Bearer Token: ' . $this->bearerToken);
    }

    // Method to fetch "now playing" movies from TMDb API
    public function getNowPlayingMovies()
    {
        try {
            // Send a request to TMDb API endpoint
            $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/now_playing', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->bearerToken,
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'api_key' => $this->apiKey,  // Use the API key here
                    'language' => 'en-US',
                    'page' => 1,
                ],
            ]);

            // Decode JSON response to an associative array
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Log error and return empty array to avoid breaking
            \Log::error('Failed to fetch movies: ' . $e->getMessage());
            return [];
        }
    }
}
