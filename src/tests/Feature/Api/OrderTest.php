<?php

namespace Tests\Feature\Api;

use App\Models\Order;
use App\Models\Vendor;
use Database\Factories\OrderFactory;
use Database\Seeders\OrderTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
//    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Order::factory()->count(OrderFactory::COUNT_ORDERS)->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_orders_list_route(): void
    {

        $this->withoutExceptionHandling();

        $response = $this->get(route('orders.index'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            [
                'id',
                'title',
                'description',
                'delivery_time'
            ]
        ]);
    }
}
