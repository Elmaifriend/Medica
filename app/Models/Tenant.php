<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant
{
    use HasDatabase, HasDomains;
    public $incrementing = false;

    protected $fillable = [
        'id', 
        'name',
        'timezone',
        'status',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function prompts()
    {
        return $this->hasMany(TenantPrompt::class);
    }
    
    public function currentPrompt()
    {
        return $this->hasOne(TenantPrompt::class)->latestOfMany();
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'timezone',
            'status',
        ];
    }
}