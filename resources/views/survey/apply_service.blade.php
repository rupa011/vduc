{{-- Add Schedule Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="addModalForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="vessel_id">Vessel</label>
                        <select class="form-control" id="vessel_id" name="vessel_id" required>
                            <option value="" disabled selected>Select Vessel</option>
                            @foreach ($vessels as $vessel)
                                <option value="{{ $vessel->id }}">{{ $vessel->vessel_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service_id">Service</label>
                        <select class="form-control" id="service_id" name="service_id" required>
                            <option value="" disabled selected>Select Service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="schedule_date">Schedule Date</label>
                        <input type="date" class="form-control" id="schedule_date" name="schedule_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Schedule</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
