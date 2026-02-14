<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konselis extends Model
{
    protected $fillable = [
        'user_id',
        'nim',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tikets()
    {
        return $this->hasMany(Tikets::class);
    }
}
