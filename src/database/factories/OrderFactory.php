<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{

    const COUNT_ORDERS = 10;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vendor_id' => Vendor::factory(),
            'title' => $this->faker->word,
            'description' => $this->faker->text(150),
            'delivery_time' => now()->addMinutes(rand(15, 15 * rand(1, 12))), // 15 minutes upto 3 hours later
        ];
    }
}
