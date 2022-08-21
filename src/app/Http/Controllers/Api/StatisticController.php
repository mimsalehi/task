<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterStatisticsRequest;
use App\Http\Resources\StatisticsResource;
use App\Services\Contracts\StatisticsServiceInterface;
use Illuminate\Http\JsonResponse;

class StatisticController extends Controller
{
    /**
     * @var StatisticsServiceInterface
     */
    protected StatisticsServiceInterface $statisticsService;

    /**
     * StatisticController constructor.
     * @param StatisticsServiceInterface $statisticsService
     */
    public function __construct(StatisticsServiceInterface $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * Gets the weekly delay reports
     */
    public function index(FilterStatisticsRequest $request): JsonResponse
    {
        $results = $this->statisticsService->index($request->validated());
        return response()->json(StatisticsResource::collection($results));
    }
}
