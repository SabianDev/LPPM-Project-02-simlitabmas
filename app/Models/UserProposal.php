<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProposal extends Model
{
    use HasFactory;

    // Karena nama tabel tidak mengikuti konvensi plural, kita override nama tabel:
    protected $table = 'pengajuan_penelitian';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'user_id',
        // tambahkan kolom lain sesuai dengan tabel, misalnya:
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
    ];

    public function anggota()
    {
        return $this->hasMany(\App\Models\AnggotaPenelitian::class, 'id_proposal');
    }

    public function anggotaMahasiswa()
    {
        return $this->hasMany(\App\Models\AnggotaPenelitianMahasiswa::class, 'id_proposal');
    }
}
