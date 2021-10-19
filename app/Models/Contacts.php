<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    //relación uno a muchos (inversa)
    public function costumer(){
        return $this->belongsTo(Customer::class);
    }

    //Relación uno a muchos
    public function services(){
        return $this->hasMany(Service::class);

    }
}
