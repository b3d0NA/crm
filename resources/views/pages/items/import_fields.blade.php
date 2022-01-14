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

                <form class="form-horizontal" method="POST" action="{{ route('items.csv.process') }}">
                    @csrf

                    <table class="table">
                        @foreach ($csv_data as $row)
                        <tr>
                            @foreach ($row as $key => $value)
                            <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        <tr>
                            @foreach ($csv_data[0] as $key => $value)
                            <td>
                                <select class="form-select bg-info" name="fields[{{ $key }}]">
                                    @foreach (["number", "description", "group"] as $db_field)
                                    <option value="{{ $loop->index }}">{{ $db_field }}</option>
                                    @endforeach
                                </select>
                            </td>
                            @endforeach
                        </tr>
                    </table>
                    <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary">
                            Import Data
                        </button>
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