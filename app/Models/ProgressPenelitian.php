<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressPenelitian extends Model
{
    use HasFactory;

    protected $table = 'progress_penelitian';

    protected $fillable = [
        'penelitian_id',
        'description',
        'file_progress',
    ];

    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class, 'penelitian_id');
    }

    // Relasi komentar, jika diimplementasikan
    public function comments()
    {
        return $this->hasMany(ProgressComment::class, 'progress_id');
    }
}
