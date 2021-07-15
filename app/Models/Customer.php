<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //public $incrementing = false;

    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'location',
        'phone'
    ];
}
