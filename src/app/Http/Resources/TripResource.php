<?php

namespace App\Http\Resources;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Trip|JsonResource $this */

        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
