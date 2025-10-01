<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penggajian extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_anggota',
        'id_komponen_gaji',
    ];

    public $timestamps = true;

    public function anggota()
    {
        return $this->belongsTo(anggota::class, 'id_anggota', 'id_anggota');
    }

    public function komponen_gaji()
    {
        return $this->belongsTo(komponen_gaji::class, 'id_komponen_gaji', 'id_komponen_gaji');
    }
}
