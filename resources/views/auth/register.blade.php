@extends('layouts.guest')

@section('content')
<style>
    .register-form {
        max-width: 400px;
        margin: 40px auto;
        padding: 32px 24px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
    }
    .register-form label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }
    .register-form input, .register-form select {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 18px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 1rem;
        background: #f9fafb;
        transition: border 0.2s;
    }
    .register-form input:focus, .register-form select:focus {
        border-color: #2563eb;
        outline: none;
    }
    .register-form button {
        width: 100%;
        padding: 12px;
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
    }
    .register-form button:hover {
        background: #1d4ed8;
    }
    .register-form .link {
        display: block;
        text-align: center;
        margin-top: 18px;
        color: #2563eb;
        text-decoration: none;
    }
    .register-form .link:hover {
        text-decoration: underline;
    }
</style>

<div class="register-form">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 style="text-align:center; margin-bottom: 24px;">Créer un compte</h2>

        <!-- Name -->
        <label for="name">Nom</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
            <div style="color: #dc2626; font-size: 0.95em;">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <label for="email">Adresse e-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div style="color: #dc2626; font-size: 0.95em;">{{ $message }}</div>
        @enderror

        <!-- Password -->
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required autocomplete="new-password">
        @error('password')
            <div style="color: #dc2626; font-size: 0.95em;">{{ $message }}</div>
        @enderror

        <!-- Confirm Password -->
        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
        @error('password_confirmation')
            <div style="color: #dc2626; font-size: 0.95em;">{{ $message }}</div>
        @enderror

        <!-- Role -->
        <label for="role">Rôle</label>
        <select id="role" name="role" required>
            <option value="">-- Sélectionner un rôle --</option>
            <option value="hopital" {{ old('role') == 'hopital' ? 'selected' : '' }}>Hôpital</option>
            <option value="ministere" {{ old('role') == 'ministere' ? 'selected' : '' }}>Ministère</option>
            <option value="victime" {{ old('role') == 'victime' ? 'selected' : '' }}>Victime</option>
            <option value="prison" {{ old('role') == 'prison' ? 'selected' : '' }}>Prison</option>
        </select>
        @error('role')
            <div style="color: #dc2626; font-size: 0.95em;">{{ $message }}</div>
        @enderror

        <button type="submit">S'inscrire</button>

        <a class="link" href="{{ route('login') }}">
            Déjà inscrit ? Se connecter
        </a>
    </form>
</div>
@endsection