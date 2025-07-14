@extends('layouts.app')

@section('title', 'Cartes et zones à risque')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4">Cartes et zones à risque</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Carte des zones à risque</h6>
                </div>
                <div class="card-body">
                    <div id="map" style="height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script>
    // Initialisation de la carte
    const map = L.map('map').setView([14.7167, -17.4677], 13);

    // Ajout du fond de carte
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Exemple de zones à risque
    const riskZones = [
        { lat: 14.7167, lng: -17.4677, name: 'Zone A', risk: 'Élevé' },
        { lat: 14.7267, lng: -17.4577, name: 'Zone B', risk: 'Moyen' },
        { lat: 14.7067, lng: -17.4777, name: 'Zone C', risk: 'Élevé' }
    ];

    // Ajout des marqueurs pour chaque zone
    riskZones.forEach(zone => {
        const color = zone.risk === 'Élevé' ? 'red' : 'orange';
        L.circleMarker([zone.lat, zone.lng], {
            radius: 8,
            fillColor: color,
            color: '#fff',
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        }).addTo(map).bindPopup(`${zone.name}<br>Niveau de risque: ${zone.risk}`);
    });
</script>
@endpush
@endsection 
 