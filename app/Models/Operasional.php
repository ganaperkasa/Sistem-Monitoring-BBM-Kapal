<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operasional extends Model
{
    protected $table = 'operationals';

    protected $fillable = ['user_id','jenis_kapal', 'tahun_kapal', 'kapasitas_kapal', 'area', 'tier', 'rpm', 'daya_mesin', 'lama_operasi', 'jarak_tempuh', 'konsumsi_bbm', 'jenis_bbm_id', 'co2', 'nox', 'sox', 'cii'];

    public function bbm()
    {
        return $this->belongsTo(JenisBbm::class, 'jenis_bbm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
