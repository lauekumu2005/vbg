@extends('layouts.ministere')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Utilisateurs</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newUserModal">
                <i class="fas fa-user-plus"></i> Nouvel utilisateur
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
                    <label class="form-label">Recherche</label>
                    <input type="text" class="form-control" id="search" placeholder="Nom, email...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Rôle</label>
                    <select class="form-select" id="role">
                        <option value="">Tous les rôles</option>
                        <option value="admin">Administrateur</option>
                        <option value="mentor">Mentor</option>
                        <option value="user">Utilisateur</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select class="form-select" id="status">
                        <option value="">Tous les statuts</option>
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                        <option value="pending">En attente</option>
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

    <!-- Liste des utilisateurs -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Accompagnements</th>
                            <th>Statut</th>
                            <th>Dernière connexion</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2">
                                        <img src="{{ $user->avatar_url ?? asset('images/default-avatar.png') }}" 
                                             alt="{{ $user->name }}" 
                                             class="rounded-circle"
                                             width="32">
                                    </div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role_color }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>{{ $user->accompaniments_count }}</td>
                            <td>
                                <span class="badge bg-{{ $user->status_color }}">
                                    {{ $user->status }}
                                </span>
                            </td>
                            <td>{{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Jamais' }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewUserModal{{ $user->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal{{ $user->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal{{ $user->id }}">
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Nouvel Utilisateur -->
<div class="modal fade" id="newUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvel utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="newUserForm">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rôle</label>
                        <select class="form-select" name="role" required>
                            <option value="user">Utilisateur</option>
                            <option value="mentor">Mentor</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="newUserForm" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modals de visualisation pour chaque utilisateur -->
@foreach($users as $user)
<div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails de l'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <img src="{{ $user->avatar_url ?? asset('images/default-avatar.png') }}" 
                             alt="{{ $user->name }}" 
                             class="rounded-circle img-thumbnail"
                             width="150">
                    </div>
                    <div class="col-md-8">
                        <h4>{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>
                        <div class="mb-3">
                            <strong>Rôle:</strong> 
                            <span class="badge bg-{{ $user->role_color }}">{{ $user->role }}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Statut:</strong> 
                            <span class="badge bg-{{ $user->status_color }}">{{ $user->status }}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Date d'inscription:</strong> {{ $user->created_at->format('d/m/Y') }}
                        </div>
                        <div class="mb-3">
                            <strong>Dernière connexion:</strong> 
                            {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Jamais' }}
                        </div>
                    </div>
                </div>

                <!-- Accompagnements -->
                <div class="mt-4">
                    <h5>Accompagnements</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->accompaniments as $accompaniment)
                                <tr>
                                    <td>{{ $accompaniment->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $accompaniment->type }}</td>
                                    <td>
                                        <span class="badge bg-{{ $accompaniment->status_color }}">
                                            {{ $accompaniment->status }}
                                        </span>
                                    </td>
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
    // Gestion du formulaire de nouvel utilisateur
    const newUserForm = document.getElementById('newUserForm');
    if (newUserForm) {
        newUserForm.addEventListener('submit', function(e) {
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

    // Recherche en temps réel
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            // Logique de recherche
        });
    }
});
</script>
@endpush 