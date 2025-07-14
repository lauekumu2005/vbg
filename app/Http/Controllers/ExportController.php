<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signalement;
use PDF;
use Excel;
use App\Exports\SignalementsExport;

class ExportController extends Controller
{
    public function export($type, Request $request)
    {
        // Récupérer les filtres
        $filters = $request->only(['genre', 'age', 'localisation', 'typeViolence', 'statut']);
        
        // Récupérer les signalements avec les filtres
        $signalements = Signalement::query()
            ->when($filters['genre'], function($query, $genre) {
                return $query->where('genre', $genre);
            })
            ->when($filters['age'], function($query, $age) {
                return $query->where('age', $age);
            })
            ->when($filters['localisation'], function($query, $localisation) {
                return $query->where('localisation', $localisation);
            })
            ->when($filters['typeViolence'], function($query, $typeViolence) {
                return $query->where('type_violence', $typeViolence);
            })
            ->when($filters['statut'], function($query, $statut) {
                return $query->where('statut', $statut);
            })
            ->get();

        if ($type === 'pdf') {
            return $this->exportPDF($signalements);
        } elseif ($type === 'excel') {
            return $this->exportExcel($signalements);
        }

        return back()->with('error', 'Type d\'export non supporté');
    }

    private function exportPDF($signalements)
    {
        $pdf = PDF::loadView('exports.signalements-pdf', [
            'signalements' => $signalements,
            'date' => now()->format('d/m/Y H:i')
        ]);

        return $pdf->download('signalements-' . now()->format('Y-m-d') . '.pdf');
    }

    private function exportExcel($signalements)
    {
        return Excel::download(new SignalementsExport($signalements), 'signalements-' . now()->format('Y-m-d') . '.xlsx');
    }
}
