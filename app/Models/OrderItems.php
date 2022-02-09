<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    public $timestamps = false;
    // protected $hidden = ['productid'];
    // public function getQuantityAttribute($value)
    // {
    //     // return ucfirst($value);
    //     return $value ." items in db";
    // }
   

}
