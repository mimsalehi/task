<?php

namespace App\Listeners;

use App\Events\EstimateOrderDeliveryTime;
use App\Services\Contracts\DeliveryTimeEstimatorServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EstimateOrderDeliveryTimeListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var DeliveryTimeEstimatorServiceInterface
     */
    private DeliveryTimeEstimatorServiceInterface $deliveryTimeEstimatorService;

    /**
     * EstimateOrderDeliveryTimeListener constructor.
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->deliveryTimeEstimatorService = app()->make(DeliveryTimeEstimatorServiceInterface::class);
    }

    /**
     * Handle the event.
     *
     * @param EstimateOrderDeliveryTime $event
     * @return void
     */
    public function handle(EstimateOrderDeliveryTime $event): void
    {
        $this->deliveryTimeEstimatorService->estimate($event->order);
    }
}
