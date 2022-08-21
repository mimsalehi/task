<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Models\Order;
use App\Services\Contracts\TripServiceInterface;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    /**
     * @var TripServiceInterface
     */
    protected TripServiceInterface $tripService;

    /**
     * TripController constructor.
     * @param TripServiceInterface $tripService
     */
    public function __construct(TripServiceInterface $tripService)
    {
        $this->tripService = $tripService;
    }

    /**
     * Stores new trip for an order
     * @param StoreTripRequest $request
     * @param Order $order
     * @return JsonResponse
     */
    public function store(StoreTripRequest $request, Order $order): JsonResponse
    {
        $trip = $this->tripService->store($order, $request->validated());
        return response()->json(new TripResource($trip));
    }
}
