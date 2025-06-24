<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold text-white" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="ri-alert-line" style="font-size: 3rem; color: #dc3545;"></i>
                <p class="mt-3 font-weight-bold">Are you sure you want to delete this service?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger btn-sm confirmDelete">Delete</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
