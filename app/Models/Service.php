<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->BelongsTo(User::class);
    }
    public function serviceOrder(){
//        return $this->belongsToMany(ServiceOrder::class, 'service_orders_services');
        return $this->belongsToMany(ServiceOrder::class);

    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function contact(){
        return $this->belongsTo(Contacts::class);
    }

    public function contacting(){
        return $this->belongsTo(Contacts::class);
    }

    public function technician(){
        return $this->belongsTo(User::class);
    }

    public function responsible(){
        return $this->belongsTo(User::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

}
