@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush


@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">
                    Import CSV
                </h6>

                <form action="{{route('items.csv.parse')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="m-auto">
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <i class="link-icon" data-feather="alert-circle"></i>
                            {{$error}}
                        </div>
                        @endforeach
                        <div class="mb-3">
                            <label for="file" class="form-label">CSV File:</label>
                            <input type="file" class="form-control" id="file" name="csv_file" accept=".csv">
                        </div>
                    </div>
                    <div class="mb-3 text-center">
                        <input type="submit" class="btn btn-success" value="Upload">
                    </div>
                </form>
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
if ($("#itemGroup").length) {
    $("#itemGroup").select2({
        tags: true
    });
}
</script>
@endpush