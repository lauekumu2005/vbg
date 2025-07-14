<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SignalementsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $signalements;

    public function __construct($signalements)
    {
        $this->signalements = $signalements;
    }

    public function collection()
    {
        return $this->signalements;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Genre',
            'Âge',
            'Localisation',
            'Type de violence',
            'Statut',
            'Description',
            'Date de création'
        ];
    }

    public function map($signalement): array
    {
        return [
            $signalement->id,
            $signalement->date_signalement,
            $signalement->genre,
            $signalement->age,
            $signalement->localisation,
            $signalement->type_violence,
            $signalement->statut,
            $signalement->description,
            $signalement->created_at->format('d/m/Y H:i')
        ];
    }
} 