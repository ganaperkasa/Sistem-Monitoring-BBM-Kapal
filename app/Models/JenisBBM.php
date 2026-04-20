<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisBBM extends Model
{
    use HasFactory;

    protected $table = 'jenis_bbms';

    protected $fillable = [
        'jenis_bbm',
        'faktor_emisi',
        'sulfur',
    ];
}
