<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emisi extends Model
{
    protected $table = 'emisi';

    protected $fillable = [
        'operasional_id',
        'co2',
        'nox',
        'so2',
        'efisiensi',
    ];

     public function operasional()
    {
        return $this->belongsTo(Operasional::class, 'operasional_id');
    }
}
