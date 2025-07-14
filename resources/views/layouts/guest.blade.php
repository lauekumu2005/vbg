<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Authentification</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, #e0e7ff 0%, #f3f4f6 100%);
        }
        .auth-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .auth-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 32px rgba(30, 41, 59, 0.10);
            padding: 40px 32px 32px 32px;
            min-width: 340px;
            max-width: 100vw;
            margin: 24px 0;
        }
        .logo {
            margin-bottom: 24px;
            text-align: center;
        }
        @media (max-width: 480px) {
            .auth-card {
                min-width: unset;
                width: 95vw;
                padding: 24px 8px;
            }
        }
    </style>
    @yield('head')
</head>
<body>
    <div class="auth-container">
        <div class="logo">
            <!-- Remplace par ton logo si besoin -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 56px;">
            </a>
        </div>
        <div class="auth-card">
            @yield('content')
        </div>
    </div>
</body>
</html>