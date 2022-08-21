<?php

namespace App\Providers;

use App\Services\Contracts\DelayReportServiceInterface;
use App\Services\Contracts\DeliveryTimeEstimatorServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\StatisticsServiceInterface;
use App\Services\Contracts\TripServiceInterface;
use App\Services\Implementations\DelayReportService;
use App\Services\Implementations\StatisticsService;
use App\Services\Implementations\TripService;
use App\Services\Implementations\OrderService;
use App\Services\Implementations\DeliveryTimeEstimatorService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public array $singletons = [
        OrderServiceInterface::class => OrderService::class,
        DeliveryTimeEstimatorServiceInterface::class => DeliveryTimeEstimatorService::class,
        TripServiceInterface::class => TripService::class,
        DelayReportServiceInterface::class => DelayReportService::class,
        StatisticsServiceInterface::class => StatisticsService::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
