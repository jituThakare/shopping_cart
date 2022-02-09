<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'u_id');
    }
    public function userData(){
        return $this->hasOne(UserData::class, 'user_id');
    }
    public function orders(){
        return $this->hasMany(Orders::class, 'userid');
    }

    // Has Many Through intermediate table
    public function ordersItems()
    {
        return $this->hasManyThrough(
            OrderItems::class,
             Orders::class,
             'userid', // Foreign key on the environments table...
             'order_id', // Foreign key on the deployments table...
             'id', // Local key on the projects table...
    );
    }
}
