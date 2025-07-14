<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reinsertion extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_victime',
        'nom_anonyme',
        'type_reinsertion',
        'date_debut',
        'partenaire_id',
        'statut',
        'evolution',
        'localisation',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'evolution' => 'integer',
    ];

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }
} 