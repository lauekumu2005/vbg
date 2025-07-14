@extends('layouts.app')

@section('title', 'Détails de la Réinsertion')

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
    .info-card {
        background: var(--color-white);
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
    }
    .info-card .card-header {
        background-color: var(--color-white);
        border-bottom: 1px solid #e5e7eb;
        padding: 1rem 1.5rem;
    }
    .info-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--primary-color);
        margin: 0;
    }
    .info-card .card-body {
        padding: 1.5rem;
    }
    .info-group {
        background: var(--color-bg);
        padding: 1.25rem;
        border-radius: 12px;
        margin-bottom: 1rem;
    }
    .info-group:last-child {
        margin-bottom: 0;
    }
    .info-group label {
        display: block;
        font-size: 0.875rem;
        color: var(--color-text-light);
        margin-bottom: 0.5rem;
        font-weight: 500;
    }
    .info-group p {
        font-size: 1rem;
        color: var(--text-color);
        margin: 0;
        font-weight: 500;
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
    .badge.bg-info {
        background-color: #EBF5FB !important;
        color: var(--color-info);
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
    .btn-secondary {
        background-color: var(--color-text-light);
        border-color: var(--color-text-light);
    }
    .btn-secondary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        transform: translateY(-1px);
    }
    .timeline {
        position: relative;
        padding-left: 2rem;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--color-bg);
    }
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
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
    <h1 class="page-title">Détails de la Réinsertion</h1>
    <a href="{{ route('reinsertion.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Retour
    </a>
</div>

