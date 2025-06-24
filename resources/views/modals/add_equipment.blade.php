@section('APP-CSS')
@endsection
<!-- Add Equipment Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg border-0">
            <form id="addModalForm">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white fw-bold" id="addModalLabel">Add Equipment</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="equipment_name" class="form-label fw-bold">Equipment Name</label>
                            <input type="text" class="form-control" id="equipment_name" name="equipment_name"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label for="quantity" class="form-label fw-bold">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="" selected disabled>Select Category</option>
                                    <option value="Personal Diving Gear">Personal Diving Gear</option>
                                    <option value="Breathing Apparatus">Breathing Apparatus</option>
                                    <option value="Dive Instruments">Dive Instruments</option>
                                    <option value="Communication & Safety Tools">Communication & Safety Tools</option>
                                    <option value="Specialized Survey Equipment">Specialized Survey Equipment</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="equipment_image">Equipment Image</label>
                                <input id="equipment_image_store" name="equipment_image" type="file" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary">Add Equipment</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
