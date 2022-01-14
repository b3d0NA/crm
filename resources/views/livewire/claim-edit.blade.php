<div class="modal fade bd-example-modal-xl" id="claimEditModal" tabindex="-1" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Claim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                @if($isModalOpen)
                <form method="post" action="{{route('claim.store')}}" class="w-100" id="claimForm">
                    @csrf
                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="notes">Notes</label>
                                <textarea name="notes" class="form-control" id="notes" rows="9"
                                    wire:model.defer="notes"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="inspectionResults">Inspection Results</label>
                                <textarea name="inspection_results" class="form-control" id="inspectionResults" rows="9"
                                    wire:model.defer="inspection_results"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="decision" class="form-label">Decision</label>
                                <input name="decision" id="decision" type="text" class="form-control"
                                    wire:model.defer="decision">
                                <div class="mb-3">
                                    <label for="itemGroup" class="form-label">Item Group:</label>
                                    <select name="group" id="itemGroup" class="js-example-basic-single form-select"
                                        data-width="100%">
                                        @foreach ($groups as $group)
                                        <option value="{{$group}}">{{$group}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Priority:</label>
                                    <select name="priority" id="priority" class="form-select" data-width="100%">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </form>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>