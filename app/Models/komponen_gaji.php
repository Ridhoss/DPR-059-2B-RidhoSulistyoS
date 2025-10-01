<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class komponen_gaji extends Model
{
    protected $primaryKey = 'id_komponen_gaji';

    protected $fillable = [
        'nama_komponen',
        'kategori',
        'jabatan',
        'nominal',
        'satuan',
    ];

    public $timestamps = true;

    public function anggota()
    {
        return $this->belongsToMany(anggota::class, 'penggajian', 'id_komponen_gaji', 'id_komponen_gaji')
            ->withTimestamps();
    }
}
