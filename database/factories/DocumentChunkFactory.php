<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentChunk>
 */
class DocumentChunkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_document_id' => \App\Models\TenantDocument::factory(),
            'tenant_id' => function (array $attributes) {
                // Asegura que el tenant_id coincida con el del documento padre
                return \App\Models\TenantDocument::find($attributes['tenant_document_id'])->tenant_id;
            },
            'content' => $this->faker->paragraph(),
            // No llenamos 'embedding' en el factory por defecto por complejidad, 
            // se hace en lógica de negocio o con un state especial si es necesario.
        ];
    }
}
