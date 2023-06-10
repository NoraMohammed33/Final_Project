<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                 'title' => fake()->name(),
                 'body' => fake()->name(),
                 'user_id'=>rand(3,10),
                 'dep_id'=>rand(5,15),
            //
        ];
    }
}
