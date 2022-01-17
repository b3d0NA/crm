@extends('layout.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center">Edit Claim</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('claims.update', $claim)}}" class="w-100" id="claimForm">
                    @method("put")
                    @csrf
                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="notes">Notes</label>
                                <textarea name="notes" class="form-control" id="notes"
                                    rows="9">{{$claim->notes}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="inspectionResults">Inspection
                                    Results</label>
                                <textarea name="inspection_results" class="form-control" id="inspectionResults"
                                    rows="9">{{$claim->inspection_results}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="decision" class="form-label">Decision</label>
                                <select name="decision" id="decision" class="form-select" data-width="100%">
                                    @foreach (config('app.decisions') as $decision)
                                    <option @if ($decision==$claim->decision)
                                        selected
                                        @endif value="{{$decision}}">{{$decision}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="itemGroup" class="form-label">Item Group:</label>
                                <select name="product_group" id="itemGroup" class="js-example-basic-single form-select"
                                    data-width="100%">
                                    <option disabled>Select group</option>
                                    @foreach ($groups as $group)
                                    @if (!$claim->product_group)
                                    @endif
                                    <option @if ($group==$claim->product_group)
                                        selected
                                        @endif value="{{$group}}">{{$group}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority:</label>
                                <select name="priority" id="priority" class="form-select" data-width="100%">
                                    @foreach (config('app.priorities') as $prio)
                                    <option @if ($prio==$claim->priority)
                                        selected
                                        @endif value="{{$prio}}">{{$prio}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="actions">Actions</label>
                                <input name="actions" class="form-control" id="actions"
                                    value="{{$claim->actions}}"></input>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="supplier">Supplier</label>
                                <input name="supplier" class="form-control" id="supplier"
                                    value="{{$claim->supplier}}"></input>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="assembled" class="form-label">Assembled</label>
                                <input name="assembled" id="assembled" type="text" class="form-control"
                                    value="{{$claim->assembled}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="returned">Returned?</label>
                                <select name="is_returned" id="returned" class="form-select" data-width="100%">
                                    <option @if ($claim->is_returned == 0)
                                        selected
                                        @endif value="0">No</option>
                                    <option @if ($claim->is_returned == 1)
                                        selected
                                        @endif value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="returned_sales">Returned to sales</label>
                                <select name="is_returned_to_sales" id="returned_sales" class="form-select"
                                    data-width="100%">
                                    <option @if ($claim->is_returned == 0)
                                        selected
                                        @endif value="0">No</option>
                                    <option @if ($claim->is_returned == 1)
                                        selected
                                        @endif value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        @if ($claim->is_escalated)
                        <div class="col-sm-4">
                            <div class="mb-3 bg-danger text-white p-3">
                                <p>
                                    @if ($claim->is_escalated == 1)
                                    This is escalated claim after 14 days
                                    @endif
                                    @if ($claim->is_escalated == 2)
                                    User escalated this report. Solve this ASAP
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
if ($("#itemGroup").length) {
    $("#itemGroup").select2();
}
</script>
@endpush

@push("plugin-scripts")
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush