<?php

namespace App\Http\Resources;

use App\Models\ServiceOrder;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $serviceOrders = ServiceOrder::all();

        return [
            'service_orders' => $serviceOrders
        ];
    }
}
