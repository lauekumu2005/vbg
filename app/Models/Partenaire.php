<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'contact',
        'email',
        'adresse',
    ];

    public function reinsertions()
    {
        return $this->hasMany(Reinsertion::class);
    }
} 