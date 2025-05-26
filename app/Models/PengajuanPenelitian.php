<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPenelitian extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_penelitian';

    protected $fillable = [
        'tahun_penelitian',
        'judul_penelitian',
        'nidn_ketua',
        'jabatan',
        'nama_lengkap',
        'prodi',
        'email',
        'no_wa',
        'skema_usulan',
        'file_proposal',
        'status',
        'komentar_review',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function anggota()
    {
        return $this->hasMany(\App\Models\AnggotaPenelitian::class, 'id_proposal');
    }

    public function anggotaMahasiswa()
    {
        return $this->hasMany(\App\Models\AnggotaPenelitianMahasiswa::class, 'id_proposal');
    }
}
