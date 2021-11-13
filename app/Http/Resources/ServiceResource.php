<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
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




        return [
            'id' => $this->id,
            'order_service' => $this->order_service,
            'issue_date' => $this->issue_date,
            'order_details' => $order,
            'project' => $this->project,
            'costumer'=> $this->customer,
            'contact'=> $this->contact,
            'contacting'=>$this->contacting,
            'user'=>$this->user,
            'technician'=> $this->technician,
            'responsible'=>$this->responsible,
            'address' => $this->address,
            'service_date'=>$this->service_date,
            'start_time'=>$this->start_time,
            'expected_hours'=>$this->expected_hours,
            'description'=>$this->description,
            'isIncidence'=>$this->isIncidence,
            'isFinished'=>$this->isFinished,
            'invested_hours'=>$this->invested_hours,
            'end_date'=>$this->end_date,
            'isCheckedByTechnician'=>$this->isCheckedByTechnician,
            'isCheckedByCoordinator'=>$this->isCheckedByCoordinator,
            'isCheckedByAccount'=>$this->isCheckedByAccount,
            //'testing'=>Auth::user()->services
        ];
    }
}
