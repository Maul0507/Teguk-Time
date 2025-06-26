<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_time',
        'volume_ml',
    ];
}
