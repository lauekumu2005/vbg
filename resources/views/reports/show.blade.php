@extends('layouts.app')

@section('title', 'Détails du Signalement')

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

    .btn-success {
        background-color: var(--color-success);
        border-color: var(--color-success);
    }

    .btn-success:hover {
        background-color: #219a52;
        border-color: #219a52;
        transform: translateY(-1px);
    }

    .btn-danger {
        background-color: var(--color-danger);
        border-color: var(--color-danger);
    }

    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
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
    <h1 class="page-title">Détails du Signalement</h1>
    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Retour
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Informations du Signalement</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-group">
                            <label>Référence</label>
                            <p>{{ $report['reference'] }}</p>
                        </div>
                        <div class="info-group">
                            <label>Date de réception</label>
                            <p>{{ $report['date_reception']->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="info-group">
                            <label>Canal</label>
                            <p>
                                @switch($report['canal'])
                                    @case('app')
                                        <i class="fas fa-mobile-alt text-primary"></i> Application
                                        @break
                                    @case('sms')
                                        <i class="fas fa-sms text-success"></i> SMS
                                        @break
                                    @case('appel')
                                        <i class="fas fa-phone text-info"></i> Appel
                                        @break
                                @endswitch
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Type de violence</label>
                            <p><span class="badge bg-danger">{{ $report['type_violence'] }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-group">
                            <label>Zone</label>
                            <p>{{ $report['zone'] }}</p>
                        </div>
                        <div class="info-group">
                            <label>Niveau d'urgence</label>
                            <p>
                                <span class="badge bg-{{ $report['urgence'] === 'urgent' ? 'danger' : ($report['urgence'] === 'normal' ? 'warning' : 'secondary') }}">
                                    {{ $report['urgence'] }}
                                </span>
                            </p>
                        </div>
                        <div class="info-group">
                            <label>Statut</label>
                            <p>
                                <span class="badge bg-{{ $report['statut'] === 'nouveau' ? 'primary' : ($report['statut'] === 'en_cours' ? 'warning' : ($report['statut'] === 'confirme' ? 'success' : 'danger')) }}">
                                    {{ $report['statut'] }}
                                </span>
                            </p>
                        </div>
                        @if($report['service_orientation'])
                        <div class="info-group">
                            <label>Service d'orientation</label>
                            <p>{{ $report['service_orientation'] }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="info-group">
                            <label>Description</label>
                            <p>{{ $report['description'] }}</p>
                        </div>
                    </div>
                </div>

                @if($report['commentaire_orientation'])
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="info-group">
                            <label>Commentaire d'orientation</label>
                            <p>{{ $report['commentaire_orientation'] }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">Actions</h5>
            </div>
            <div class="card-body">
                @if($report['statut'] === 'nouveau')
                <button class="btn btn-success w-100 mb-3 confirm-report" data-id="{{ $report['id'] }}">
                    <i class="fas fa-check me-2"></i>Confirmer le signalement
                </button>
                @endif

                @if($report['statut'] === 'confirme' && !$report['service_orientation'])
                <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#orientModal">
                    <i class="fas fa-share-alt me-2"></i>Orienter vers un service
                </button>
                @endif

                <button class="btn btn-danger w-100 delete-report" data-id="{{ $report['id'] }}">
                    <i class="fas fa-trash me-2"></i>Supprimer le signalement
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'orientation -->
<div class="modal fade" id="orientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Orienter le signalement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="orientForm">
                    <div class="mb-3">
                        <label class="form-label">Service compétent</label>
                        <select name="service" class="form-select" required>
                            <option value="">Sélectionner un service</option>
                            <option value="police">Police</option>
                            <option value="hopital">Hôpital</option>
                            <option value="centre">Centre d'accueil</option>
                            <option value="justice">Justice</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Commentaire</label>
                        <textarea name="commentaire" class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="submitOrientation">Orienter</button>
            </div>
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
                        window.location.href = '{{ route('reports.index') }}';
                    }
                }
            });
        }
    });

    // Soumission de l'orientation
    $('#submitOrientation').click(function() {
        const form = $('#orientForm');
        const data = {
            service: form.find('[name="service"]').val(),
            commentaire: form.find('[name="commentaire"]').val(),
            _token: '{{ csrf_token() }}'
        };

        $.post(`/reports/{{ $report['id'] }}/orient`, data)
            .done(function(response) {
                if (response.success) {
                    location.reload();
                }
            });
    });
});
</script>
@endpush
@endsection 