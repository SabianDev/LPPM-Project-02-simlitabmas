<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressComment extends Model
{
    use HasFactory;

    protected $table = 'progress_comments';

    protected $fillable = [
        'progress_id',
        'user_id',
        'comment',
    ];

    public function progress()
    {
        return $this->belongsTo(ProgressPenelitian::class, 'progress_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
