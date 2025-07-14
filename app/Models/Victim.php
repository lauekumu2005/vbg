<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    use HasFactory;

    protected $fillable = [
        'age',
        'sexe',
        'type_violence',
        'commune',
        'description',
        'statut',
        'date_identification',
    ];

    protected $casts = [
        'date_identification' => 'datetime',
    ];
} 