@extends('layouts.ministere')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Paramètres</h1>
    </div>

    <div class="row">
        <!-- Paramètres généraux -->
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Paramètres généraux</h5>
                </div>
                <div class="card-body">
                    <form id="generalSettingsForm">
                        <div class="mb-3">
                            <label class="form-label">Nom de l'organisation</label>
                            <input type="text" class="form-control" name="organization_name" value="{{ $settings->organization_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email de contact</label>
                            <input type="email" class="form-control" name="contact_email" value="{{ $settings->contact_email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" name="phone" value="{{ $settings->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse</label>
                            <textarea class="form-control" name="address" rows="3">{{ $settings->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $settings->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Paramètres des notifications -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Paramètres des notifications</h5>
                </div>
                <div class="card-body">
                    <form id="notificationSettingsForm">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="email_notifications" 
                                       id="emailNotifications" {{ $settings->email_notifications ? 'checked' : '' }}>
                                <label class="form-check-label" for="emailNotifications">
                                    Notifications par email
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="sms_notifications" 
                                       id="smsNotifications" {{ $settings->sms_notifications ? 'checked' : '' }}>
                                <label class="form-check-label" for="smsNotifications">
                                    Notifications par SMS
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="push_notifications" 
                                       id="pushNotifications" {{ $settings->push_notifications ? 'checked' : '' }}>
                                <label class="form-check-label" for="pushNotifications">
                                    Notifications push
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Paramètres avancés -->
        <div class="col-xl-4">
            <!-- Paramètres de sécurité -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sécurité</h5>
                </div>
                <div class="card-body">
                    <form id="securitySettingsForm">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="two_factor_auth" 
                                       id="twoFactorAuth" {{ $settings->two_factor_auth ? 'checked' : '' }}>
                                <label class="form-check-label" for="twoFactorAuth">
                                    Authentification à deux facteurs
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="session_timeout" 
                                       id="sessionTimeout" {{ $settings->session_timeout ? 'checked' : '' }}>
                                <label class="form-check-label" for="sessionTimeout">
                                    Déconnexion automatique
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Délai de déconnexion (minutes)</label>
                            <input type="number" class="form-control" name="session_timeout_duration" 
                                   value="{{ $settings->session_timeout_duration }}" min="5" max="120">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Maintenance -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Maintenance</h5>
                </div>
                <div class="card-body">
                    <form id="maintenanceSettingsForm">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="maintenance_mode" 
                                       id="maintenanceMode" {{ $settings->maintenance_mode ? 'checked' : '' }}>
                                <label class="form-check-label" for="maintenanceMode">
                                    Mode maintenance
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message de maintenance</label>
                            <textarea class="form-control" name="maintenance_message" rows="3">{{ $settings->maintenance_message }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sauvegarde -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sauvegarde</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <button type="button" class="btn btn-outline-primary w-100" id="backupNow">
                            <i class="fas fa-download"></i> Sauvegarder maintenant
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dernière sauvegarde</label>
                        <p class="text-muted">{{ $settings->last_backup ? $settings->last_backup->format('d/m/Y H:i') : 'Jamais' }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="auto_backup" 
                                   id="autoBackup" {{ $settings->auto_backup ? 'checked' : '' }}>
                            <label class="form-check-label" for="autoBackup">
                                Sauvegarde automatique
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fréquence de sauvegarde</label>
                        <select class="form-select" name="backup_frequency">
                            <option value="daily" {{ $settings->backup_frequency === 'daily' ? 'selected' : '' }}>Quotidienne</option>
                            <option value="weekly" {{ $settings->backup_frequency === 'weekly' ? 'selected' : '' }}>Hebdomadaire</option>
                            <option value="monthly" {{ $settings->backup_frequency === 'monthly' ? 'selected' : '' }}>Mensuelle</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des formulaires
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            // Logique d'envoi du formulaire
        });
    });

    // Sauvegarde manuelle
    const backupButton = document.getElementById('backupNow');
    if (backupButton) {
        backupButton.addEventListener('click', function() {
            // Logique de sauvegarde
        });
    }
});
</script>
@endpush 