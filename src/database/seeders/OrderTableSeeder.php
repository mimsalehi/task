<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Trip;
use App\Models\Vendor;
use Database\Factories\OrderFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Order::factory()
            ->count(OrderFactory::COUNT_ORDERS)
            ->for(Vendor::factory())
            ->create();
    }
}
