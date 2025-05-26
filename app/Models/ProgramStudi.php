<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;
    protected $table = 'program_studi'; // Tetapkan nama tabel secara eksplisit
    protected $fillable = ['namaProdi'];
}
