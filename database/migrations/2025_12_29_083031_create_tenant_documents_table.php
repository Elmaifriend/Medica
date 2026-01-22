<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenant_documents', function (Blueprint $table) {
            $table->id();
            
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            
            $table->string('filename');   // Nombre en disco/S3
            $table->string('original_name')->nullable(); // Nombre original
            
            // pending, processing, indexed, failed
            $table->string('status')->default('pending')->index(); 
            $table->text('error_message')->nullable();
            
            $table->integer('token_count')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_documents');
    }
};
