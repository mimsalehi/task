<?php

namespace Tests\Feature\Api;

use App\Models\Order;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DelayReportTest extends TestCase
{

    /**
     * Stores new delay report for an order
     *
     * @return void
     */
    public function test_delay_report(): void
    {

        /** @var Order $order */
        $order = Order::factory()->create([
            'delivery_time' => now()->subMinutes(rand(15, 90))
        ]);

        $response = $this->post(route('orders.report', ['order' => $order->id]));

        $response->assertStatus(200);


        $response->assertJsonStructure([
            'success',
            'message'
        ]);
    }

    /**
     * Tests if order is queued in delays queue
     *
     * @return void
     */
    public function test_delay_report_queued(): void
    {

        /** @var Order $order */
        $order = Order::factory()->has(Trip::factory())->create([
            'delivery_time' => now()->subMinutes(rand(15, 90))
        ]);

        $response = $this->post(route('orders.report', ['order' => $order->id]));

        $response->assertStatus(200);

        $this->assertNotEmpty($order->reports);

        $response->assertJsonStructure([
            'success',
            'message'
        ]);
    }

    /**
     * Tests if order is queued in delays queue
     *
     * @return void
     */
    public function test_delay_report_not_queued(): void
    {

        /** @var Order $order */
        $order = Order::factory()->has(Trip::factory()->assigned())->create([
            'delivery_time' => now()->subMinutes(rand(15, 90))
        ]);

        $response = $this->post(route('orders.report', ['order' => $order->id]));

        $response->assertStatus(200);

        $this->assertEmpty(  $order->reports);

        $response->assertJsonStructure([
            'success',
            'message'
        ]);
    }
}
