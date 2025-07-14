<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'date_reception',
        'canal',
        'type_violence',
        'zone',
        'urgence',
        'statut',
        'description',
        'service_orientation',
        'commentaire_orientation',
        'date_confirmation',
        'date_orientation'
    ];

    protected $casts = [
        'date_reception' => 'datetime',
        'date_confirmation' => 'datetime',
        'date_orientation' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($report) {
            $report->reference = 'SIG-' . date('Y') . '-' . str_pad(static::count() + 1, 5, '0', STR_PAD_LEFT);
        });
    }
} 