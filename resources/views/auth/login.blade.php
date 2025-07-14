@extends('layouts.guest')

@section('content')
<style>
    .login-form {
        max-width: 370px;
        margin: 0 auto;
        padding: 38px 30px 30px 30px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 8px 32px rgba(30, 41, 59, 0.13), 0 1.5px 4px rgba(30,41,59,0.07);
        font-family: 'Segoe UI', Arial, sans-serif;
        transition: box-shadow 0.3s;
    }
    .login-form:hover {
        box-shadow: 0 12px 40px rgba(30, 41, 59, 0.18), 0 2px 8px rgba(30,41,59,0.10);
    }
    .login-form h2 {
        text-align: center;
        margin-bottom: 26px;
        font-weight: 700;
        color: #23272f;
        letter-spacing: 0.5px;
    }
    .login-form label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #23272f;
        letter-spacing: 0.2px;
    }
    .login-form input[type="email"], .login-form input[type="password"] {
        width: 100%;
        padding: 11px 13px;
        margin-bottom: 18px;
        border: 1.2px solid #d1d5db;
        border-radius: 7px;
        font-size: 1rem;
        background: #f7f7f7;
        transition: border 0.2s, box-shadow 0.2s;
        box-shadow: 0 0 0 0 rgba(60, 130, 246, 0);
    }
    .login-form input:focus {
        border-color: #64748b;
        background: #fff;
        box-shadow: 0 0 0 2px #cbd5e1;
        outline: none;
    }
    .login-form button {
        width: 100%;
        padding: 12px;
        background: #23272f;
        color: #fff;
        border: none;
        border-radius: 7px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s, box-shadow 0.2s;
        margin-top: 8px;
        box-shadow: 0 2px 8px rgba(30,41,59,0.07);
    }
    .login-form button:hover {
        background: #3b4252;
        box-shadow: 0 4px 16px rgba(30,41,59,0.13);
    }
    .login-form .links {
        text-align: center;
        margin-top: 18px;
    }
    .login-form .links a {
        color: #23272f;
        text-decoration: none;
        margin: 0 8px;
        font-size: 0.98em;
        opacity: 0.85;
        transition: opacity 0.2s;
    }
    .login-form .links a:hover {
        opacity: 1;
        text-decoration: underline;
    }
    .login-form .error {
        color: #dc2626;
        font-size: 0.95em;
        margin-bottom: 10px;
    }
    .login-form .status {
        color: #15803d;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 6px;
        padding: 10px 12px;
        margin-bottom: 18px;
        text-align: center;
    }
    @media (max-width: 480px) {
        .login-form {
            min-width: unset;
            width: 97vw;
            padding: 18px 4vw;
        }
    }
</style>

<div class="login-form">
    <h2>Connexion</h2>

    @if (session('status'))
        <div class="status">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Adresse e-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <div style="margin-bottom: 18px;">
            <label style="font-weight:400;">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Se souvenir de moi
            </label>
        </div>

        <button type="submit">Se connecter</button>

        <div class="links">
            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            <a href="{{ route('register') }}">Créer un compte</a>
        </div>
    </form>
</div>
@endsection