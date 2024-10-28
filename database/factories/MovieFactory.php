<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'genre' => $this->faker->randomElement(['Action', 'Drama', 'Comedy']),
            'status' => $this->faker->randomElement(['to_watch', 'currently_watching', 'watched']),
            'rating' => $this->faker->numberBetween(1, 5),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
