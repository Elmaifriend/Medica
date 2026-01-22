<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    public function definition(): array
    {
        $tenant = Tenant::inRandomOrder()->first() ?? Tenant::factory()->create();

        $type = $this->faker->randomElement(['whatsapp', 'instagram', 'facebook']);

        return [
            'tenant_id' => $tenant->id,
            'channel' => $type,
            'external_id' => $this->faker->unique()->numerify('##########'), 
            'display_name' => ucfirst($type) . ' ' . $this->faker->word(),
            'meta' => ['access_token' => 'mock_token_' . \Illuminate\Support\Str::random(10)],
            'is_active' => true,
        ];
    }
}