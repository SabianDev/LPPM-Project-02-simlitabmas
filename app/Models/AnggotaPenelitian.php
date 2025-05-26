<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPenelitian extends Model
{
    use HasFactory;

    protected $table = 'anggota_penelitian';

    protected $fillable = [
        'id_proposal',
        'id_user',
    ];

    // Relasi ke proposal
    public function proposal()
    {
        return $this->belongsTo(\App\Models\PengajuanPenelitian::class, 'id_proposal');
    }

    // Relasi ke user (anggota)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user');
    }
}
