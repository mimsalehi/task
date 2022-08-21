<?php


namespace App\Services\Implementations;


use App\Models\Order;
use App\Services\Contracts\DelayReportServiceInterface;
use App\Services\Contracts\DeliveryTimeEstimatorServiceInterface;
use Illuminate\Support\Facades\Http;

class DeliveryTimeEstimatorService implements DeliveryTimeEstimatorServiceInterface
{

    const ESTIMATE_API_ENDPOINT = 'https://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7';


    /**
     * @var DelayReportServiceInterface
     */
    private DelayReportServiceInterface $delayReportService;

    public function __construct()
    {
        $this->delayReportService = app()->make(DelayReportServiceInterface::class);
    }

    /**
     * @inheritdoc
     */
    public function estimate(Order $order)
    {
        $response = Http::get(self::ESTIMATE_API_ENDPOINT)->json();

        if ($response['status']) {
            $this->delayReportService->store($order, [
                'delay' => now()->diffInMinutes($order->delivery_time)
            ]);
            $order->delivery_time->addMinutes($response['data']['eta']);
            $order->save();
        }

        return $response['status'] ?? false;
    }
}
