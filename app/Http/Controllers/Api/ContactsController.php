<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ContactDetailsRequest;
use App\Actions\Contact\UpdateContactDetailsAction;
use App\Http\Resources\ContactsCollection;
use App\Http\Resources\UserCollection;

class ContactsController extends Controller
{

    public function index2(){

        if(Gate::allows('view-admin-dashboard')){
            return Contacts::all();
        }
    }

    public function index(){
        if(Gate::allows('view-admin-dashboard')){
            return  new ContactsCollection(Contacts::all());
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'costumer.id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['success' => false,'message' => $validator->errors()], 400);
        }

        Contacts::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'costumer_id' => $request->get('costumer')['id']

        ]);

        return response()->json(['success' => true]);

    }

    public function showById($id){

        if(Gate::allows('view-admin-dashboard')){
            return Contacts::where('costumer_id', $id)->get();
            //return new ContactsController(Contacts::all());
        }
    }

    public function changeDetails(ContactDetailsRequest $contactDetailsRequest, UpdateContactDetailsAction $updateContactDetailsAction){

        if($updateContactDetailsAction->run($contactDetailsRequest->all())){
            return response()->json(["success" => true]);
        }
        return response()->json(["success" => false]);
    }


    public function destroy($id){
        $contact = Contacts::findOrFail($id);

        if($contact->delete()){
            return response()->json(['success' => true ]);
        }

        return response()->json(['success' => false]);
    }
}
