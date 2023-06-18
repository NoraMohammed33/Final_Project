<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expert>
 */
class ExpertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                 'bio' => fake()->name(),
                 'user_id'=>rand(3,10),
                 'dept_id'=>rand(5,10),
                //  'image' => fake()->imageUrl(),

            //
        ];
    }
}
