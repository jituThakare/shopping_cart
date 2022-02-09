<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'p_id', 
        'u_id',
        'review',
        'created_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
