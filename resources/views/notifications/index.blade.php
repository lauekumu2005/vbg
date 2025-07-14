@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-4">Notifications</h2>
                <div class="space-y-4">
                    <!-- Liste des notifications -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-500">Aucune notification pour le moment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 