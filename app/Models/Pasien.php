<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = ['nama', 'umur', 'kamar_id'];
    
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
