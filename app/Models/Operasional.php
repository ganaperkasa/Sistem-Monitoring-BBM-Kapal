<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operasional extends Model
{
    protected $table = 'operasionals';

    protected $fillable = [
        'nama_kapal',
        'tanggal',
        'lama_operasi',
        'jarak_tempuh',
        'konsumsi_bbm',
    ];

     public function emisi()
    {
        return $this->hasOne(Emisi::class, 'operasional_id');
    }
}
