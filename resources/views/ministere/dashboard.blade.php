@extends('layouts.ministere')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Tableau de bord</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary">
                <i class="fas fa-download"></i> Exporter
            </button>
            <button type="button" class="btn btn-outline-primary">
                <i class="fas fa-print"></i> Imprimer
            </button>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-primary text-white">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="value">{{ $stats['total_users'] }}</div>
                <div class="label">Utilisateurs totaux</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-success text-white">
                <div class="icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="value">{{ $stats['active_accompaniments'] }}</div>
                <div class="label">Accompagnements actifs</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-info text-white">
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="value">{{ $stats['total_reports'] }}</div>
                <div class="label">Rapports</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-warning text-white">
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="value">{{ number_format($stats['total_reports'] / max($stats['total_users'], 1), 1) }}</div>
                <div class="label">Rapports par utilisateur</div>
            </div>
        </div>
    </div>

    <!-- Activités récentes -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Activités récentes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Utilisateur</th>
                                    <th>Action</th>
                                    <th>Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_activities'] as $activity)
                                <tr>
                                    <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $activity->user_name }}</td>
                                    <td>{{ $activity->action }}</td>
                                    <td>{{ $activity->details }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Accompagnements par catégorie</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Activité mensuelle</h5>
                </div>
                <div class="card-body">
                    <canvas id="activityChart"></canvas>
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
    // Graphique des catégories
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: ['Professionnel', 'Personnel', 'Éducatif'],
            datasets: [{
                data: [30, 40, 30],
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

    // Graphique d'activité
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Accompagnements',
                data: [12, 19, 15, 25, 22, 30],
                borderColor: '#0d6efd',
                tension: 0.4
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
});
</script>
@endpush 