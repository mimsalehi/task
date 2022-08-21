<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Order|JsonResource $this */

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'delivery_time' => $this->delivery_time,
        ];
    }
}
