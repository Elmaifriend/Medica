<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->string('role'); // 'user' (cliente), 'assistant' (bot), 'system' (nota interna)
            $table->text('content')->nullable(); 
            $table->string('type')->default('text');
            $table->string('external_message_id')->nullable()->index();
            $table->string('status')->default('sent');
            $table->json('metadata')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};