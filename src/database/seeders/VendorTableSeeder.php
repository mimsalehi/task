<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Database\Factories\AgentFactory;
use Database\Factories\VendorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Vendor::factory()->count(VendorFactory::COUNT_VENDORS)->create();
    }
}
