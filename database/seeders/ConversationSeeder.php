<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\Tenant;

class ConversationSeeder extends Seeder
{
    public function run(): void
    {
        $demoTenant = Tenant::with('channels')->find('clinica-demo');

        if ($demoTenant && $demoTenant->channels->count() > 0) {
            $mainChannel = $demoTenant->channels->first();

            Conversation::create([
                'tenant_id' => $demoTenant->id,
                'channel_id' => $mainChannel->id,
                'external_chat_id' => '5215599998888', 
                'user_name' => 'Paciente Juan Pérez',
                'status' => 'active',
                'context' => ['step' => 'awaiting_appointment_date'],
            ]);
        }

        Conversation::factory()->count(20)->create();
    }
}