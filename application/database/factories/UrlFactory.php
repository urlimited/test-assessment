<?php

namespace Database\Factories;

use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Url>
 */
class UrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'destination' => fake()->url(),
            'slug' => fake()->unique()->regexify('[A-Za-z0-9]{' . config('url_shortening.url_length') .'}'),
            'views' => fake()->numberBetween(0, 5),
        ];
    }
}
