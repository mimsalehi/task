<?php


namespace App\Services\Implementations;


use App\Events\EstimateOrderDeliveryTime;
use App\Helpers\Constants;
use App\Helpers\TripStatus;
use App\Models\Agent;
use App\Models\DelayReport;
use App\Models\Order;
use App\Services\Contracts\DelayReportServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Response;

class OrderService implements OrderServiceInterface
{
    /**
     * @var DelayReportServiceInterface
     */
    private DelayReportServiceInterface $delayService;

    /**
     * OrderService constructor.
     *
     * @param DelayReportServiceInterface $delayService
     */
    public function __construct(DelayReportServiceInterface $delayService)
    {
        $this->delayService = $delayService;
    }

    /**
     * @inheritdoc
     */
    public function list(array $request = [])
    {
        return Order::query()->paginate($request['limit'] ?? Constants::PAGINATION_SIZE);
    }

    /**
     * @inheritdoc
     */
    public function report(Order $order)
    {
        $delivery_time = Carbon::parse($order->delivery_time);

        if (now()->lte($delivery_time)) {
            abort(Response::HTTP_FORBIDDEN, 'The delivery time has been past.');
        }

        if ($order->reports()->whereNull('agent_id')->exists()) {
            abort(Response::HTTP_FORBIDDEN, 'The delivery delay report is already reported.');
        }

        $delay = now()->diffInMinutes($delivery_time);
        if ($order->trip()->exists()) {
            if (in_array($order->trip->status, [
                TripStatus::AT_VENDOR,
                TripStatus::PICKED,
                TripStatus::ASSIGNED
            ])) {
                EstimateOrderDeliveryTime::dispatch($order);
            } else {
                $this->delayService->store($order,[
                    'delay'=> $delay
                ]);
            }
        } else {
            $this->delayService->store($order,[
                'delay'=> $delay
            ]);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function assign(array $request = [])
    {
        /** @var Agent $agent */
        $agent = Agent::query()->findOrFail($request['agent_id']);

        if ($agent->reports()->whereHas('order', function ($order) {
            $order->whereHas('trip', function ($trip) {
                $trip->where('status', '!=', TripStatus::DELIVERED);
            });
        })->exists()) {
            abort(Response::HTTP_FORBIDDEN, 'You already have an unhandled order.');
        }

        /** @var DelayReport $oldest_delay */
        $oldest_delay = DelayReport::query()
            ->whereNull('agent_id')
            ->orderByRaw('batch ASC, created_at ASC')
            ->first();

        return $agent->reports()->save($oldest_delay);
    }
}
