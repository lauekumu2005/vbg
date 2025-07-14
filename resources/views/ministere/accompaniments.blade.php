@extends('layouts.ministere')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Accompagnements</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newAccompanimentModal">
                <i class="fas fa-plus"></i> Nouvel accompagnement
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
                    <label class="form-label">Type</label>
                    <select class="form-select" id="type">
                        <option value="">Tous les types</option>
                        <option value="individual">Individuel</option>
                        <option value="group">Groupe</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select class="form-select" id="status">
                        <option value="">Tous les statuts</option>
                        <option value="pending">En attente</option>
                        <option value="active">Actif</option>
                        <option value="completed">Terminé</option>
                        <option value="cancelled">Annulé</option>
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

    <!-- Liste des accompagnements -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Utilisateur</th>
                            <th>Mentor</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Progression</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accompaniments as $accompaniment)
                        <tr>
                            <td>{{ $accompaniment->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2">
                                        <img src="{{ $accompaniment->user->avatar_url ?? asset('images/default-avatar.png') }}" 
                                             alt="{{ $accompaniment->user->name }}" 
                                             class="rounded-circle"
                                             width="32">
                                    </div>
                                    {{ $accompaniment->user->name }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2">
                                        <img src="{{ $accompaniment->mentor->avatar_url ?? asset('images/default-avatar.png') }}" 
                                             alt="{{ $accompaniment->mentor->name }}" 
                                             class="rounded-circle"
                                             width="32">
                                    </div>
                                    {{ $accompaniment->mentor->name }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ $accompaniment->type_color }}">
                                    {{ $accompaniment->type }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $accompaniment->status_color }}">
                                    {{ $accompaniment->status }}
                                </span>
                            </td>
                            <td>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ $accompaniment->progress }}%"
                                         aria-valuenow="{{ $accompaniment->progress }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">{{ $accompaniment->progress }}%</small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewAccompanimentModal{{ $accompaniment->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editAccompanimentModal{{ $accompaniment->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteAccompanimentModal{{ $accompaniment->id }}">
                                        <i class="fas fa-trash"></i>
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
                {{ $accompaniments->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Nouvel Accompagnement -->
<div class="modal fade" id="newAccompanimentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvel accompagnement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="newAccompanimentForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Utilisateur</label>
                                <select class="form-select" name="user_id" required>
                                    <option value="">Sélectionner un utilisateur</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mentor</label>
                                <select class="form-select" name="mentor_id" required>
                                    <option value="">Sélectionner un mentor</option>
                                    @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select class="form-select" name="type" required>
                                    <option value="individual">Individuel</option>
                                    <option value="group">Groupe</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Objectif</label>
                                <input type="text" class="form-control" name="objective" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date de début</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date de fin prévue</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="newAccompanimentForm" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modals de visualisation pour chaque accompagnement -->
@foreach($accompaniments as $accompaniment)
<div class="modal fade" id="viewAccompanimentModal{{ $accompaniment->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails de l'accompagnement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Utilisateur</h6>
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $accompaniment->user->avatar_url ?? asset('images/default-avatar.png') }}" 
                                 alt="{{ $accompaniment->user->name }}" 
                                 class="rounded-circle me-2"
                                 width="40">
                            <div>
                                <div>{{ $accompaniment->user->name }}</div>
                                <small class="text-muted">{{ $accompaniment->user->email }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Mentor</h6>
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $accompaniment->mentor->avatar_url ?? asset('images/default-avatar.png') }}" 
                                 alt="{{ $accompaniment->mentor->name }}" 
                                 class="rounded-circle me-2"
                                 width="40">
                            <div>
                                <div>{{ $accompaniment->mentor->name }}</div>
                                <small class="text-muted">{{ $accompaniment->mentor->email }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6>Informations</h6>
                        <div class="mb-3">
                            <strong>Type:</strong> 
                            <span class="badge bg-{{ $accompaniment->type_color }}">
                                {{ $accompaniment->type }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <strong>Statut:</strong> 
                            <span class="badge bg-{{ $accompaniment->status_color }}">
                                {{ $accompaniment->status }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <strong>Objectif:</strong> {{ $accompaniment->objective }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Dates</h6>
                        <div class="mb-3">
                            <strong>Date de début:</strong> {{ $accompaniment->start_date->format('d/m/Y') }}
                        </div>
                        <div class="mb-3">
                            <strong>Date de fin prévue:</strong> {{ $accompaniment->end_date->format('d/m/Y') }}
                        </div>
                        <div class="mb-3">
                            <strong>Progression:</strong>
                            <div class="progress mt-2">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ $accompaniment->progress }}%"
                                     aria-valuenow="{{ $accompaniment->progress }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    {{ $accompaniment->progress }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h6>Description</h6>
                    <p>{{ $accompaniment->description }}</p>
                </div>

                <!-- Sessions -->
                <div class="mt-4">
                    <h6>Sessions</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Durée</th>
                                    <th>Statut</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accompaniment->sessions as $session)
                                <tr>
                                    <td>{{ $session->date->format('d/m/Y H:i') }}</td>
                                    <td>{{ $session->duration }} minutes</td>
                                    <td>
                                        <span class="badge bg-{{ $session->status_color }}">
                                            {{ $session->status }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($session->notes, 50) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
    // Gestion du formulaire de nouvel accompagnement
    const newAccompanimentForm = document.getElementById('newAccompanimentForm');
    if (newAccompanimentForm) {
        newAccompanimentForm.addEventListener('submit', function(e) {
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