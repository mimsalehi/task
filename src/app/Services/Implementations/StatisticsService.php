<?php


namespace App\Services\Implementations;


use App\Models\Vendor;
use App\Services\Contracts\StatisticsServiceInterface;

class StatisticsService implements StatisticsServiceInterface
{

    /**
     * @inheritDoc
     */
    public function index(array $request = [])
    {

        $vendors = Vendor::query()->with([
            'orders' => fn($orders) => $orders->withCount('reports')
                ->withSum('reports', 'delay_minutes')
        ])->whereHas('orders', function ($orders) use ($request) {
            $orders->whereHas('reports', function ($reports) use ($request) {
                if (isset($request['start']) && isset($request['end'])) {
                    $reports->whereBetween('created_at', [$request['start'], $request['end']]);
                } else {
                    $reports->whereBetween('created_at', [now()->subWeek()->toDateTimeString(), now()->toDateTimeString()]);
                }
            });
        })->get();

        $vendors->each(function ($vendor) {
            $vendor->reports_count = $vendor->orders->sum('reports_count');
            $vendor->sum_delay_minutes = $vendor->orders->sum('reports_sum_delay_minutes');
        });

        return $vendors->sortByDesc('sum_delay_minutes')->values()->all();
    }
}
