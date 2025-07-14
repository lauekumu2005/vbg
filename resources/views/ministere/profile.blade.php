@extends('layouts.ministere')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Mon profil</h1>
    </div>

    <div class="row">
        <!-- Informations personnelles -->
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informations personnelles</h5>
                </div>
                <div class="card-body">
                    <form id="profileForm" method="POST" action="{{ route('ministere.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <div class="avatar-wrapper">
                                    <img src="{{ auth()->user()->avatar_url ?? asset('images/default-avatar.png') }}" 
                                         alt="{{ auth()->user()->name }}" 
                                         class="rounded-circle img-thumbnail"
                                         width="150"
                                         id="avatarPreview">
                                    <div class="avatar-overlay">
                                        <label for="avatar" class="btn btn-sm btn-primary">
                                            <i class="fas fa-camera"></i>
                                        </label>
                                    </div>
                                </div>
                                <input type="file" class="d-none" id="avatar" name="avatar" accept="image/*">
                                <small class="text-muted d-block mt-2">Cliquez pour changer la photo</small>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Nom</label>
                                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ auth()->user()->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Fonction</label>
                                    <input type="text" class="form-control" name="position" value="{{ auth()->user()->position }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bio</label>
                                    <textarea class="form-control" name="bio" rows="3">{{ auth()->user()->bio }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer les modifications
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sécurité -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sécurité</h5>
                </div>
                <div class="card-body">
                    <form id="securityForm" method="POST" action="{{ route('ministere.profile.update-password') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Mot de passe actuel</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Changer le mot de passe
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Activité récente -->
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Activité récente</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @foreach($activities as $activity)
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6 class="mb-0">{{ $activity->title }}</h6>
                                <small class="text-muted">{{ $activity->created_at->format('d/m/Y H:i') }}</small>
                                <p class="mb-0">{{ $activity->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Préférences -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Préférences</h5>
                </div>
                <div class="card-body">
                    <form id="preferencesForm" method="POST" action="{{ route('ministere.profile.update-preferences') }}">
                        @csrf
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="email_notifications" 
                                       id="emailNotifications" {{ auth()->user()->email_notifications ? 'checked' : '' }}>
                                <label class="form-check-label" for="emailNotifications">
                                    Notifications par email
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="sms_notifications" 
                                       id="smsNotifications" {{ auth()->user()->sms_notifications ? 'checked' : '' }}>
                                <label class="form-check-label" for="smsNotifications">
                                    Notifications par SMS
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="push_notifications" 
                                       id="pushNotifications" {{ auth()->user()->push_notifications ? 'checked' : '' }}>
                                <label class="form-check-label" for="pushNotifications">
                                    Notifications push
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer les préférences
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar-wrapper {
    position: relative;
    display: inline-block;
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.avatar-wrapper:hover .avatar-overlay {
    opacity: 1;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 1.5rem;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: var(--primary-color);
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px var(--primary-color);
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -23px;
    top: 15px;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Prévisualisation de l'avatar
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');

    if (avatarInput && avatarPreview) {
        avatarInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Gestion des formulaires
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            // Logique d'envoi du formulaire
        });
    });
});
</script>
@endpush 