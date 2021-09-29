<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'order_service',
        'costumer_code',
        'costumer_name',
        'pev',
        'order_date',
        'shipment_date',
        'product_name',
        'quantity',
        'description'
    ];

    // protected static function boot(){
    //     parent::boot();S

    //     static::created(function ($service){
    //         //var_dump($service->costumer_id);
    //         $service->service()->create([
    //             'title' => '$service->costumer_id',
    //         ]);
    //     });


    // }

    public function user(){
        return $this->belongsToMany(User::class, 'users_permissions');
    }

    public function service(){
        return $this->hasOne(Service::class);
    }

    public function order(){
        return $this->hasOne(Order::class);
    }

}
