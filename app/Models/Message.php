<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'role',
        'content',
        'type',
        'external_message_id',
        'status',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array', // JSON a Array
    ];

    // Relación: Un mensaje pertenece a una Conversación
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}