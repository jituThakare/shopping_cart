<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;
    public $table ="user_data";
    public $timestamps = false;

    public $fillable = ['company','address1','city','state','pincode','email','mobile','firstname'];

    // public function getPaymentmodeAttribute($value)
    // {
    //     // return ucfirst($value);
    //     return $value ."- digital mode";
    // }
    public function setCityAttribute($value)
    {
        $this->attributes['city'] = strtoupper($value);
    }
    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = strtoupper($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

}
