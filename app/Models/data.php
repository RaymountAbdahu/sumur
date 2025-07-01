<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    use HasFactory;
    protected $table = 'data';

    protected $fillable = [
        'sensor1',
        'sensor2',
        'sensor3',
        'sensor4',
        'sensor5',
        'status',
        'waktu',
        'catatan'
    ];
    protected $casts = [
        'sensor1' => 'boolean',
        'sensor2' => 'boolean',
        'sensor3' => 'boolean',
        'sensor4' => 'boolean',
        'sensor5' => 'boolean',
        'waktu' => 'datetime',
    ];
}
