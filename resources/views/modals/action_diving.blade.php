<!-- Action Button Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold text-white" id="actionModalLabel">Action Confirmation</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="actionModalForm">
                <div class="modal-body">
                    <div id="actionModalMessage" class="text-center font-weight-bold mb-3"></div>
                    <div id="scheduleFields" class="d-none">
                        <div class="form-group">
                            <label for="schedule_date">Schedule Date</label>
                            <input type="date" class="form-control" id="schedule_date" name="schedule_date" required>
                        </div>
                        <div class="form-group">
                            <label for="schedule_time">Schedule Time</label>
                            <input type="time" class="form-control" id="schedule_time" name="schedule_time" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
