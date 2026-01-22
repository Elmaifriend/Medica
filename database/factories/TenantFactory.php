<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->slug(2), 
            'name' => $this->faker->company(),
            'timezone' => $this->faker->timezone(),
            'status' => 'active',
            'data' => [], // Inicializamos el json vacío
        ];
    }
}