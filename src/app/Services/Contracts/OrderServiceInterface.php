<?php


namespace App\Services\Contracts;


use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderServiceInterface
{
    /**
     * Gets the Orders list
     * @param array $request
     * @return Order[]|Collection|mixed
     */
    public function list(array $request = []);

    /**
     * Stores a delay report about the order.
     *
     * @param Order $order
     * @return mixed
     */
    public function report(Order $order);

    /**
     * Assigns an order to an agent.
     *
     * @param array $request
     * @return mixed
     */
    public function assign(array $request = []);
}
