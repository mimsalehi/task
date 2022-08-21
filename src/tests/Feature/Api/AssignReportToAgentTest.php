<?php

namespace Tests\Feature\Api;

use App\Models\Agent;
use App\Models\Delay;
use App\Models\DelayReport;
use App\Models\Order;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssignReportToAgentTest extends TestCase
{
    /**
     * Tests assigning a report to an agent.
     *
     * @return void
     */
    public function test_report_assignment(): void
    {
        /** @var Agent $agent */
        $agent = Agent::factory()->createOne();

        $reports = DelayReport::factory()->count(rand(1, 10));

        Order::factory()->has($reports, 'reports')
            ->count(10)->create([
                'delivery_time' => now()->subMinutes(rand(15, 90))
            ]);

        $response = $this->post(route('orders.assign'), [
            'agent_id' => $agent->id
        ]);

        $response->assertStatus(200);

        $this->assertNotEmpty($agent->reports);
    }
}
