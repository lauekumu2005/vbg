@extends('layouts.app')

@section('title', 'Paramètres')

@push('styles')
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
</style>
@endpush

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-4">Paramètres</h2>
                <div class="space-y-6">
                    <!-- Paramètres du compte -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-2">Paramètres du compte</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Langue</label>
                                <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option>Français</option>
                                    <option>English</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fuseau horaire</label>
                                <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option>Afrique/Kinshasa (GMT+1)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-2">Préférences de notification</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <label class="ml-2 block text-sm text-gray-900">Notifications par email</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <label class="ml-2 block text-sm text-gray-900">Notifications dans l'application</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 