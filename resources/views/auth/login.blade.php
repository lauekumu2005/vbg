<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Ministère</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --light-bg: #f5f7fa;
            --dark-text: #2c3e50;
            --light-text: #ffffff;
            --input-bg: rgba(255, 255, 255, 0.9);
            --input-border: rgba(233, 236, 239, 0.8);
            --input-focus: #3498db;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        body {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 50%, #2c3e50 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(255,255,255,0.05) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
            z-index: 0;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .login-container {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 1.5rem;
            box-shadow: var(--glass-shadow);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        .login-container:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-color));
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .login-container:hover .login-header::after {
            width: 100px;
        }

        .login-header h1 {
            color: var(--dark-text);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-floating {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-floating > .form-control {
            padding: 1.25rem 1rem;
            height: calc(3.75rem + 2px);
            line-height: 1.25;
            border-radius: 0.75rem;
            border: 2px solid var(--input-border);
            background-color: var(--input-bg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .form-floating > .form-control:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 4px rgba(57, 73, 171, 0.1);
            background-color: var(--light-text);
            transform: translateY(-2px);
        }

        .form-floating > label {
            padding: 1.25rem 1rem;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 50%;
            background: transparent;
        }

        .password-toggle:hover {
            background-color: var(--input-bg);
            color: var(--input-focus);
            transform: translateY(-50%) scale(1.1);
        }

        .btn-login {
            background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
            border: none;
            color: var(--light-text);
            padding: 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(57, 73, 171, 0.3);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin: 1.25rem 0;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background: transparent;
        }

        .remember-me:hover {
            background-color: var(--input-bg);
            transform: translateX(5px);
        }

        .remember-me input[type="checkbox"] {
            margin-right: 0.75rem;
            width: 1.1rem;
            height: 1.1rem;
            border-radius: 0.25rem;
            border: 2px solid var(--input-border);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remember-me input[type="checkbox"]:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .forgot-password {
            text-align: right;
            margin-top: 0.75rem;
        }

        .forgot-password a {
            color: var(--accent-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 0.5rem;
            position: relative;
        }

        .forgot-password a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: width 0.3s ease;
        }

        .forgot-password a:hover::after {
            width: 100%;
        }

        .alert {
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border: none;
            background-color: rgba(254, 226, 226, 0.9);
            color: #dc2626;
            font-weight: 500;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        .alert ul {
            margin: 0.5rem 0 0 0;
            padding-left: 1.25rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .login-header h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Ministère</h1>
            <p>Connectez-vous à votre espace</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                <label for="email">Email</label>
            </div>

            <div class="form-floating position-relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                <label for="password">Mot de passe</label>
                <span class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>

            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
            </button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.querySelector('.password-toggle i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
