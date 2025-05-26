<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewerStatus extends Model
{
    use HasFactory;

    protected $table = 'reviewer_status';

    protected $fillable = [
        'user_id',
        'status',
        // 'proposal_id'
    ];

    // Relasi ke User, jika diperlukan:
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
