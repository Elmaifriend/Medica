<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Conversation;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $conversation = Conversation::where('external_chat_id', '5215599998888')->first();

        if ($conversation) {
            Message::create([
                'conversation_id' => $conversation->id,
                'role' => 'user',
                'content' => 'Hola, quiero agendar una cita',
                'type' => 'text',
                'external_message_id' => 'wamid.HBgLMS1',
                'status' => 'read',
            ]);

            Message::create([
                'conversation_id' => $conversation->id,
                'role' => 'assistant',
                'content' => '¡Hola Juan! Claro que sí. ¿Para qué especialidad la necesitas?',
                'type' => 'text',
                'external_message_id' => null,
                'status' => 'delivered',
            ]);
            
            Message::create([
                'conversation_id' => $conversation->id,
                'role' => 'user',
                'content' => 'Dental, por favor',
                'type' => 'text',
                'external_message_id' => 'wamid.HBgLMS2',
                'status' => 'read',
            ]);
        }

        Message::factory()->count(50)->create();
    }
}