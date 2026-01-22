<?php

namespace Database\Factories;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    public function definition(): array
    {
        $conversation = Conversation::inRandomOrder()->first() ?? Conversation::factory()->create();
        
        $role = $this->faker->randomElement(['user', 'assistant']);

        return [
            'conversation_id' => $conversation->id,
            'role' => $role,
            'content' => $this->faker->sentence(),
            'type' => 'text',
            'external_message_id' => 'wamid.' . $this->faker->uuid(), 
            'status' => $role === 'user' ? 'read' : 'sent',
            'metadata' => [],
        ];
    }
}