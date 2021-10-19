<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerDetailsRequest;
use App\Imports\CustomerImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Actions\Customer\UpdateCustomerDetailsAction;
class CustomersController extends Controller
{

    public function index(){

        if (Gate::allows('view-admin-dashboard')) {
            return Customer::all();
        }
    }

    public function import(Request $request) {
        $path = $request->file('file');

       //Excel::import(new CustomerImport, $path);

        (new CustomerImport)->import($path);

       return response()->json([
            'message' => 'import successfully',
            'file' => $path
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'code' => 'required',
            'name' => 'required',
            'location' => 'required',
            'phone' => 'required|min:9|numeric',
        ]);

        if($validator->fails()){
            return response()->json(['success'=> false,'message' => $validator->errors()], 400);
        }

        Customer::create([
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'location' => $request->get('location'),
            'phone' => $request->get('phone'),
        ]);

        return response()->json(["success" => true]);
    }

    public function changeDetails(CustomerDetailsRequest $customerDetailsRequest, UpdateCustomerDetailsAction $updateCustomerDetailsAction){

        if($updateCustomerDetailsAction->run($customerDetailsRequest->all())){
            return response()->json(["success" => true]);
        }
        return response()->json(["success" => false]);
    }

    public function showById($id){

        if(Gate::allows('view-admin-dashboard')){
            return Customer::findOrFail($id);
            //return new ContactsController(Contacts::all());
        }
    }

    public function destroy($id){

        $customer = Customer::findOrFail($id);

        if($customer->delete()){
            return response()->json(["success" => true]);
        }

        return response()->json(["success" => false]);
    }

}
