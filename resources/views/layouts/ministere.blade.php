<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Ministère</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/ministere.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-white">
            <div class="sidebar-header">
                <h3>Ministère</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('ministere.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('ministere.dashboard') }}">
                        <i class="fas fa-home"></i> Tableau de bord
                    </a>
                </li>
                <li class="{{ request()->routeIs('ministere.statistiques.*') ? 'active' : '' }}">
                    <a href="{{ route('ministere.statistiques.index') }}">
                        <i class="fas fa-chart-bar"></i> Statistiques
                    </a>
                </li>
                <li class="{{ request()->routeIs('ministere.rapports.*') ? 'active' : '' }}">
                    <a href="{{ route('ministere.rapports.index') }}">
                        <i class="fas fa-file-alt"></i> Rapports
                    </a>
                </li>
                <li class="{{ request()->routeIs('ministere.utilisateurs.*') ? 'active' : '' }}">
                    <a href="{{ route('ministere.utilisateurs.index') }}">
                        <i class="fas fa-users"></i> Utilisateurs
                    </a>
                </li>
                <li class="{{ request()->routeIs('ministere.accompagnements.*') ? 'active' : '' }}">
                    <a href="{{ route('ministere.accompagnements.index') }}">
                        <i class="fas fa-hands-helping"></i> Accompagnements
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle text-dark" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i>
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Paramètres</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/ministere.js') }}"></script>
    @stack('scripts')
</body>
</html> 