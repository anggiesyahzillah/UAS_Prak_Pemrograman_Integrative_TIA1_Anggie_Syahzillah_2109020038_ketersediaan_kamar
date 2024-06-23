<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = ['nama', 'nomor', 'level', 'ketersediaan'];

    public function pasien()
    {
        return $this->hasOne(Pasien::class);
    }
}

