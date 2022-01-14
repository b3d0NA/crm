@extends('layout.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">Claim Reports list</h6>

                <livewire:claims-list :decisions="$decisions" />
            </div>
        </div>
    </div>
</div>
<livewire:claim-view />
<livewire:claim-edit />
<livewire:claim-delete />
@endsection

@push("modals")
@endpush

@push('custom-scripts')
<script>
$(document).ready(function() {
    window.addEventListener("openClaimViewModal", function() {
        console.log("I am here");
        $("#claimViewModal").modal("show")
    });
    window.addEventListener("closeClaimViewModal", function() {
        $("#claimViewModal").modal("hide")
    });
    window.addEventListener("openClaimEditModal", function() {
        $("#claimEditModal").modal("show")
    });
    window.addEventListener("closeClaimEditModal", function() {
        $("#claimEditModal").modal("hide")
    });
    window.addEventListener("openClaimDeleteModal", function() {
        $("#claimDeleteModal").modal("show")
    });
    window.addEventListener("closeClaimDeleteModal", function() {
        $("#claimDeleteModal").modal("hide")
    });
    if ($("#itemGroup").length) {
        $("#itemGroup").select2();
    }

    $('#claimList').DataTable({
        "searching": false,
        "paging": false,
        "info": false
    });
});
</script>
@endpush

@push("plugin-scripts")
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush