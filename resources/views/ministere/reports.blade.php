@extends('layouts.ministere')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Rapports</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newReportModal">
                <i class="fas fa-plus"></i> Nouveau rapport
            </button>
            <button type="button" class="btn btn-outline-primary">
                <i class="fas fa-download"></i> Exporter
            </button>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" id="date">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Catégorie</label>
                    <select class="form-select" id="category">
                        <option value="">Toutes les catégories</option>
                        <option value="professional">Professionnel</option>
                        <option value="personal">Personnel</option>
                        <option value="educational">Éducatif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select class="form-select" id="status">
                        <option value="">Tous les statuts</option>
                        <option value="pending">En attente</option>
                        <option value="approved">Approuvé</option>
                        <option value="rejected">Rejeté</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Filtrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des rapports -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Auteur</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{ $report->created_at->format('d/m/Y') }}</td>
                            <td>{{ $report->title }}</td>
                            <td>
                                <span class="badge bg-{{ $report->category_color }}">
                                    {{ $report->category }}
                                </span>
                            </td>
                            <td>{{ $report->user->name }}</td>
                            <td>
                                <span class="badge bg-{{ $report->status_color }}">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewReportModal{{ $report->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#approveReportModal{{ $report->id }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#rejectReportModal{{ $report->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Nouveau Rapport -->
<div class="modal fade" id="newReportModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau rapport</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="newReportForm">
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catégorie</label>
                        <select class="form-select" name="category" required>
                            <option value="professional">Professionnel</option>
                            <option value="personal">Personnel</option>
                            <option value="educational">Éducatif</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contenu</label>
                        <textarea class="form-control" name="content" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fichiers joints</label>
                        <input type="file" class="form-control" name="attachments[]" multiple>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="newReportForm" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modals de visualisation pour chaque rapport -->
@foreach($reports as $report)
<div class="modal fade" id="viewReportModal{{ $report->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $report->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Catégorie:</strong> {{ $report->category }}
                </div>
                <div class="mb-3">
                    <strong>Auteur:</strong> {{ $report->user->name }}
                </div>
                <div class="mb-3">
                    <strong>Date:</strong> {{ $report->created_at->format('d/m/Y H:i') }}
                </div>
                <div class="mb-3">
                    <strong>Contenu:</strong>
                    <p>{{ $report->content }}</p>
                </div>
                @if($report->attachments)
                <div class="mb-3">
                    <strong>Fichiers joints:</strong>
                    <ul class="list-unstyled">
                        @foreach($report->attachments as $attachment)
                        <li>
                            <a href="{{ $attachment->url }}" target="_blank">
                                <i class="fas fa-paperclip"></i> {{ $attachment->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du formulaire de nouveau rapport
    const newReportForm = document.getElementById('newReportForm');
    if (newReportForm) {
        newReportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Logique d'envoi du formulaire
        });
    }

    // Gestion des filtres
    const filterForm = document.querySelector('form');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Logique de filtrage
        });
    }
});
</script>
@endpush 