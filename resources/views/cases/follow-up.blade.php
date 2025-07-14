@extends('layouts.app')

@section('title', 'Suivi des cas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4">Suivi des cas</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cas en cours de traitement</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="followUpTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Victime</th>
                                    <th>Dernière mise à jour</th>
                                    <th>Prochain rendez-vous</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#001</td>
                                    <td>Mme X</td>
                                    <td>03/06/2024</td>
                                    <td>10/06/2024</td>
                                    <td><span class="badge bg-warning">En cours</span></td>
                                    <td>
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#002</td>
                                    <td>Mme Y</td>
                                    <td>02/06/2024</td>
                                    <td>09/06/2024</td>
                                    <td><span class="badge bg-info">En attente</span></td>
                                    <td>
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i>
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
        $('#followUpTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
            }
        });
    });
</script>
@endpush
@endsection 