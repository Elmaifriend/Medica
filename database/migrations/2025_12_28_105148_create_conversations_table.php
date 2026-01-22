<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();

            $table->foreignUuid('channel_id')->constrained('channels')->cascadeOnDelete();
            $table->string('external_chat_id')->index(); 
            $table->string('user_name')->nullable(); 
            $table->string('status')->default('active'); // active, closed, bot_pending
            
            // 5. Contexto (opcional, pero útil para bots)
            // Aquí guardaremos en qué paso del bot se quedó el usuario
            $table->json('context')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};