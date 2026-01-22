<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Channel extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'tenant_id',
        'channel',
        'external_id',
        'display_name',
        'meta',
        'is_active'
    ];

    protected $casts = [
        'meta' => 'array',
        'is_active' => 'boolean',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}