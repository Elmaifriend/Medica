<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TenantPrompt;

class TenantPromptSeeder extends Seeder
{
    public function run(): void
    {
        TenantPrompt::factory()->count(10)->create();
    }
}