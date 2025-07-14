@extends('layouts.app')

@section('title', 'Suivi de la réinsertion')

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

    .progress {
        height: 8px;
        border-radius: 9999px;
        background-color: var(--color-bg);
    }

    .progress-bar {
        border-radius: 9999px;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 0.75rem;
            margin-bottom: 1rem;
        }

        .stats-card {
            margin-bottom: 1rem;
        }

        .stats-card .card-body {
            padding: 1rem;
        }

        .stats-icon {
            width: 40px;
            height: 40px;
        }

        .stats-value {
            font-size: 1.5rem;
        }

        .stats-label {
            font-size: 0.9rem;
        }

        .table th, .table td {
            padding: 0.5rem;
            font-size: 0.9rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .form-label, .form-select, .form-control {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1 class="page-title">Suivi de la réinsertion</h1>
</div>

<!-- Filtres -->
<div class="filter-card">
    <div class="card-body">
        <form id="filterForm" class="row g-3">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Type de réinsertion</label>
                    <select name="type" class="form-select">
                        <option value="">Tous</option>
                        <option value="formation">Formation professionnelle</option>
                        <option value="scolarisation">Scolarisation</option>
                        <option value="agr">Activité génératrice de revenu</option>
                        <option value="emploi">Emploi</option>
                        <option value="psychologique">Soutien psychologique</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="">Tous</option>
                        <option value="en_cours">En cours</option>
                        <option value="termine">Terminé avec succès</option>
                        <option value="abandonne">Abandonné</option>
                        <option value="evaluation">En évaluation</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Partenaire</label>
                    <select name="partenaire" class="form-select">
                        <option value="">Tous</option>
                        @foreach($partenaires as $partenaire)
                            <option value="{{ $partenaire['id'] }}">{{ $partenaire['nom'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Date de début</label>
                    <input type="date" name="date_debut" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Localisation</label>
                    <select name="localisation" class="form-select">
                        <option value="">Toutes</option>
                        @foreach($localisations as $localisation)
                            <option value="{{ $localisation }}">{{ $localisation }}</option>
                        @endforeach
                    </select>
                </div>
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
                        <h6 class="stats-label">Total Victimes Accompagnées</h6>
                        <h3 class="stats-value">{{ $stats['totalVictimes'] }}</h3>
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
                        <h6 class="stats-label">Taux de Réinsertion</h6>
                        <h3 class="stats-value">{{ $stats['tauxReinsertion'] }}%</h3>
                    </div>
                    <div class="stats-icon bg-success bg-opacity-10">
                        <i class="fas fa-chart-line text-success fa-lg"></i>
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
                        <h6 class="stats-label">En Formation</h6>
                        <h3 class="stats-value">{{ $stats['enFormation'] }}</h3>
                    </div>
                    <div class="stats-icon bg-info bg-opacity-10">
                        <i class="fas fa-graduation-cap text-info fa-lg"></i>
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
                        <h6 class="stats-label">En Emploi</h6>
                        <h3 class="stats-value">{{ $stats['enEmploi'] }}</h3>
                    </div>
                    <div class="stats-icon bg-warning bg-opacity-10">
                        <i class="fas fa-briefcase text-warning fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Liste des réinsertions -->
<div class="table-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Code Victime</th>
                        <th>Nom</th>
                        <th>Type de réinsertion</th>
                        <th>Début</th>
                        <th>Partenaire</th>
                        <th>État actuel</th>
                        <th>Évolution</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reinsertions as $reinsertion)
                    <tr>
                        <td>{{ $reinsertion['code_victime'] }}</td>
                        <td>{{ $reinsertion['nom_anonyme'] }}</td>
                        <td>
                            <span class="badge bg-light text-dark">
                                {{ $reinsertion['type_reinsertion'] }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($reinsertion['date_debut'])->format('d/m/Y') }}</td>
                        <td>{{ $reinsertion['partenaire']['nom'] }}</td>
                        <td>
                            @switch($reinsertion['statut'])
                                @case('en_cours')
                                    <span class="badge bg-warning">En cours</span>
                                    @break
                                @case('termine')
                                    <span class="badge bg-success">Terminé</span>
                                    @break
                                @case('abandonne')
                                    <span class="badge bg-danger">Abandonné</span>
                                    @break
                                @case('evaluation')
                                    <span class="badge bg-info">En évaluation</span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar bg-success" 
                                     role="progressbar" 
                                     style="width: {{ $reinsertion['evolution'] }}%"
                                     aria-valuenow="{{ $reinsertion['evolution'] }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">{{ $reinsertion['evolution'] }}%</small>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('reinsertion.show', $reinsertion['id']) }}" 
                                   class="btn btn-sm btn-outline-primary" 
                                   title="Voir dossier">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" 
                                   class="btn btn-sm btn-outline-success" 
                                   title="Joindre document">
                                    <i class="fas fa-file-upload"></i>
                                </a>
                                <a href="{{ route('reinsertion.edit', $reinsertion['id']) }}" 
                                   class="btn btn-sm btn-outline-info" 
                                   title="Mettre à jour">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('reinsertion.destroy', $reinsertion['id']) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réinsertion ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 