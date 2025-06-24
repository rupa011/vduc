<!-- Add Vessel Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="editModalForm">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="editModalLabel">Edit Vessel</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vessel_name">Vessel Name</label>
                                <input type="text" class="form-control" name="vessel_name" id="vessel_name" required>
                            </div>
                            <div class="form-group">
                                <label for="vessel_owner">Vessel Owner</label>
                                <input type="text" class="form-control" name="vessel_owner" id="vessel_owner"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="vessel_location">Vessel Location</label>
                                <input type="text" class="form-control" name="vessel_location" id="vessel_location"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="imo_on">IMO Number</label>
                                <input type="text" class="form-control" name="imo_on" id="imo_on" required>
                            </div>
                            <div class="form-group">
                                <label for="home_port">Home Port</label>
                                <input type="text" class="form-control" name="home_port" id="home_port" required>
                            </div>
                            <div class="form-group">
                                <label for="place_of_built">Place of Built</label>
                                <input type="text" class="form-control" name="place_of_built" id="place_of_built"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="type_of_service">Type of Service</label>
                                <input type="text" class="form-control" name="type_of_service" id="type_of_service"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="length">Length</label>
                                <input type="text" class="form-control" name="length" id="length" required>
                            </div>
                            <div class="form-group">
                                <label for="no_screws">Number of Screws</label>
                                <input type="text" class="form-control" name="no_screws" id="no_screws" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="breadth">Breadth</label>
                                <input type="text" class="form-control" name="breadth" id="breadth" required>
                            </div>
                            <div class="form-group">
                                <label for="material">Material</label>
                                <input type="text" class="form-control" name="material" id="material" required>
                            </div>
                            <div class="form-group">
                                <label for="depth">Depth</label>
                                <input type="text" class="form-control" name="depth" id="depth" required>
                            </div>
                            <div class="form-group">
                                <label for="gross_tonnage">Gross Tonnage</label>
                                <input type="text" class="form-control" name="gross_tonnage" id="gross_tonnage"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="engine">Engine</label>
                                <input type="text" class="form-control" name="engine" id="engine" required>
                            </div>
                            <div class="form-group">
                                <label for="net_tonnage">Net Tonnage</label>
                                <input type="text" class="form-control" name="net_tonnage" id="net_tonnage"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="year_built">Year Built</label>
                                <input type="date" class="form-control" name="year_built" id="year_built"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="launch_date">Launch Date</label>
                                <input type="date" class="form-control" name="launch_date" id="launch_date"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="horse_power">Horse Power</label>
                                <input type="text" class="form-control" name="horse_power" id="horse_power"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select class="form-control" name="user_id" id="user_id" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Vessel</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
