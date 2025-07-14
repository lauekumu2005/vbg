<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    private function getMockReports()
    {
        return collect([
            [
                'id' => 1,
                'reference' => 'SIG-2024-00001',
                'date_reception' => now()->subHours(2),
                'canal' => 'app',
                'type_violence' => 'Physique',
                'zone' => 'Gombe',
                'urgence' => 'urgent',
                'statut' => 'nouveau',
                'description' => 'Une femme a été agressée physiquement par son mari.',
                'service_orientation' => null,
                'commentaire_orientation' => null,
                'date_confirmation' => null,
                'date_orientation' => null,
            ],
            [
                'id' => 2,
                'reference' => 'SIG-2024-00002',
                'date_reception' => now()->subHours(5),
                'canal' => 'sms',
                'type_violence' => 'Sexuelle',
                'zone' => 'Lemba',
                'urgence' => 'normal',
                'statut' => 'confirme',
                'description' => 'Harcèlement sexuel au travail.',
                'service_orientation' => 'police',
                'commentaire_orientation' => 'Orientation vers la police pour dépôt de plainte.',
                'date_confirmation' => now()->subHours(4),
                'date_orientation' => now()->subHours(3),
            ],
            [
                'id' => 3,
                'reference' => 'SIG-2024-00003',
                'date_reception' => now()->subDay(),
                'canal' => 'appel',
                'type_violence' => 'Psychologique',
                'zone' => 'Kinshasa',
                'urgence' => 'non_prioritaire',
                'statut' => 'en_cours',
                'description' => 'Violence psychologique dans le couple.',
                'service_orientation' => 'centre',
                'commentaire_orientation' => 'Orientation vers un centre d\'accueil.',
                'date_confirmation' => now()->subDay(),
                'date_orientation' => now()->subHours(12),
            ],
        ]);
    }

    public function index(Request $request)
    {
        $reports = $this->getMockReports();

        // Filtres
        if ($request->filled('canal')) {
            $reports = $reports->where('canal', $request->canal);
        }

        if ($request->filled('statut')) {
            $reports = $reports->where('statut', $request->statut);
        }

        if ($request->filled('localisation')) {
            $reports = $reports->where('zone', $request->localisation);
        }

        if ($request->filled('type_violence')) {
            $reports = $reports->where('type_violence', $request->type_violence);
        }

        if ($request->filled('date')) {
            $reports = $reports->filter(function ($report) use ($request) {
                return $report['date_reception']->format('Y-m-d') === $request->date;
            });
        }

        // Statistiques
        $stats = [
            'totalReports' => $reports->count(),
            'urgentReports' => $reports->where('urgence', 'urgent')->count(),
            'confirmedReports' => $reports->where('statut', 'confirme')->count(),
            'appReports' => $reports->where('canal', 'app')->count(),
        ];

        // Données pour les filtres
        $localisations = [
            'Bandalungwa', 'Barumbu', 'Bumbu', 'Gombe', 'Kalamu', 'Kasa-Vubu', 
            'Kimbanseke', 'Kinshasa', 'Kintambo', 'Kisenso', 'Lemba', 'Limete', 
            'Lingwala', 'Makala', 'Maluku', 'Masina', 'Matete', 'Mont Ngafula', 
            'Ndjili', 'Ngaba', 'Ngaliema', 'Ngiri-Ngiri', 'Nsele', 'Selembao'
        ];

        $typesViolence = [
            'Physique',
            'Sexuelle',
            'Psychologique',
            'Économique',
            'Mariage Forcé',
            'Mutilation Génitale'
        ];

        // Pagination manuelle
        $page = $request->get('page', 1);
        $perPage = 10;
        $reports = new \Illuminate\Pagination\LengthAwarePaginator(
            $reports->forPage($page, $perPage),
            $reports->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('reports.index', compact('reports', 'stats', 'localisations', 'typesViolence'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        // Logique de stockage
    }

    public function show($id)
    {
        $report = $this->getMockReports()->firstWhere('id', $id);
        
        if (!$report) {
            abort(404);
        }

        return view('reports.show', compact('report'));
    }

    public function edit($id)
    {
        return view('reports.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logique de mise à jour
    }

    public function confirm($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Signalement confirmé avec succès'
        ]);
    }

    public function orient(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Signalement orienté avec succès'
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Signalement supprimé avec succès'
        ]);
    }
} 