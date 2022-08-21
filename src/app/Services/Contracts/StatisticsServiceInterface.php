<?php


namespace App\Services\Contracts;


use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface StatisticsServiceInterface
{
    /**
     * Gets the list of weekly delays ordered by delay time
     * @param array $request
     */
    public function index(array $request = []);
}
