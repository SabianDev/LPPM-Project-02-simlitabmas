<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewerAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'reviewer_id',
        'assignment_status',
    ];

    // Relasi ke proposal (tabel pengajuan_penelitian)
    public function proposal()
    {
        // Jika kamu sudah menggunakan model UserProposal untuk pengajuan_penelitian,
        // ganti dengan UserProposal::class, atau gunakan model lain sesuai kebutuhan.
        return $this->belongsTo(UserProposal::class, 'proposal_id');
        
    }

    // Relasi ke reviewer (user dengan role reviewer)
    public function reviewer()
    {
        return $this->belongsTo(\App\Models\User::class, 'reviewer_id');
    }

}
