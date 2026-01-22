<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Channel;
use App\Models\Tenant;

class ChannelSeeder extends Seeder
{
    public function run(): void
    {
        $demoTenant = Tenant::find('clinica-demo');

        if ($demoTenant) {
            Channel::create([
                'tenant_id' => $demoTenant->id,
                'channel' => 'whatsapp',
                'external_id' => '123456789', 
                'display_name' => 'WhatsApp Principal',
                'meta' => ['phone_number' => '5512345678'],
                'is_active' => true,
            ]);

            Channel::create([
                'tenant_id' => $demoTenant->id,
                'channel' => 'instagram',
                'external_id' => '987654321',
                'display_name' => 'IG Dra. Demo',
                'is_active' => true,
            ]);
        }
        
        Channel::factory()->count(10)->create();
    }
}