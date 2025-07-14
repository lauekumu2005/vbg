<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\ReinsertionController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AccompanimentController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\VictimController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Signalements
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    
    // Cartographie
    Route::get('/map', [MapsController::class, 'index'])->name('map');
    
    // Victimes
    Route::get('/victims', [CasesController::class, 'index'])->name('victims');
    
    // Réinsertions
    Route::get('/reinsertions', [ReinsertionController::class, 'index'])->name('reinsertions');
    
    // Partenaires
    Route::get('/partners', [ServicesController::class, 'partners'])->name('partners');
    
    // Statistiques
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');
    
    // Utilisateurs
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    
    // Notifications
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
    
    // Journal d'activité
    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log');
    
    // Paramètres
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Déconnexion
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Export
    Route::get('/export/{type}', [ExportController::class, 'export'])->name('export');

    // Reports
    Route::resource('reports', ReportController::class);

    // Map
    Route::resource('map', MapController::class);

    // Victims
    Route::resource('victims', VictimController::class);

    // Reinsertions
    Route::resource('reinsertions', ReinsertionController::class);

    // Partners
    Route::resource('partners', PartnerController::class);

    // Statistics
    Route::resource('statistics', StatisticsController::class);

    // Administration
    Route::resource('users', UserController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('activity-log', ActivityLogController::class);
    Route::resource('settings', SettingController::class);

    // Routes pour les signalements
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::post('/reports/{report}/confirm', [ReportController::class, 'confirm'])->name('reports.confirm');
    Route::post('/reports/{report}/orient', [ReportController::class, 'orient'])->name('reports.orient');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');

    // Routes pour la réinsertion
    Route::get('/reinsertion', [ReinsertionController::class, 'index'])->name('reinsertion.index');
    Route::get('/reinsertion/{reinsertion}', [ReinsertionController::class, 'show'])->name('reinsertion.show');
    Route::get('/reinsertion/{reinsertion}/edit', [ReinsertionController::class, 'edit'])->name('reinsertion.edit');
    Route::put('/reinsertion/{reinsertion}', [ReinsertionController::class, 'update'])->name('reinsertion.update');
    Route::delete('/reinsertion/{reinsertion}', [ReinsertionController::class, 'destroy'])->name('reinsertion.destroy');
});
