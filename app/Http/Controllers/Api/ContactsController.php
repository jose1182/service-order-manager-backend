<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use Illuminate\Support\Facades\Gate;

class ContactsController extends Controller
{
    public function showById($id){

        if(Gate::allows('view-admin-dashboard')){
            return Contacts::where('customer_id', $id)->get();
            //return new ContactsController(Contacts::all());
        }
    }
}
