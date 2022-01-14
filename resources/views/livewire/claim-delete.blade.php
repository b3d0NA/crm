<div class="modal fade" id="claimDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if ($isModalOpen)
            <div class="modal-header">
                <h5 class="modal-title">Delete Claim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this claim? This is not recoverable.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button wire:click.prevent="delete()" type="button" class="btn btn-danger">Delete</button>
            </div>
            @endif
        </div>
    </div>
</div>