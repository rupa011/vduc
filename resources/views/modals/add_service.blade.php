{{-- Vessel Service Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Vessel Service</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addModalForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" maxlength="100"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" maxlength="255" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="service_charge" class="form-label">Service Charge</label>
                        <input type="number" class="form-control" id="service_charge" name="service_charge"
                            step="0.01" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Service</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
