<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // No olvides importar esto
use Illuminate\Database\Eloquent\Model;

class TenantPrompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'content',
        'is_active',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}