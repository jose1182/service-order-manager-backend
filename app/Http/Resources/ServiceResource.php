<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $order = $this->order;

        //$cost


        return [
            'id' => $this->id,
            'order_service' => $this->order_service,
            'issue_date' => $this->issue_date,
            'order_details' => $order,
            'project' => $this->project,
            'costumer'=> $this->customer
        ];
    }
}
