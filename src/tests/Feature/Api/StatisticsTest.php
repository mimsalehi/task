<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatisticsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_statistics_list(): void
    {
        $response = $this->get(route('statistics.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'id',
                'title',
                'address',
                'created_at',
                'reports_count',
                'sum_delay_minutes'
            ]
        ]);
    }
}
