<?php

namespace App\Actions\Customer;

use App\Models\Customer;

class UpdateCustomerDetailsAction{

    public function run($request){

        $customer = Customer::findOrFail($request['id']);
        $customer->code =  $request['code'];
        $customer->name =  $request['name'];
        $customer->location =  $request['location'];
        $customer->phone =  $request['phone'];
        return $customer->save();
    }
}
