@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push("style")
<style>
.select2-container * {
    z-index: 999999;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">
                    Items List
                </h6>

                <livewire:items />
            </div>
        </div>
    </div>
</div>
@endsection

@push("plugin-scripts")
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script>
window.addEventListener("itemCreatedSuccessfully", function() {
    $("#addItemModal").modal("hide")
});
$("#csvBtn").click(function(e) {
    e.stopPropagation();
    $("#csvFile").click();
    $("#uploadBtn").removeClass("d-none")
})
$("#excelBtn").click(function(e) {
    e.stopPropagation();
    $("#excelFile").click();
    $("#uploadBtn").removeClass("d-none")
})
</script>
@endpush