<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id', 
        'filename', 
        'original_name', 
        'status', 
        'error_message', 
        'token_count'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function chunks()
    {
        return $this->hasMany(DocumentChunk::class);
    }
}