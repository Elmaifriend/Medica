<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'channel_id',
        'external_chat_id',
        'user_name',
        'status',
        'context',
    ];

    protected $casts = [
        'context' => 'array', 
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
}