<?php


namespace App\Services\Contracts;


use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface TripServiceInterface
{
    /**
     * Creates a trip for an order
     *
     * @param Order $order
     * @param array $request
     * @return Order[]|Collection|mixed
     */
    public function store(Order $order, array $request = []);
}
