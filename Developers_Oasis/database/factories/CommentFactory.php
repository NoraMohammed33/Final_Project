<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'body' => fake()->name(),
            'user_id'=>rand(3,10),
            'post_id'=>rand(5,10),
            'commentable_type'=>fake()->name(),
            'commentable_id'=>rand(5,15),
             //
        ];
    }
}
