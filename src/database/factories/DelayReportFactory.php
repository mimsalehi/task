<?php

namespace Database\Factories;

use App\Models\Delay;
use App\Models\DelayReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delay>
 */
class DelayReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        /** @var DelayReport $latest_delay */
        $latest_delay = DelayReport::query()->latest('created_at')->first();

        return [
            'batch' => !is_null($latest_delay) ? $latest_delay->batch + 1 : 1,
            'delay_minutes' => 14,
        ];
    }
}
