<?php


namespace App\Services\Implementations;


use App\Models\DelayReport;
use App\Models\Order;
use App\Services\Contracts\DelayReportServiceInterface;
use Illuminate\Database\Eloquent\Model;

class DelayReportService implements DelayReportServiceInterface
{

    /**
     * @inheritdoc
     */
    public function store(Order $order, array $request = [])
    {
        /** @var DelayReport $latest_delay */
        $latest_delay = DelayReport::query()->latest('created_at')->first();

        return $order->reports()
            ->save(
                new DelayReport([
                    'batch' => !is_null($latest_delay) ? $latest_delay->batch + 1 : 1,
                    'delay_minutes' => $request['delay'],
                ])
            );
    }
}
