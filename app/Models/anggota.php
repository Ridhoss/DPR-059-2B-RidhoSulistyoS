<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'gelar_depan',
        'gelar_belakang',
        'jabatan',
        'status_pernikahan',
    ];

    public $timestamps = true;

    public function komponen_gaji()
    {
        return $this->belongsToMany(komponen_gaji::class, 'penggajian', 'id_anggota', 'id_anggota')
            ->withTimestamps();
    }
}
