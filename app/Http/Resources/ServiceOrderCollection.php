<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use PhpParser\Node\Expr\Cast\Object_;

class ServiceOrderCollection extends ResourceCollection
{
    public $preserveKeys = true;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $data = $this->collection->map(function($service, $key){
            return[
                'id' => $service->id,
                'serviceId' => $service->order_service,
                'issue_date' => $service->issue_date,
                'costumer' => $service->costumer->name? $service->costumer->name:'not defined',
                'technician'=> $service->technician? $service->technician->name:'not defined',
                'responsible'=>$service->responsible? $service->responsible->name:'not defined',
                'service_date'=>$service->service_date != null? $service->service_date: 'not defined',
                'start_time'=>$service->start_time != null? $service->start_time: 'not defined',
                'expected_hours'=>$service->expected_hours != null? $service->expected_hours: 'not defined',
                'invested_hours'=>$service->invested_hours != null? $service->invested_hours: 'not defined',
                'isIncidence'=>$service->isIncidence,
                'isFinished'=>$service->isFinished,
                'invested_hours'=>$service->invested_hours != null? $service->invested_hours: 'not defined',
            ];
        });

        return [
            'data' => $data->all()
        ];
    }
}
