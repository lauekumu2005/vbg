@props(['active' => ''])

<aside class="sidebar">
    <!-- Logo et titre -->
    <div class="sidebar-header">
        <div class="d-flex align-items-center">
            <i class="fas fa-shield-alt text-primary me-2"></i>
            <h3>VBG-Plateforme</h3>
        </div>
        <button class="btn d-lg-none text-light" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Navigation principale -->
    <nav class="nav-section">
        <div class="nav-section-title">Menu Principal</div>
        <div class="nav-items">
            <!-- Tableau de bord -->
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                Tableau de bord
            </a>

            <!-- Signalements -->
            <a href="{{ route('reports.index') }}" class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                Signalements reçus
            </a>

            <!-- Cartographie -->
            <a href="{{ route('map.index') }}" class="nav-item {{ request()->routeIs('map.*') ? 'active' : '' }}">
                <i class="fas fa-map-marked-alt"></i>
                Cartographie des VBG
            </a>

            <!-- Victimes -->
            <a href="{{ route('victims.index') }}" class="nav-item {{ request()->routeIs('victims.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i>
                Victimes suivies
            </a>

            <!-- Réinsertions -->
            <a href="{{ route('reinsertions.index') }}" class="nav-item {{ request()->routeIs('reinsertions.*') ? 'active' : '' }}">
                <i class="fas fa-hands-helping"></i>
                Réinsertions
            </a>

            <!-- Partenaires -->
            <a href="{{ route('partners.index') }}" class="nav-item {{ request()->routeIs('partners.*') ? 'active' : '' }}">
                <i class="fas fa-handshake"></i>
                Partenaires & Centres
            </a>

            <!-- Statistiques -->
            <a href="{{ route('statistics.index') }}" class="nav-item {{ request()->routeIs('statistics.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                Statistiques & Rapports
            </a>
        </div>

        <!-- Section Administration -->
        <div class="nav-section">
            <div class="nav-section-title">Administration</div>
            <div class="nav-items">
                <!-- Utilisateurs -->
                <a href="{{ route('users.index') }}" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i>
                    Utilisateurs & Rôles
                </a>

                <!-- Notifications -->
                <a href="{{ route('notifications.index') }}" class="nav-item {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                    <i class="fas fa-bell"></i>
                    Notifications
                </a>

                <!-- Journal -->
                <a href="{{ route('activity-log.index') }}" class="nav-item {{ request()->routeIs('activity-log.*') ? 'active' : '' }}">
                    <i class="fas fa-history"></i>
                    Journal d'activité
                </a>

                <!-- Paramètres -->
                <a href="{{ route('settings.index') }}" class="nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    Paramètres
                </a>
            </div>
        </div>
    </nav>

    <!-- Déconnexion -->
    <div class="logout-section">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fas fa-sign-out-alt me-2"></i>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

<script>
document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('active');
});
</script> 