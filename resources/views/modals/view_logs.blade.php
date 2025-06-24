<!-- Divers Logs Modal -->
<div class="modal fade" id="diversLogsModal" tabindex="-1" aria-labelledby="diversLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="diversLogsModalLabel">Select an Application</h5>
                <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="applicationsList" class="list-group">
                    <!-- Applications will be loaded here -->
                </div>
                <div id="diversLogsSection" class="mt-4 d-none">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Diver's Logs</h6>
                        <button class="btn btn-sm btn-outline-primary addDiversLog">Add New Logs</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Location</th>
                                    <th>Depth (m)</th>
                                    <th>Bottom Time (mins)</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="diversLogsTable">
                                <!-- Logs will appear here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
