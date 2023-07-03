<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Message::class;

    public function definition(): array
    {
        do{
            $sender_id = rand(1,22);
            $recipient_id = rand(1,22);
        }while($sender_id === $recipient_id);

        return [
            'sender_id' => $sender_id,
            'recipient_id' => $recipient_id,
            'content' => $this->faker->sentence(),
        ];
    }
}
