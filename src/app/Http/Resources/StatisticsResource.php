<?php

namespace App\Http\Resources;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Vendor|JsonResource $this */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'reports_count' => $this->reports_count,
            'sum_delay_minutes' => $this->sum_delay_minutes,
        ];
    }
}
