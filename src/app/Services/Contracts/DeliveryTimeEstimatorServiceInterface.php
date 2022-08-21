<?php


namespace App\Services\Contracts;


use App\Models\Order;

interface DeliveryTimeEstimatorServiceInterface
{
    /**
     * Estimates the delivery time for an Order
     */
    public function estimate(Order $order);
}
