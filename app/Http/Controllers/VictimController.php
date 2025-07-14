<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Victim;

class VictimController extends Controller
{
    public function index(Request $request)
    {
        $query = Victim::query();

        // Filtres
        if ($request->filled('type_violence')) {
            $query->where('type_violence', $request->type_violence);
        }

        if ($request->filled('localisation')) {
            $query->where('localisation', $request->localisation);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('age')) {
            $query->where('age', $request->age);
        }

        if ($request->filled('annee')) {
            $query->whereYear('date_identification', $request->annee);
        }

        $victims = $query->paginate(10);

        // Statistiques
        $stats = [
            'total' => Victim::count(),
            'reinsertions' => Victim::where('statut', 'Réinséré(e)')->count(),
            'en_cours' => Victim::where('statut', 'Suivi en cours')->count(),
            'interrompus' => Victim::where('statut', 'Suivi interrompu')->count(),
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

        return view('victims.index', compact('victims', 'stats', 'localisations', 'typesViolence'));
    }

    public function create()
    {
        return view('victims.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'age' => 'required',
            'sexe' => 'required',
            'type_violence' => 'required',
            'commune' => 'required',
            'description' => 'nullable|string',
        ]);

        $victim = Victim::create($validated);

        return redirect()->route('victims.index')
            ->with('success', 'Victime ajoutée avec succès.');
    }

    public function show($id)
    {
        $victim = Victim::findOrFail($id);
        return view('victims.show', compact('victim'));
    }

    public function edit($id)
    {
        $victim = Victim::findOrFail($id);
        return view('victims.edit', compact('victim'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'age' => 'required',
            'sexe' => 'required',
            'type_violence' => 'required',
            'commune' => 'required',
            'description' => 'nullable|string',
            'statut' => 'required',
        ]);

        $victim = Victim::findOrFail($id);
        $victim->update($validated);

        return redirect()->route('victims.index')
            ->with('success', 'Victime mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $victim = Victim::findOrFail($id);
        $victim->delete();

        return redirect()->route('victims.index')
            ->with('success', 'Victime supprimée avec succès.');
    }
} 