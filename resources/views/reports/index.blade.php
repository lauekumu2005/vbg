@extends('layouts.app')

@section('title', 'Signalements Reçus')

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
    <h1 class="page-title">Signalements Reçus</h1>
</div>

<!-- Filtres -->
<div class="filter-card mb-4">
    <div class="card-body">
        <form id="filterForm" class="row g-3">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Canal</label>
                    <select name="canal" class="form-select">
                        <option value="">Tous</option>
                        <option value="app">Application</option>
                        <option value="sms">SMS</option>
                        <option value="appel">Appel</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="">Tous</option>
                        <option value="nouveau">Nouveau</option>
                        <option value="en_cours">En cours</option>
                        <option value="confirme">Confirmé</option>
                        <option value="refuse">Refusé</option>
                    </select>
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
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Type de Violence</label>
                    <select name="type_violence" class="form-select">
                        <option value="">Tous</option>
                        @foreach($typesViolence as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control">
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
                        <h6 class="stats-label">Total Signalements</h6>
                        <h3 class="stats-value">{{ $stats['totalReports'] }}</h3>
                    </div>
                    <div class="stats-icon bg-primary bg-opacity-10">
                        <i class="fas fa-bell text-primary fa-lg"></i>
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
                        <h6 class="stats-label">Signalements Urgents</h6>
                        <h3 class="stats-value">{{ $stats['urgentReports'] }}</h3>
                    </div>
                    <div class="stats-icon bg-danger bg-opacity-10">
                        <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
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
                        <h6 class="stats-label">Signalements Confirmés</h6>
                        <h3 class="stats-value">{{ $stats['confirmedReports'] }}</h3>
                    </div>
                    <div class="stats-icon bg-success bg-opacity-10">
                        <i class="fas fa-check-circle text-success fa-lg"></i>
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
                        <h6 class="stats-label">Via Application</h6>
                        <h3 class="stats-value">{{ $stats['appReports'] }}</h3>
                    </div>
                    <div class="stats-icon bg-info bg-opacity-10">
                        <i class="fas fa-mobile-alt text-info fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Liste des signalements -->
<div class="table-card">
    <div class="table-responsive">
        <table class="table">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Date</th>
                        <th>Canal</th>
                        <th>Type</th>
                        <th>Zone</th>
                        <th>Urgence</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                    <tr>
                        <td>{{ $report['reference'] }}</td>
                        <td>{{ $report['date_reception']->format('d/m/Y H:i') }}</td>
                        <td>
                            @switch($report['canal'])
                                @case('app')
                                    <i class="fas fa-mobile-alt text-primary"></i> App
                                    @break
                                @case('sms')
                                    <i class="fas fa-sms text-success"></i> SMS
                                    @break
                                @case('appel')
                                    <i class="fas fa-phone text-info"></i> Appel
                                    @break
                            @endswitch
                        </td>
                        <td><span class="badge bg-danger">{{ $report['type_violence'] }}</span></td>
                        <td>{{ $report['zone'] }}</td>
                        <td>
                            <span class="badge bg-{{ $report['urgence'] === 'urgent' ? 'danger' : ($report['urgence'] === 'normal' ? 'warning' : 'secondary') }}">
                                {{ $report['urgence'] }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $report['statut'] === 'nouveau' ? 'primary' : ($report['statut'] === 'en_cours' ? 'warning' : ($report['statut'] === 'confirme' ? 'success' : 'danger')) }}">
                                {{ $report['statut'] }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('reports.show', $report['id']) }}" class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($report['statut'] === 'nouveau')
                                <button class="btn btn-sm btn-outline-success confirm-report" data-id="{{ $report['id'] }}" title="Confirmer">
                                    <i class="fas fa-check"></i>
                                </button>
                                @endif
                                <button class="btn btn-sm btn-outline-danger delete-report" data-id="{{ $report['id'] }}" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $reports->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Confirmation d'un signalement
    $('.confirm-report').click(function() {
        const id = $(this).data('id');
        if (confirm('Êtes-vous sûr de vouloir confirmer ce signalement ?')) {
            $.post(`/reports/${id}/confirm`, {
                _token: '{{ csrf_token() }}'
            })
            .done(function(response) {
                if (response.success) {
                    location.reload();
                }
            });
        }
    });

    // Suppression d'un signalement
    $('.delete-report').click(function() {
        const id = $(this).data('id');
        if (confirm('Êtes-vous sûr de vouloir supprimer ce signalement ?')) {
            $.ajax({
                url: `/reports/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        }
    });
});
</script>
@endpush
@endsection 