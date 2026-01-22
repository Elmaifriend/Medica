<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TenantDocument>
 */
class TenantDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => \App\Models\Tenant::factory(),
            'filename' => $this->faker->uuid() . '.pdf',
            'original_name' => 'manual_usuario.pdf',
            'status' => 'indexed',
            'token_count' => $this->faker->numberBetween(100, 5000),
        ];
    }
}
