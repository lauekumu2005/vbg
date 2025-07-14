@extends('layouts.ministere')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Statistiques</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary" id="exportData">
                <i class="fas fa-download"></i> Exporter
            </button>
            <button type="button" class="btn btn-outline-primary" id="printData">
                <i class="fas fa-print"></i> Imprimer
            </button>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Période</label>
                    <select class="form-select" id="period">
                        <option value="week">Cette semaine</option>
                        <option value="month" selected>Ce mois</option>
                        <option value="year">Cette année</option>
                        <option value="custom">Personnalisé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Catégorie</label>
                    <select class="form-select" id="category">
                        <option value="all" selected>Toutes les catégories</option>
                        <option value="professional">Professionnel</option>
                        <option value="personal">Personnel</option>
                        <option value="educational">Éducatif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type d'accompagnement</label>
                    <select class="form-select" id="type">
                        <option value="all" selected>Tous les types</option>
                        <option value="individual">Individuel</option>
                        <option value="group">Groupe</option>
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

    <!-- Graphiques -->
    <div class="row">
        <!-- Évolution mensuelle -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Évolution des accompagnements</h5>
                </div>
                <div class="card-body">
                    <canvas id="evolutionChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Répartition par catégorie -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Répartition par catégorie</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques détaillées -->
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistiques par région</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Région</th>
                                    <th>Accompagnements</th>
                                    <th>Utilisateurs</th>
                                    <th>Taux de satisfaction</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($regionStats as $region)
                                <tr>
                                    <td>{{ $region->name }}</td>
                                    <td>{{ $region->accompaniments_count }}</td>
                                    <td>{{ $region->users_count }}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" 
                                                 style="width: {{ $region->satisfaction_rate }}%"
                                                 aria-valuenow="{{ $region->satisfaction_rate }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ $region->satisfaction_rate }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Indicateurs de performance</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="stats-card mb-3">
                                <div class="icon text-primary">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="value">{{ $stats['average_duration'] }} jours</div>
                                <div class="label">Durée moyenne d'accompagnement</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-card mb-3">
                                <div class="icon text-success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="value">{{ $stats['success_rate'] }}%</div>
                                <div class="label">Taux de réussite</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-card mb-3">
                                <div class="icon text-info">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="value">{{ $stats['new_users'] }}</div>
                                <div class="label">Nouveaux utilisateurs</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-card mb-3">
                                <div class="icon text-warning">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="value">{{ $stats['average_rating'] }}/5</div>
                                <div class="label">Note moyenne</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique d'évolution
    const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
    new Chart(evolutionCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Accompagnements',
                data: [65, 59, 80, 81, 56, 55, 40, 45, 60, 75, 85, 90],
                borderColor: '#0d6efd',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(13, 110, 253, 0.1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique des catégories
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Professionnel', 'Personnel', 'Éducatif'],
            datasets: [{
                data: [40, 35, 25],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Gestion des filtres
    document.getElementById('period').addEventListener('change', function() {
        if (this.value === 'custom') {
            // Afficher les champs de date personnalisés
        }
    });

    // Export des données
    document.getElementById('exportData').addEventListener('click', function() {
        // Logique d'export
    });

    // Impression
    document.getElementById('printData').addEventListener('click', function() {
        window.print();
    });
});
</script>
@endpush 