<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDbService;
use App\Models\Movie;

class FetchMovies extends Command
{
    protected $signature = 'movies:fetch';
    protected $description = 'Fetch now-playing movies from TMDb API';
    protected $tmdbService;

    // Inject TMDbService
    public function __construct(TMDbService $tmdbService)
    {
        parent::__construct();
        $this->tmdbService = $tmdbService;
    }

    // Command execution logic
    public function handle()
    {
        // Fetch movies from TMDb API
        $moviesData = $this->tmdbService->getNowPlayingMovies();

        // Iterate through movie results and store in database
        foreach ($moviesData['results'] as $data) {
            Movie::updateOrCreate(
                ['title' => $data['title']],
                [
                    'description' => $data['overview'],
                    'genre' => isset($data['genre_ids'][0]) ? $data['genre_ids'][0] : 'Unknown',
                    'status' => 'to_watch',
                    'rating' => null,
                    'user_id' => 1,  // Replace this with an appropriate user ID
                ]
            );
        }

        // Output to console to indicate the process is complete
        $this->info('Movies fetched successfully from TMDb.');
    }
}
