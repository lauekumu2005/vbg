<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') - Plateforme VBG</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            :root {
                --sidebar-width: 280px;
                --primary-color: #2c3e50;
                --secondary-color: #34495e;
                --accent-color: #3498db;
                --hover-color: #2980b9;
                --text-color: #2c3e50;
                --light-text: #ffffff;
                --border-color: rgba(255, 255, 255, 0.1);
            }

            body {
                font-family: 'Poppins', sans-serif;
                background: #f5f7fa;
            }

            .sidebar {
                width: var(--sidebar-width);
                height: 100vh;
                position: fixed;
                left: 0;
                top: 0;
                background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
                color: var(--light-text);
                overflow-y: auto;
                transition: all 0.3s ease;
                z-index: 1000;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            }

            .sidebar-header {
                padding: 1.5rem;
                border-bottom: 1px solid var(--border-color);
                background: var(--primary-color);
            }

            .sidebar-header h3 {
                margin: 0;
                font-size: 1.5rem;
                font-weight: 600;
                color: var(--light-text);
            }

            .nav-section {
                padding: 1rem 0;
            }

            .nav-section-title {
                padding: 0.5rem 1.5rem;
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: rgba(255, 255, 255, 0.5);
            }

            .nav-item {
                padding: 0.8rem 1.5rem;
                display: flex;
                align-items: center;
                color: var(--light-text);
                text-decoration: none;
                transition: all 0.3s ease;
                border-radius: 0.5rem;
                margin: 0.2rem 1rem;
            }

            .nav-item:hover {
                background: var(--hover-color);
                color: var(--light-text);
                transform: translateX(5px);
            }

            .nav-item.active {
                background: var(--accent-color);
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }

            .nav-item i {
                width: 20px;
                margin-right: 10px;
                font-size: 1.1rem;
            }

            .main-content {
                margin-left: var(--sidebar-width);
                padding: 2rem;
            }

            .logout-section {
                position: absolute;
                bottom: 0;
                width: 100%;
                padding: 1rem;
                background: var(--primary-color);
                border-top: 1px solid var(--border-color);
            }

            .logout-button {
                width: 100%;
                padding: 0.8rem;
                border: none;
                background: transparent;
                color: var(--light-text);
                text-align: left;
                transition: all 0.3s ease;
                border-radius: 0.5rem;
            }

            .logout-button:hover {
                background: #dc3545;
                color: white;
            }

            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }
                .sidebar.active {
                    transform: translateX(0);
                }
                .main-content {
                    margin-left: 0;
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <div class="d-flex">
            <!-- Barre latérale -->
            <x-sidebar :active="$active ?? ''" />

            <!-- Contenu principal -->
            <div class="main-content flex-grow-1">
                <main class="py-4">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function exportReport(type) {
                const filters = {
                    genre: document.querySelector('select:nth-child(1)').value,
                    age: document.querySelector('select:nth-child(2)').value,
                    localisation: document.querySelector('select:nth-child(3)').value,
                    typeViolence: document.querySelector('select:nth-child(4)').value,
                    statut: document.querySelector('select:nth-child(5)').value
                };

                const params = new URLSearchParams(filters);
                const url = `/export/${type}?${params.toString()}`;
                window.location.href = url;
            }
        </script>
        @stack('scripts')
    </body>
</html>
