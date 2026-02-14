<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HariLayanans extends Model
{
    protected $fillable = ['hari'];

    public function jadwalKonselors()
    {
        return $this->hasMany(JadwalKonselors::class);
    }
}
