@extends('layouts.app')

@section('title', 'Victimes Suivies')

@push('styles')
<style>
    :root {
        --sidebar-width: 280px;
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #3498db;
        --hover-color: #2980b9;
        --text-color: #2c3e50;
        --light-text: #ffffff;
        --border-color: rgba(255, 255, 255, 0.1);
        --color-success: #27ae60;
        --color-info: #2980b9;
        --color-warning: #f39c12;
        --color-danger: #e74c3c;
        --color-text-light: #7f8c8d;
        --color-bg: #f5f7fa;
        --color-white: #ffffff;
        --color-gold: #f1c40f;
        --card-shadow: 0 4px 16px rgba(44, 62, 80, 0.05);
        --border-radius: 16px;
        --content-max-width: 1400px;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--color-bg);
        color: var(--text-color);
        line-height: 1.6;
        overflow-x: hidden;
    }

    .container-fluid {
        padding: 0.5rem;
        max-width: var(--content-max-width);
        margin: 0 auto;
    }

    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .col-xl-3, .col-md-6 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .page-header {
        background-color: var(--color-white);
        padding: 1rem;
        box-shadow: 0 2px 6px rgba(44, 62, 80, 0.04);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 1rem;
        border-radius: var(--border-radius);
    }

    .page-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-color);
        margin: 0;
    }

    .stats-card {
        background: var(--color-white);
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        height: 100%;
        border-left: 4px solid var(--primary-color);
        padding: 1rem;
    }

    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(44, 62, 80, 0.08);
    }

    .stats-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        background: var(--color-bg);
    }

    .stats-value {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--color-primary);
        margin: 0.5rem 0;
        letter-spacing: 0.25px;
    }

    .stats-label {
        font-size: 0.95rem;
        color: var(--color-text-light);
        margin-bottom: 0.5rem;
        font-weight: 500;
        letter-spacing: 0.25px;
    }

    .filter-card {
        background: var(--color-white);
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
        padding: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--text-color);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-select, .form-control {
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
        width: 100%;
        transition: all 0.2s ease;
    }

    .form-select:focus, .form-control:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.25);
    }

    .btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        transition: all 0.2s ease;
        font-size: 0.95rem;
        letter-spacing: 0.25px;
    }

    .btn-primary {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
    }

    .btn-primary:hover {
        background-color: var(--color-secondary);
        border-color: var(--color-secondary);
        transform: translateY(-1px);
    }

    .btn-outline-primary {
        color: var(--color-primary);
        border-color: var(--color-primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
        transform: translateY(-1px);
    }

    .table-card {
        background: var(--color-white);
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--card-shadow);
        padding: 1.5rem;
    }

    .table {
        margin-bottom: 0;
        width: 100%;
    }

    .table th {
        font-weight: 600;
        color: var(--color-text-light);
        padding: 0.75rem;
        border-bottom: 2px solid #e5e7eb;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.25px;
    }

    .table td {
        padding: 0.75rem;
        vertical-align: middle;
        font-size: 0.95rem;
        color: var(--text-color);
        border-bottom: 1px solid #e5e7eb;
    }

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 600;
        border-radius: 8px;
        letter-spacing: 0.25px;
        font-size: 0.85rem;
    }

    .badge.bg-danger {
        background-color: #FDEDEC !important;
        color: var(--color-danger);
    }

    .badge.bg-warning {
        background-color: #FEF9E7 !important;
        color: var(--color-warning);
    }

    .badge.bg-success {
        background-color: #EAFAF1 !important;
        color: var(--color-success);
    }

    .btn-group .btn {
        padding: 0.4rem 0.6rem;
        border-radius: 8px;
        margin: 0 2px;
        font-size: 0.85rem;
    }

    .btn-group .btn:hover {
        transform: translateY(-1px);
    }

    .modal-content {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--card-shadow);
    }

    .modal-header {
        background-color: var(--primary-color);
        color: var(--light-text);
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        padding: 1rem;
    }

    .modal-title {
        font-weight: 600;
        letter-spacing: -0.5px;
        font-size: 1.1rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
    }

    .btn-close {
        filter: brightness(0) invert(1);
    }

    /* Responsive design */
    @media (max-width: 991px) {
        .row {
            flex-direction: column;
        }
        .col-xl-3, .col-md-6 {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 0;
            padding-right: 0;
            margin-bottom: 1rem;
        }
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .filter-card {
            flex-direction: column;
            gap: 1rem;
        }
    }
    @media (max-width: 600px) {
        .stats-card, .info-card, .table-card {
            padding: 0.75rem;
            border-radius: 10px;
        }
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table {
            min-width: 600px;
        }
        .btn, .form-control, .form-select {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1 class="page-title">Victimes Suivies</h1>
    <a href="{{ route('victims.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Ajouter un cas
    </a>
</div>

<!-- Filtres -->
<div class="filter-card mb-4">
    <div class="card-body">
        <form action="{{ route('victims.index') }}" method="GET" class="row g-3">
            <div class="col-md-2">
                <label for="genre" class="form-label">Genre</label>
                <select name="genre" id="genre" class="form-select">
                    <option value="">Tous</option>
                    <option value="F" {{ request('genre') == 'F' ? 'selected' : '' }}>Féminin</option>
                    <option value="M" {{ request('genre') == 'M' ? 'selected' : '' }}>Masculin</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="age" class="form-label">Âge</label>
                <select name="age" id="age" class="form-select">
                    <option value="">Tous</option>
                    <option value="0-18" {{ request('age') == '0-18' ? 'selected' : '' }}>0-18 ans</option>
                    <option value="19-25" {{ request('age') == '19-25' ? 'selected' : '' }}>19-25 ans</option>
                    <option value="26-35" {{ request('age') == '26-35' ? 'selected' : '' }}>26-35 ans</option>
                    <option value="36-50" {{ request('age') == '36-50' ? 'selected' : '' }}>36-50 ans</option>
                    <option value="50+" {{ request('age') == '50+' ? 'selected' : '' }}>50+ ans</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="localisation" class="form-label">Localisation</label>
                <select name="localisation" id="localisation" class="form-select">
                    <option value="">Toutes</option>
                    @foreach($localisations as $localisation)
                        <option value="{{ $localisation }}" {{ request('localisation') == $localisation ? 'selected' : '' }}>
                            {{ $localisation }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="type_violence" class="form-label">Type de Violence</label>
                <select name="type_violence" id="type_violence" class="form-select">
                    <option value="">Tous</option>
                    @foreach($typesViolence as $type)
                        <option value="{{ $type }}" {{ request('type_violence') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="statut" class="form-label">Statut</label>
                <select name="statut" id="statut" class="form-select">
                    <option value="">Tous</option>
                    <option value="En cours" {{ request('statut') == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Résolu" {{ request('statut') == 'Résolu' ? 'selected' : '' }}>Résolu</option>
                    <option value="En attente" {{ request('statut') == 'En attente' ? 'selected' : '' }}>En attente</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search me-2"></i>Filtrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Statistiques -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="stats-label">Total Victimes Suivies</h6>
                        <h3 class="stats-value">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="stats-icon bg-primary bg-opacity-10">
                        <i class="fas fa-users text-primary fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="stats-label">Réinsertions Réussies</h6>
                        <h3 class="stats-value">{{ $stats['reinsertions'] }}</h3>
                    </div>
                    <div class="stats-icon bg-success bg-opacity-10">
                        <i class="fas fa-home text-success fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="stats-label">Suivis en Cours</h6>
                        <h3 class="stats-value">{{ $stats['en_cours'] }}</h3>
                    </div>
                    <div class="stats-icon bg-warning bg-opacity-10">
                        <i class="fas fa-clock text-warning fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="stats-label">Suivis Interrompus</h6>
                        <h3 class="stats-value">{{ $stats['interrompus'] }}</h3>
                    </div>
                    <div class="stats-icon bg-danger bg-opacity-10">
                        <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Âge</th>
                        <th>Sexe</th>
                        <th>Type de VBG</th>
                        <th>Commune</th>
                        <th>Date d'identification</th>
                        <th>Statut</th>
                        <th>Dernière mise à jour</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($victims as $victim)
                        <tr>
                            <td>VBG{{ $victim->id }}</td>
                            <td>{{ $victim->age }}</td>
                            <td>{{ $victim->sexe }}</td>
                            <td><span class="badge bg-danger">{{ $victim->type_violence }}</span></td>
                            <td>{{ $victim->commune }}</td>
                            <td>{{ $victim->date_identification->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge {{ $victim->statut == 'Suivi en cours' ? 'bg-warning' : ($victim->statut == 'Réinséré(e)' ? 'bg-success' : 'bg-danger') }}">
                                    {{ $victim->statut }}
                                </span>
                            </td>
                            <td>{{ $victim->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('victims.show', $victim) }}" class="btn btn-sm btn-outline-primary" title="Voir le dossier">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('victims.edit', $victim) }}" class="btn btn-sm btn-outline-success" title="Mettre à jour">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-info" title="Ajouter une note">
                                        <i class="fas fa-sticky-note"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary" title="Exporter">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Aucune victime trouvée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $victims->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="addVictimModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle Victime</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tranche d'âge</label>
                            <select class="form-select" required>
                                <option value="">Sélectionner</option>
                                <option>0-14 ans</option>
                                <option>15-24 ans</option>
                                <option>25-34 ans</option>
                                <option>35-44 ans</option>
                                <option>45+ ans</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sexe</label>
                            <select class="form-select" required>
                                <option value="">Sélectionner</option>
                                <option>Femme</option>
                                <option>Homme</option>
                                <option>Autre</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Type de Violence</label>
                            <select class="form-select" required>
                                <option value="">Sélectionner</option>
                                <option>Physique</option>
                                <option>Sexuelle</option>
                                <option>Psychologique</option>
                                <option>Économique</option>
                                <option>Mariage Forcé</option>
                                <option>Mutilation Génitale</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Commune</label>
                            <select class="form-select" required>
                                <option value="">Sélectionner</option>
                                <option>Bandalungwa</option>
                                <option>Barumbu</option>
                                <option>Bumbu</option>
                                <option>Gombe</option>
                                <option>Kalamu</option>
                                <option>Kasa-Vubu</option>
                                <option>Kimbanseke</option>
                                <option>Kinshasa</option>
                                <option>Kintambo</option>
                                <option>Kisenso</option>
                                <option>Lemba</option>
                                <option>Limete</option>
                                <option>Lingwala</option>
                                <option>Makala</option>
                                <option>Maluku</option>
                                <option>Masina</option>
                                <option>Matete</option>
                                <option>Mont Ngafula</option>
                                <option>Ndjili</option>
                                <option>Ngaba</option>
                                <option>Ngaliema</option>
                                <option>Ngiri-Ngiri</option>
                                <option>Nsele</option>
                                <option>Selembao</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Description de la situation (sans données personnelles)"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
@endsection 