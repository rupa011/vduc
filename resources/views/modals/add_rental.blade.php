{{-- Add Rental Modal --}}
<div class="modal fade" id="addRentalModal" tabindex="-1" role="dialog" aria-labelledby="addRentalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> {{-- Widen the modal for better UX --}}
        <form id="addRentalForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRentalModalLabel">Add New Rental</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{-- User --}}
                    <div class="form-group">
                        <label for="user_id">User</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dates --}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pick_up_date">Pick-Up Date</label>
                            <input type="date" class="form-control" id="pick_up_date" name="pick_up_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="return_date">Return Date</label>
                            <input type="date" class="form-control" id="return_date" name="return_date" required>
                        </div>
                    </div>

                    {{-- Equipment Selection --}}
                    <div class="form-group">
                        <label for="equipment">Select Equipment</label>
                        <select class="form-control" id="equipment_select" multiple>
                            @foreach ($allEquipment as $item)
                                <option value="{{ $item->id }}" data-available="{{ $item->quantity }}">
                                    {{ $item->equipment_name }} (Available: {{ $item->quantity }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dynamic Equipment Quantity Inputs --}}
                    <div id="selectedEquipmentContainer">
                        {{-- JS will populate quantity fields here based on selected equipment --}}
                    </div>

                    {{-- Remarks --}}
                    <div class="form-group mt-3">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Rental</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
