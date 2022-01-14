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
                    Add Item
                </h6>

                <form action="{{route('items.store')}}" method="POST">
                    @csrf
                    <div class="m-auto modal-body w-50">
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <i class="link-icon" data-feather="alert-circle"></i>
                            {{$error}}
                        </div>
                        @endforeach
                        <div class="mb-3">
                            <label for="itemNumber" name="number" class="form-label">Item Number:</label>
                            <input type="number" class="form-control" id="itemNumber" name="number">
                        </div>
                        <div class="mb-3">
                            <label for="itemDescription" class="form-label">Item Description:</label>
                            <textarea rows="5" class="form-control" id="itemDescription" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="itemGroup" class="form-label">Item Group:</label>
                            <select name="group" id="itemGroup" class="js-example-basic-single form-select"
                                data-width="100%">
                                @foreach ($groups as $group)
                                <option value="{{$group}}">{{$group}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
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