<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'location',
        'phone'
    ];

    //Relación uno a muchos
    public function address(){
        return $this->hasMany(Address::class);
    }

    //Relación uno a muchos
    public function contacts(){
        return $this->hasMany(Contacts::class);
    }

    //Relación uno a muchos
    public function services(){
        return $this->hasMany(Service::class);

    }

}
