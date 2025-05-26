<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalReport extends Model
{
    use HasFactory;

    protected $table = 'final_reports';

    protected $fillable = [
        'penelitian_id',
        'final_article',
        'final_report',
        'final_budget',
    ];

    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class, 'penelitian_id');
    }
}
