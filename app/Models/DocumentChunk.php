<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentChunk extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_document_id', 
        'tenant_id', 
        'content', 
        'metadata'
        // 'embedding' no se incluye en fillable estándar para evitar errores de tipo array vs string
    ];

    public function document()
    {
        return $this->belongsTo(TenantDocument::class, 'tenant_document_id');
    }
    
    // Relación directa al tenant (útil para validaciones)
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}