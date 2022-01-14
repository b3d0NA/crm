@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">
                    Users List
                </h6>

                <livewire:users />
            </div>
        </div>
    </div>
</div>
<livewire:user-delete />
@endsection

@push("custom-scripts")
<script>
window.addEventListener("openUserDeleteModal", function() {
    console.log("get it");
    $("#userDeleteModal").modal("show")
});
window.addEventListener("closeUserDeleteModal", function() {
    $("#userDeleteModal").modal("hide")
});
</script>
@endpush