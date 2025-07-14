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
<div class="table-card">
    <div class="table-responsive">
        <table class="table">
            // ... existing code ...
        </table>
    </div>
</div> 