<?php


namespace App\Services\Implementations;

use App\Models\Order;
use App\Models\Trip;
use App\Services\Contracts\TripServiceInterface;

class TripService implements TripServiceInterface
{

    /**
     * @inheritdoc
     */
    public function store(Order $order, array $request = [])
    {
        return $order->trip()
            ->save(
                new Trip([
                    'status' => $request['status'] ?? null
                ])
            );
    }
}
