<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPenelitianMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'anggota_penelitian_mahasiswa';

    protected $fillable = [
        'id_proposal',
        'npm_nama_mahasiswa',
    ];

    /**
     * Relasi kembali ke proposal
     */
    public function proposal()
    {
        return $this->belongsTo(\App\Models\PengajuanPenelitian::class, 'id_proposal');
    }
}