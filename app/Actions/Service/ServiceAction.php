<?php

namespace App\Actions\Service;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Client\ResponseSequence;

class ServiceAction{
    public function run($request){

        $costumer = Customer::select('id')->where('code', $request['costumer_code'])->first();
        $date = Carbon::now();

        $service = Service::create([
            'order_service' => 'OS-0001',
            'issue_date'    => $date,
            'order_id'      => $request['id'],
            'project_id'    => $request['project_id'],
            'customer_id'   => $costumer
        ]);

        if($service){
            $order = Order::findOrFail($request['id']);
            $order->service_id =  $service->id;
            $order->order_service = $service->order_service;
            $order->save();
        }

        return $service;
    }
}
