<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::firstOrCreate(
            ['id' => 'clinica-demo'],
            [
                'name' => 'Clínica Demo Principal',
                'timezone' => 'America/Mexico_City',
                'status' => 'active',
            ]
        );

        $tenant->run(function () {
            $this->call([
                ConversationSeeder::class,
                MessageSeeder::class,
            ]);
        });
    }
}
