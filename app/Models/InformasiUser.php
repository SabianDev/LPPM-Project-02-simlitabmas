<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiUser extends Model
{
    use HasFactory;

    protected $table = 'informasi_user';

    protected $fillable = [
        'user_id',
        'nidn',
        'nama',
        'prodi',
        'jenjang_pendidikan',
        'jabatan_akademik',
        'bidang_ilmu',
        'sinta_score_overall',
        'sinta_score_3_years',
        'alamat',
        'ttl',
        'no_ktp',
        'no_hp',
        'email',
        'web_personal',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
