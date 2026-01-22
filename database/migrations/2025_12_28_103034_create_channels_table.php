<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->uuid('id')->primary();             
            $table->string('tenant_id'); 

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');

            $table->string('channel'); // whatsapp, instagram, facebook
            $table->string('external_id')->index(); 
            $table->string('display_name'); // Ej: "WhatsApp Ventas"
            $table->json('meta')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};