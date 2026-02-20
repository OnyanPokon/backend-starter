<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HariLayanans extends Model
{
    protected $fillable = ['hari'];

    public function jadwalKonselors()
    {
        return $this->hasMany(
            JadwalKonselors::class,
            'hari_layanan_id', // foreign key di jadwal_konselors
            'id'               // local key di hari_layanans
        );
    }
}
