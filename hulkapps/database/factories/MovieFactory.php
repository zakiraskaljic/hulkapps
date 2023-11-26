<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'year' => $this->faker->year(),
            'rating' => $this->faker->randomFloat(1, 1,10),
        ];
    }
}
