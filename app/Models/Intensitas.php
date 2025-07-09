<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intensitas extends Model
{
    use HasFactory;

    protected $table = 'intensitas';

    protected $fillable = [
        'user_id',
        'jenis_kelamin',
        'umur',
        'berat_badan',
        'tinggi_badan',
        'aktivitas',
        'target_air',
        'tanggal',
    ];
}
