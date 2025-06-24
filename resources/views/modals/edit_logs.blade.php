<!-- Add Diver's Log Modal -->
<div class="modal fade" id="editDiversLogModal" tabindex="-1" aria-labelledby="editDiversLogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editDiversLogModalLabel">Add New Diver's Log</h5>
                <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editDiversLogForm">
                <input type="hidden" name="application_id" id="application_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="diveNo" class="form-label">Dive Number</label>
                            <input type="number" class="form-control" id="diveNo" name="dive_no" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" maxlength="100"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="depth" class="form-label">Depth (m)</label>
                            <input type="number" step="0.01" class="form-control" id="depth" name="depth"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bottomTime" class="form-label">Bottom Time (mins)</label>
                            <input type="number" class="form-control" id="bottomTime" name="bottom_time" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="minsStop" class="form-label">Minutes Stop</label>
                            <input type="number" class="form-control" id="minsStop" name="mins_stop">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="timeIn" class="form-label">Time In</label>
                            <input type="datetime-local" class="form-control" id="timeIn" name="time_in" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="timeOut" class="form-label">Time Out</label>
                            <input type="datetime-local" class="form-control" id="timeOut" name="time_out" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tankStart" class="form-label">Tank Start (psi)</label>
                            <input type="number" class="form-control" id="tankStart" name="tank_start" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tankEnd" class="form-label">Tank End (psi)</label>
                            <input type="number" class="form-control" id="tankEnd" name="tank_end" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="visibility" class="form-label">Visibility (m)</label>
                            <input type="number" class="form-control" id="visibility" name="visibility">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="current" class="form-label">Current (knots)</label>
                            <input type="number" class="form-control" id="current" name="current">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Weight (kg)</label>
                            <input type="number" step="0.01" class="form-control" id="weight"
                                name="weight">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="temperature" class="form-label">Temperature (°C)</label>
                            <input type="number" step="0.01" class="form-control" id="temperature"
                                name="temperature" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Log</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
