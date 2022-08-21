<?php

namespace Database\Seeders;

use App\Models\Agent;
use Database\Factories\AgentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Agent::factory()->count(AgentFactory::COUNT_AGENTS)->create();
    }
}
