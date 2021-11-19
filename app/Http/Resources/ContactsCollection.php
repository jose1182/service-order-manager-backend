<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $this->collection->map(function ($contact){
            $costumer = $contact->costumer;
            unset($contact['costumer_id']);
            return $costumer;
        });


        return [
            'data' => $this->collection->all()
        ];
    }
}
