<?php

namespace App\Actions\Service;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class ServiceAction{
    public function run($request){

        //Find customer code to create
        $costumer = Customer::select('id')->where('code', $request['costumer_code'])->first();

        $date = Carbon::now();

        $service = Service::create([
            'order_service' => 'OS-0001',
            'issue_date'    => $date,
            'order_id'      => $request['id'],
            'project_id'    => $request['project_id'],
            'user_id'       => Auth::user()->id,
            'costumer_id'   => $costumer->id
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
