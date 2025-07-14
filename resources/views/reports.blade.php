@extends('layouts.app')

@section('title', 'Rapports')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4">Rapports</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Rapports disponibles</h6>
                    <div>
                        <button class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-file-pdf"></i> Exporter PDF
                        </button>
                        <button class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel"></i> Exporter Excel
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="reportsTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Auteur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#001</td>
                                    <td>Rapport mensuel - Juin 2024</td>
                                    <td>Mensuel</td>
                                    <td>01/06/2024</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#002</td>
                                    <td>Analyse des zones à risque</td>
                                    <td>Spécial</td>
                                    <td>02/06/2024</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#reportsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
            }
        });
    });
</script>
@endpush
@endsection 