<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_chunks', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('tenant_document_id')->constrained('tenant_documents')->onDelete('cascade');
            
            // Redundancia controlada para búsquedas vectoriales rápidas
            $table->string('tenant_id')->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');

            $table->text('content'); 
            
            // Metadatos extra del chunk (nágina, ubicación, etc.)
            $table->json('metadata')->nullable(); 

            $table->timestamps();
        });

        // Agregamos la columna vector (1536 dimensiones para OpenAI standard)
        //DB::statement('ALTER TABLE document_chunks ADD COLUMN embedding vector(1536);');

        // Índice HNSW para búsqueda ultrarrápida (cosine distance)
        //DB::statement('CREATE INDEX document_chunks_embedding_index ON document_chunks USING hnsw (embedding vector_cosine_ops);');
    }

    public function down(): void
    {
        Schema::dropIfExists('document_chunks');
    }
};
