<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantPromptFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(), // Crea un tenant si no se le pasa uno
            'content' => "Eres un asistente virtual útil y amable. Tu objetivo es ayudar a los clientes con sus dudas sobre nuestros servicios.",
            'is_active' => true,
        ];
    }
}