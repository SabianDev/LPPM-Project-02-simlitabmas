<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;

    protected $table = 'penelitian';

    protected $fillable = [
        'proposal_id',
        'user_id',
        'title',
        'status',
    ];

    // Relasi ke progress (child)
    public function progress()
    {
        return $this->hasMany(ProgressPenelitian::class, 'penelitian_id');
    }

    // Relasi ke final report (jika sudah selesai)
    public function finalReport()
    {
        return $this->hasOne(FinalReport::class, 'penelitian_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
