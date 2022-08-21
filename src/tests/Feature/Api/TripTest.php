<?php

namespace Tests\Feature\Api;

use App\Helpers\TripStatus;
use App\Models\Order;
use Tests\TestCase;

class TripTest extends TestCase
{
    /**
     * Tests whether a trip can be stored for an order or not!?
     *
     * @return void
     */
    public function test_store_trip(): void
    {
        /** @var Order $order */
        $order = Order::factory()->createOne();

        $trip_status = [TripStatus::ASSIGNED, TripStatus::AT_VENDOR, TripStatus::PICKED][rand(0, 2)];
        $response = $this->post(route('orders.trip.store', ['order' => $order->id]), [
            'status' => $trip_status
        ]);

        $response->assertStatus(200);

        $this->assertEquals(true, $order->trip()->exists());

        $this->assertEquals($order->trip->status, $trip_status);

        $response->assertJsonStructure([
            'id',
            'order_id',
            'status',
            'created_at'
        ]);
    }
}
