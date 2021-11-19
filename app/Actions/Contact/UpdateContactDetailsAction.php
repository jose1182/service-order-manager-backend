<?php

namespace App\Actions\Contact;

use App\Models\Contacts;

class UpdateContactDetailsAction{

    public function run($request){

        $contact = Contacts::findOrFail($request['id']);
        $contact->name =  $request['name'];
        $contact->phone =  $request['phone'];
        $contact->email =  $request['email'];
        $contact->costumer_id =  $request['costumer']['id'];
        return $contact->save();
    }
}
