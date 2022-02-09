<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    public $table = 'orders';
    public $timestamps = false;

    // set the accessor for fetch data 
    // public function getUseridAttribute($value)
    // {
    //     // return ucfirst($value);
    //     return $value ." items in db";
    // }
    // public function getPaymentmodeAttribute($value)
    // {
    //     // return ucfirst($value);
    //     return $value ." items in db";
    // }

    public function orderTracking(){
        return $this->hasOne(orderTracking::class, 'order_id');
    }
    public function orderItems(){
        return $this->hasMany(orderItems::class, 'order_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id');
    }
   

}
