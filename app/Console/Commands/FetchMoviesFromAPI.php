<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use GuzzleHttp\Client;

class FetchMoviesFromAPI extends Command
{
    protected $signature = 'movies:fetch';
    protected $description = 'Fetch new movies from TMDb API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $client = new Client();
        $apiKey = env('0f87879248e4a0235dd93efaf91d6d0f');
        $url = 'https://api.themoviedb.org/3/movie/now_playing?api_key=' . $apiKey;

        try {
            $response = $client->get($url);
            $moviesData = json_decode($response->getBody(), true);

            foreach ($moviesData['results'] as $data) {
                Movie::updateOrCreate(
                    ['title' => $data['title']],
                    [
                        'description' => $data['overview'],
                        'genre' => 'Unknown',  // You can add genre mapping logic
                        'status' => 'to_watch',
                        'rating' => null,
                        'user_id' => 1,  // Set user_id appropriately
                    ]
                );
            }

            $this->info('Movies have been fetched successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to fetch movies: ' . $e->getMessage());
        }
    }
}
