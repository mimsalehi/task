<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentRequest;
use App\Http\Requests\FilterOrdersRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * @var OrderServiceInterface
     */
    protected OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Gets the list of orders
     *
     * @param FilterOrdersRequest $request
     * @return JsonResponse
     */
    public function index(FilterOrdersRequest $request): JsonResponse
    {
        $orders = $this->orderService->list($request->validated());
        return response()->json(OrderResource::collection($orders));
    }

    /**
     * Stores a delay report to the order
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function report(Order $order): JsonResponse
    {
        $result = $this->orderService->report($order);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Delay reported successfully!' : 'Failed to report delay.'
        ]);
    }

    /**
     * Assigns the order to an Agent
     *
     * @param AssignmentRequest $request
     * @return JsonResponse
     */
    public function assignToAgent(AssignmentRequest $request): JsonResponse
    {
        $result = $this->orderService->assign($request->validated());

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Order assigned to agent successfully!' : 'Failed to assign the agent to order.'
        ]);
    }
}
