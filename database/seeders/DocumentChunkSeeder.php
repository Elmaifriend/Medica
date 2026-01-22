<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentChunkSeeder extends Seeder
{
    public function run(): void
    {
        // Crea chunks para los documentos existentes
        $documents = \App\Models\TenantDocument::all();
        foreach($documents as $doc) {
            \App\Models\DocumentChunk::factory()->count(3)->create([
                'tenant_document_id' => $doc->id,
                'tenant_id' => $doc->tenant_id
            ]);
        }
    }
}
