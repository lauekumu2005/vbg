<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReinsertionController extends Controller
{
    public function index(Request $request)
    {
        // Données statiques pour les partenaires
        $partenaires = [
            ['id' => 1, 'nom' => 'Centre de Formation Professionnelle'],
            ['id' => 2, 'nom' => 'ONG Femmes Actives'],
            ['id' => 3, 'nom' => 'Centre d\'Accueil SOS'],
            ['id' => 4, 'nom' => 'Association pour l\'Emploi'],
        ];

        // Données statiques pour les localisations
        $localisations = [
            'Dakar',
            'Thiès',
            'Saint-Louis',
            'Kaolack',
            'Touba'
        ];

        // Données statiques pour les statistiques
        $stats = [
            'totalVictimes' => 156,
            'tauxReinsertion' => 75,
            'enFormation' => 45,
            'enEmploi' => 72
        ];

        // Données statiques pour les réinsertions
        $reinsertions = [
            [
                'id' => 1,
                'code_victime' => 'VIC-2024-001',
                'nom_anonyme' => 'A.N.',
                'type_reinsertion' => 'Formation professionnelle',
                'date_debut' => '2024-01-15',
                'partenaire' => ['id' => 1, 'nom' => 'Centre de Formation Professionnelle'],
                'statut' => 'en_cours',
                'evolution' => 65,
                'localisation' => 'Dakar'
            ],
            [
                'id' => 2,
                'code_victime' => 'VIC-2024-002',
                'nom_anonyme' => 'Jeune femme - 21 ans',
                'type_reinsertion' => 'Emploi',
                'date_debut' => '2024-02-01',
                'partenaire' => ['id' => 4, 'nom' => 'Association pour l\'Emploi'],
                'statut' => 'termine',
                'evolution' => 100,
                'localisation' => 'Thiès'
            ],
            [
                'id' => 3,
                'code_victime' => 'VIC-2024-003',
                'nom_anonyme' => 'M.K.',
                'type_reinsertion' => 'Scolarisation',
                'date_debut' => '2024-03-01',
                'partenaire' => ['id' => 2, 'nom' => 'ONG Femmes Actives'],
                'statut' => 'en_cours',
                'evolution' => 30,
                'localisation' => 'Saint-Louis'
            ],
        ];

        // Filtrage des données statiques
        if ($request->filled('type')) {
            $reinsertions = array_filter($reinsertions, function($reinsertion) use ($request) {
                return $reinsertion['type_reinsertion'] === $request->type;
            });
        }

        if ($request->filled('statut')) {
            $reinsertions = array_filter($reinsertions, function($reinsertion) use ($request) {
                return $reinsertion['statut'] === $request->statut;
            });
        }

        if ($request->filled('partenaire')) {
            $reinsertions = array_filter($reinsertions, function($reinsertion) use ($request) {
                return $reinsertion['partenaire']['id'] == $request->partenaire;
            });
        }

        if ($request->filled('date_debut')) {
            $reinsertions = array_filter($reinsertions, function($reinsertion) use ($request) {
                return $reinsertion['date_debut'] === $request->date_debut;
            });
        }

        if ($request->filled('localisation')) {
            $reinsertions = array_filter($reinsertions, function($reinsertion) use ($request) {
                return $reinsertion['localisation'] === $request->localisation;
            });
        }

        return view('reinsertion.index', compact('reinsertions', 'partenaires', 'localisations', 'stats'));
    }

    public function show($id)
    {
        // Données statiques pour une réinsertion spécifique
        $reinsertion = [
            'id' => $id,
            'code_victime' => 'VIC-2024-00' . $id,
            'nom_anonyme' => 'A.N.',
            'type_reinsertion' => 'Formation professionnelle',
            'date_debut' => '2024-01-15',
            'partenaire' => ['id' => 1, 'nom' => 'Centre de Formation Professionnelle'],
            'statut' => 'en_cours',
            'evolution' => 65,
            'localisation' => 'Dakar',
            'situation_depart' => 'Victime de violence domestique',
            'objectif' => 'Formation en couture',
            'chronologie' => [
                ['date' => '2024-01-15', 'evenement' => 'Début de la formation'],
                ['date' => '2024-02-01', 'evenement' => 'Premier stage pratique'],
                ['date' => '2024-03-01', 'evenement' => 'Évaluation intermédiaire']
            ],
            'documents' => [
                ['type' => 'photo', 'nom' => 'Photo de la victime'],
                ['type' => 'attestation', 'nom' => 'Attestation de formation']
            ],
            'tuteur' => [
                'nom' => 'Marie Diop',
                'contact' => '+221 77 123 45 67',
                'email' => 'marie.diop@example.com'
            ],
            'commentaires' => [
                ['date' => '2024-01-20', 'auteur' => 'Marie Diop', 'contenu' => 'La victime montre une bonne motivation'],
                ['date' => '2024-02-15', 'auteur' => 'Marie Diop', 'contenu' => 'Progrès significatifs dans l\'apprentissage']
            ]
        ];

        return view('reinsertion.show', compact('reinsertion'));
    }

    public function edit($id)
    {
        // Données statiques pour l'édition
        $reinsertion = [
            'id' => $id,
            'code_victime' => 'VIC-2024-00' . $id,
            'nom_anonyme' => 'A.N.',
            'type_reinsertion' => 'Formation professionnelle',
            'date_debut' => '2024-01-15',
            'partenaire_id' => 1,
            'statut' => 'en_cours',
            'evolution' => 65,
            'localisation' => 'Dakar'
        ];

        $partenaires = [
            ['id' => 1, 'nom' => 'Centre de Formation Professionnelle'],
            ['id' => 2, 'nom' => 'ONG Femmes Actives'],
            ['id' => 3, 'nom' => 'Centre d\'Accueil SOS'],
            ['id' => 4, 'nom' => 'Association pour l\'Emploi'],
        ];

        return view('reinsertion.edit', compact('reinsertion', 'partenaires'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('reinsertion.index')
            ->with('success', 'La réinsertion a été mise à jour avec succès.');
    }

    public function destroy($id)
    {
        return redirect()->route('reinsertion.index')
            ->with('success', 'La réinsertion a été supprimée avec succès.');
    }
} 