<div class="row">
    <!-- Section principale -->
    <div class="col-lg-8">
        <!-- 1. Informations générales de la victime -->
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Informations Générales</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-group">
                            <label>Code Victime</label>
                            <p>{{ $reinsertion['code_victime'] ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="info-group">
                            <label>Sexe</label>
                            <p>{{ $reinsertion['genre'] ?? 'Non spécifié' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-group">
                            <label>Tranche d'âge</label>
                            <p>{{ $reinsertion['tranche_age'] ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="info-group">
                            <label>Zone Géographique</label>
                            <p>{{ $reinsertion['zone_geographique'] ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="info-group">
                            <label>Date d'entrée</label>
                            <p>{{ isset($reinsertion['date_entree']) ? \Carbon\Carbon::parse($reinsertion['date_entree'])->format('d/m/Y') : 'Non spécifiée' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Objectif de réinsertion -->
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Objectif de Réinsertion</h5>
            </div>
            <div class="card-body">
                <div class="info-group">
                    <label>Description des Objectifs</label>
                    <p>{{ $reinsertion['objectif_description'] ?? 'Non spécifié' }}</p>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-group">
                            <label>Type de Vulnérabilité</label>
                            <p>{{ $reinsertion['type_vulnerabilite'] ?? 'Non spécifié' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-group">
                            <label>Besoins Identifiés</label>
                            <p>{{ $reinsertion['besoins_identifies'] ?? 'Non spécifié' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Types de réinsertion -->
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Types de Réinsertion</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Détails</th>
                                <th>Statut</th>
                                <th>Début</th>
                                <th>Fin prévue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reinsertion['types_reinsertion'] ?? [] as $type)
                            <tr>
                                <td>{{ $type['type'] ?? 'Non spécifié' }}</td>
                                <td>{{ $type['details'] ?? 'Non spécifié' }}</td>
                                <td>
                                    <span class="status-badge {{ $type['statut'] ?? '' }}">
                                        {{ $type['statut'] ?? 'Non spécifié' }}
                                    </span>
                                </td>
                                <td>{{ isset($type['date_debut']) ? \Carbon\Carbon::parse($type['date_debut'])->format('d/m/Y') : '-' }}</td>
                                <td>{{ isset($type['date_fin']) ? \Carbon\Carbon::parse($type['date_fin'])->format('d/m/Y') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 4. Partenaires impliqués -->
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Partenaires Impliqués</h5>
            </div>
            <div class="card-body">
                @foreach($reinsertion['partenaires'] ?? [] as $partenaire)
                <div class="info-group mb-4">
                    <h6 class="mb-3">{{ $partenaire['nom'] ?? 'Partenaire non spécifié' }}</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Contact:</strong> {{ $partenaire['contact'] ?? 'Non spécifié' }}</p>
                            <p><strong>Durée:</strong> {{ $partenaire['duree'] ?? 'Non spécifiée' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Documents:</strong></p>
                            <ul class="list-unstyled">
                                @foreach($partenaire['documents'] ?? [] as $doc)
                                <li><i class="fas fa-file-alt me-2"></i>{{ $doc['nom'] ?? 'Document non spécifié' }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 5. État actuel & évolution -->
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">État Actuel & Évolution</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-group">
                            <label>Statut Global</label>
                            <p>
                                <span class="status-badge {{ $reinsertion['statut'] ?? '' }}">
                                    {{ $reinsertion['statut'] ?? 'Non spécifié' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-group">
                            <label>Progression</label>
                            <div class="progress-bar">
                                <div class="progress-bar-fill" style="width: {{ $reinsertion['progression'] ?? 0 }}%"></div>
                            </div>
                            <p class="text-end mt-2">{{ $reinsertion['progression'] ?? 0 }}% du parcours</p>
                        </div>
                    </div>
                </div>

                <div class="timeline">
                    @foreach($reinsertion['chronologie'] ?? [] as $evenement)
                    <div class="timeline-item">
                        <div class="timeline-date">
                            {{ isset($evenement['date']) ? \Carbon\Carbon::parse($evenement['date'])->format('d/m/Y') : 'Date non spécifiée' }}
                        </div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-light text-dark">{{ $evenement['type'] ?? 'Événement' }}</span>
                                <small class="text-muted">{{ $evenement['auteur'] ?? 'Anonyme' }}</small>
                            </div>
                            <p class="mb-0">{{ $evenement['evenement'] ?? 'Aucun détail' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Section latérale -->
    <div class="col-lg-4">
        <!-- 6. Documents & justificatifs -->
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Documents & Justificatifs</h5>
            </div>
            <div class="card-body">
                @foreach($reinsertion['documents'] ?? [] as $document)
                <div class="document-item mb-3">
                    <div class="d-flex align-items-center">
                        <div class="document-icon me-3">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="document-info">
                            <h6 class="document-name mb-1">{{ $document['nom'] ?? 'Document sans nom' }}</h6>
                            <p class="document-type mb-0">{{ $document['type'] ?? 'Type non spécifié' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 7. Commentaires / Notes de suivi -->
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Notes de Suivi</h5>
            </div>
            <div class="card-body">
                @foreach($reinsertion['commentaires'] ?? [] as $commentaire)
                <div class="info-group">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">{{ isset($commentaire['date']) ? \Carbon\Carbon::parse($commentaire['date'])->format('d/m/Y') : 'Date non spécifiée' }}</span>
                        <small class="text-muted">{{ $commentaire['auteur'] ?? 'Anonyme' }}</small>
                    </div>
                    <p class="mb-0">{{ $commentaire['contenu'] ?? 'Aucun contenu' }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 8. Responsable de suivi -->
        @if(isset($reinsertion['tuteur']))
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Responsable de Suivi</h5>
            </div>
            <div class="card-body">
                <div class="info-group">
                    <label>Nom et Fonction</label>
                    <p>{{ $reinsertion['tuteur']['nom'] ?? 'Non spécifié' }} - {{ $reinsertion['tuteur']['fonction'] ?? 'Non spécifiée' }}</p>
                </div>
                <div class="info-group">
                    <label>Contact</label>
                    <p>{{ $reinsertion['tuteur']['contact'] ?? 'Non spécifié' }}</p>
                </div>
                @if(isset($reinsertion['tuteur']['email']))
                <div class="info-group">
                    <label>Email</label>
                    <p>{{ $reinsertion['tuteur']['email'] }}</p>
                </div>
                @endif
                @if(isset($reinsertion['tuteur']['prochain_contact']))
                <div class="info-group">
                    <label>Prochain Contact</label>
                    <p>{{ \Carbon\Carbon::parse($reinsertion['tuteur']['prochain_contact'])->format('d/m/Y') }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- 9. Évaluation finale (optionnel) -->
        @if(isset($reinsertion['evaluation_finale']))
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Évaluation Finale</h5>
            </div>
            <div class="card-body">
                <div class="evaluation-card">
                    <h6>Auto-évaluation de la Victime</h6>
                    <p>{{ $reinsertion['evaluation_finale']['auto_evaluation'] ?? 'Non spécifiée' }}</p>
                </div>
                <div class="evaluation-card">
                    <h6>Évaluation du Partenaire</h6>
                    <p>{{ $reinsertion['evaluation_finale']['evaluation_partenaire'] ?? 'Non spécifiée' }}</p>
                </div>
                <div class="evaluation-card">
                    <h6>Score d'Insertion Durable</h6>
                    <div class="evaluation-score">
                        {{ $reinsertion['evaluation_finale']['score'] ?? '0' }}/100
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: {{ $reinsertion['evaluation_finale']['score'] ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 