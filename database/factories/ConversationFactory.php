<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\Conversation;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversationFactory extends Factory
{
    protected $model = Conversation::class;

    public function definition(): array
    {
        $channel = Channel::inRandomOrder()->first() ?? Channel::factory()->create();

        return [
            'tenant_id' => $channel->tenant_id, 
            'channel_id' => $channel->id,
            'external_chat_id' => $this->faker->numerify('###########'), 
            'user_name' => $this->faker->name(),
            'status' => $this->faker->randomElement(['active', 'closed', 'pending']),
            'context' => [],
        ];
    }
}