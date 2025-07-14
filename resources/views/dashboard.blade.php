@extends('layouts.app')

@section('title', 'Tableau de bord VBG - Kinshasa')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@2.2.0/Control.FullScreen.css" />
<style>
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
    :root {
        --color-primary: #2c3e50;      /* Bleu foncé de la sidebar */
        --color-secondary: #34495e;    /* Bleu secondaire */
        --color-accent: #3498db;       /* Bleu clair pour les accents */
        --color-success: #27ae60;      /* Vert plus doux */
        --color-info: #2980b9;         /* Bleu info */
        --color-warning: #f39c12;      /* Orange plus doux */
        --color-danger: #e74c3c;       /* Rouge plus doux */
        --color-text: #2c3e50;         /* Texte principal */
        --color-text-light: #7f8c8d;   /* Texte secondaire */
        --color-bg: #f5f7fa;           /* Fond légèrement bleuté */
        --color-white: #ffffff;
        --color-gold: #f1c40f;         /* Or plus doux */
        --card-shadow: 0 4px 16px rgba(44, 62, 80, 0.05);
        --border-radius: 16px;
    }

    * {
        transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
    }

    body {
        font-family: 'Inter', sans-serif;
        font-size: 15px;
        background-color: var(--color-bg);
        color: var(--color-text);
        line-height: 1.6;
    }

    .dashboard-container {
        padding: 0.5rem;
        margin-top: -1rem;
    }

    .topbar {
        background-color: var(--color-white);
        padding: 0.5rem 1rem;
        box-shadow: 0 2px 6px rgba(44, 62, 80, 0.04);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 0.5rem;
        margin-top: 0;
    }

    .topbar-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--color-primary);
        letter-spacing: 0.25px;
        margin: 0;
    }

    .section-title {
        color: var(--color-primary);
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        letter-spacing: 0.25px;
    }

    .card {
        background-color: var(--color-white);
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
        border-left: 4px solid transparent;
        height: 100%;
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .card-stats {
        border-left-color: var(--color-primary);
    }

    .card-stats:nth-child(1) {
        border-left-color: var(--color-primary);
    }

    .card-stats:nth-child(2) {
        border-left-color: var(--color-success);
    }

    .card-stats:nth-child(3) {
        border-left-color: var(--color-accent);
    }

    .card-stats:nth-child(4) {
        border-left-color: var(--color-info);
    }

    .card-map {
        border-left-color: var(--color-accent);
    }

    .card-chart {
        border-left-color: var(--color-success);
    }

    .card-alerts {
        border-left-color: var(--color-warning);
    }

    .stats-card {
        height: auto;
        min-height: 120px;
    }

    .stats-card .card-body {
        padding: 1rem;
    }

    .stats-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .stats-value {
        font-size: 1.5rem;
        margin: 0.25rem 0;
    }

    .stats-label {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .stats-trend {
        font-size: 0.85rem;
    }

    .btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        transition: all 0.2s ease-in-out;
        font-size: 0.95rem;
        letter-spacing: 0.25px;
    }

    .btn-primary {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
        color: #fff;
    }

    .btn-primary:hover {
        background-color: var(--color-secondary);
        border-color: var(--color-secondary);
    }

    .btn-outline-primary {
        color: var(--color-primary);
        border-color: var(--color-primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
    }

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 600;
        border-radius: 8px;
        letter-spacing: 0.25px;
    }

    .badge.bg-success {
        background-color: var(--color-success) !important;
    }

    .badge.bg-danger {
        background-color: var(--color-danger) !important;
    }

    .badge.ministeriel {
        background-color: var(--color-gold);
        color: var(--color-primary);
    }

    .form-control, .form-select {
        border-radius: 10px;
        border-color: #e5e7eb;
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.25);
    }

    .table {
        color: var(--color-text);
    }

    .table th {
        font-weight: 600;
        color: var(--color-text-light);
        letter-spacing: 0.25px;
    }

    .alert {
        border-radius: var(--border-radius);
        border: none;
        padding: 1rem 1.5rem;
    }

    .alert-danger {
        background-color: rgba(231, 76, 60, 0.1);
        color: var(--color-danger);
    }

    .alert-warning {
        background-color: rgba(243, 156, 18, 0.1);
        color: var(--color-warning);
    }

    .alert-info {
        background-color: rgba(52, 152, 219, 0.1);
        color: var(--color-info);
    }

    .map-container {
        height: 400px;
        border-radius: var(--border-radius);
        overflow: hidden;
        position: relative;
        z-index: 1;
        background: #f8f9fa;
    }

    #map {
        width: 100%;
        height: 100%;
        border-radius: var(--border-radius);
        min-height: 400px;
    }

    .leaflet-container {
        border-radius: var(--border-radius);
        height: 100% !important;
    }

    .card-map {
        height: 100%;
    }

    .card-map .card-body {
        height: 100%;
        padding: 1.5rem;
    }

    .chart-container {
        height: 300px;
        position: relative;
    }

    .leaflet-popup-content-wrapper {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        border: 2px solid #2c3e50;
    }

    .leaflet-popup-content {
        color: #1a202c;
        font-weight: 700;
        margin: 15px;
        font-size: 15px;
        line-height: 1.5;
        text-shadow: 
            -1px -1px 0 #fff,
            1px -1px 0 #fff,
            -1px 1px 0 #fff,
            1px 1px 0 #fff;
    }

    .leaflet-popup-tip {
        background: #ffffff;
        border: 2px solid #2c3e50;
    }

    .commune-name {
        font-size: 16px;
        font-weight: 800;
        color: #1a202c;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 5px 0;
        border-bottom: 2px solid #2c3e50;
    }

    .commune-message {
        color: #2c3e50;
        font-size: 14px;
        font-weight: 600;
        padding: 5px 0;
    }

    .leaflet-marker-icon {
        filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.5));
    }

    .custom-popup .leaflet-popup-content-wrapper {
        background: #ffffff;
        border: 2px solid #2c3e50;
    }

    .custom-popup .leaflet-popup-tip {
        background: #ffffff;
        border: 2px solid #2c3e50;
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-title">Tableau de bord Kinshasa</div>
        <div class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-calendar text-primary"></i>
                </span>
                <input type="date" class="form-control border-start-0" value="{{ date('Y-m-d') }}">
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Genre</label>
                            <select class="form-select">
                                <option value="">Tous</option>
                                <option>Femme</option>
                                <option>Homme</option>
                                <option>Autre</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Âge</label>
                            <select class="form-select">
                                <option value="">Tous</option>
                                <option>0-18 ans</option>
                                <option>19-25 ans</option>
                                <option>26-35 ans</option>
                                <option>36-50 ans</option>
                                <option>50+ ans</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Commune</label>
                            <select class="form-select">
                                <option value="">Toutes</option>
                                <option>Limete</option>
                                <option>Matete</option>
                                <option>Ngaliema</option>
                                <option>Gombe</option>
                                <option>Kinshasa</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Type de violence</label>
                            <select class="form-select">
                                <option value="">Tous</option>
                                <option>Physique</option>
                                <option>Psychologique</option>
                                <option>Économique</option>
                                <option>Sexuelle</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Statut</label>
                            <select class="form-select">
                                <option value="">Tous</option>
                                <option>En attente</option>
                                <option>Pris en charge</option>
                                <option>Clôturé</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-filter me-2"></i>Appliquer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="stats-label">Total Signalements</h6>
                            <h3 class="stats-value">2,845</h3>
                        </div>
                        <div class="stats-icon bg-primary bg-opacity-10">
                            <i class="fas fa-bell text-primary fa-lg"></i>
                        </div>
                    </div>
                    <div class="stats-trend">
                        <span class="badge bg-success me-2">
                            <i class="fas fa-arrow-up me-1"></i>18%
                        </span>
                        <span class="text-muted small">vs mois dernier</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-stats stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="stats-label">Victimes Prises en Charge</h6>
                            <h3 class="stats-value">1,892</h3>
                        </div>
                        <div class="stats-icon bg-success bg-opacity-10">
                            <i class="fas fa-user-check text-success fa-lg"></i>
                        </div>
                    </div>
                    <div class="stats-trend">
                        <span class="badge bg-success me-2">
                            <i class="fas fa-arrow-up me-1"></i>12%
                        </span>
                        <span class="text-muted small">vs mois dernier</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-stats stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="stats-label">Victimes Réinsérées</h6>
                            <h3 class="stats-value">1,245</h3>
                        </div>
                        <div class="stats-icon bg-info bg-opacity-10">
                            <i class="fas fa-home text-info fa-lg"></i>
                        </div>
                    </div>
                    <div class="stats-trend">
                        <span class="badge bg-success me-2">
                            <i class="fas fa-arrow-up me-1"></i>8%
                        </span>
                        <span class="text-muted small">vs mois dernier</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-stats stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="stats-label">Cas Critiques</h6>
                            <h3 class="stats-value">45</h3>
                        </div>
                        <div class="stats-icon bg-danger bg-opacity-10">
                            <i class="fas fa-exclamation-circle text-danger fa-lg"></i>
                        </div>
                    </div>
                    <div class="stats-trend">
                        <span class="badge bg-danger me-2">
                            <i class="fas fa-arrow-up me-1"></i>15%
                        </span>
                        <span class="text-muted small">vs mois dernier</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte et graphiques -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card card-map">
                <div class="card-body">
                    <h5 class="card-title">Répartition géographique</h5>
                    <div class="map-container">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card card-chart">
                <div class="card-body">
                    <h5 class="card-title mb-4">Types de violences</h5>
                    <div class="chart-container">
                        <canvas id="violenceTypesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertes et priorités -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card card-alerts">
                <div class="card-body">
                    <h5 class="card-title mb-4">Zones en alerte</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Commune</th>
                                    <th>Niveau d'alerte</th>
                                    <th>Cas urgents</th>
                                    <th>Dernière mise à jour</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Limete</td>
                                    <td><span class="badge bg-danger">Rouge</span></td>
                                    <td>8</td>
                                    <td>Il y a 2h</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-bell me-1"></i>Notifier
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Matete</td>
                                    <td><span class="badge bg-warning">Orange</span></td>
                                    <td>5</td>
                                    <td>Il y a 4h</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-bell me-1"></i>Notifier
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ngaliema</td>
                                    <td><span class="badge bg-info">Bleu</span></td>
                                    <td>3</td>
                                    <td>Il y a 6h</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-bell me-1"></i>Notifier
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card card-alerts">
                <div class="card-body">
                    <h5 class="card-title mb-4">Alertes prioritaires</h5>
                    <div class="d-flex flex-column gap-3">
                        <div class="alert alert-danger d-flex align-items-center mb-0">
                            <i class="fas fa-exclamation-triangle me-3"></i>
                            <div>
                                <h6 class="alert-heading mb-1">Commune de Limete</h6>
                                <p class="mb-0 small">8 cas urgents non traités</p>
                            </div>
                        </div>
                        <div class="alert alert-warning d-flex align-items-center mb-0">
                            <i class="fas fa-exclamation-circle me-3"></i>
                            <div>
                                <h6 class="alert-heading mb-1">Commune de Matete</h6>
                                <p class="mb-0 small">5 cas en attente critique</p>
                            </div>
                        </div>
                        <div class="alert alert-info d-flex align-items-center mb-0">
                            <i class="fas fa-info-circle me-3"></i>
                            <div>
                                <h6 class="alert-heading mb-1">Commune de Ngaliema</h6>
                                <p class="mb-0 small">3 cas nécessitant suivi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.fullscreen@2.2.0/Control.FullScreen.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        // Initialisation de la carte centrée sur Kinshasa
        var map = L.map('map', {
            center: [-4.3224, 15.3075],
            zoom: 11,
            zoomControl: true,
            attributionControl: true,
            minZoom: 10,
            maxZoom: 18,
            fullscreenControl: true
        });
        
        // Utilisation de la vue satellite avec teinte verte
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
            maxZoom: 19
        }).addTo(map);

        // Ajout d'une couche verte semi-transparente pour la teinte
        var greenOverlay = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            opacity: 0.3,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd'
        }).addTo(map);

        // Coordonnées réelles des communes de Kinshasa
        var communes = {
            'Bandalungwa': [-4.3506, 15.2666],
            'Barumbu': [-4.3041, 15.3086],
            'Bumbu': [-4.3700, 15.2883],
            'Gombe': [-4.3167, 15.3000],
            'Kalamu': [-4.3622, 15.3097],
            'Kasa-Vubu': [-4.3381, 15.2883],
            'Kimbanseke': [-4.4631, 15.4092],
            'Kinshasa': [-4.3250, 15.2981],
            'Kintambo': [-4.3256, 15.2636],
            'Kisenso': [-4.3950, 15.3742],
            'Lemba': [-4.3956, 15.3272],
            'Limete': [-4.3833, 15.3500],
            'Lingwala': [-4.3292, 15.3081],
            'Makala': [-4.3833, 15.2833],
            'Maluku': [-4.1833, 15.7500],
            'Masina': [-4.3833, 15.4000],
            'Matete': [-4.3833, 15.3333],
            'Mont-Ngafula': [-4.4667, 15.2333],
            'Ndjili': [-4.3833, 15.3667],
            'Ngaba': [-4.4000, 15.3000],
            'Ngaliema': [-4.3833, 15.2333],
            'Ngiri-Ngiri': [-4.3500, 15.2833],
            'Nsele': [-4.3167, 15.6167],
            'Selembao': [-4.3667, 15.2667]
        };

        // Définition des alertes
        var alertes = {
            'Limete': {color: 'red', message: '8 cas urgents non traités'},
            'Matete': {color: 'orange', message: '5 cas en attente critique'},
            'Ngaliema': {color: 'blue', message: '3 cas nécessitant suivi'}
        };

        // Icônes personnalisés
        var iconRouge = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var iconOrange = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var iconBleu = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var iconVert = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Création des marqueurs pour chaque commune
        Object.keys(communes).forEach(function(commune) {
            var coords = communes[commune];
            var icon = iconVert;
            var popup = `<div class="commune-name">${commune}</div>`;
            if (alertes[commune]) {
                if(alertes[commune].color === 'red') icon = iconRouge;
                else if(alertes[commune].color === 'orange') icon = iconOrange;
                else if(alertes[commune].color === 'blue') icon = iconBleu;
                popup = `<div class="commune-name">${commune}</div><div class="commune-message">${alertes[commune].message}</div>`;
            }
            var marker = L.marker(coords, {icon: icon}).addTo(map);
            marker.bindPopup(popup, {
                className: 'custom-popup',
                maxWidth: 250,
                minWidth: 200,
                closeButton: true,
                autoClose: false
            });
        });

        // Ajuster la vue pour montrer toutes les communes
        var bounds = L.latLngBounds(Object.values(communes));
        map.fitBounds(bounds, {
            padding: [50, 50],
            maxZoom: 12
        });

        // Forcer le redimensionnement de la carte
        map.invalidateSize(true);
    }, 100);

    // Graphique des types de violences
    new Chart(document.getElementById('violenceTypesChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Physique', 'Psychologique', 'Économique', 'Sexuelle'],
            datasets: [{
                data: [45, 25, 20, 10],
                backgroundColor: [
                    '#E53935',
                    '#4B2E83',
                    '#43A047',
                    '#FFA726'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            family: 'Inter',
                            size: 12
                        },
                        color: '#2c3e50'
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection 