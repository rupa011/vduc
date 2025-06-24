{{-- Inspection Details Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add Inspection Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editModalForm">
                <input type="hidden" id="vessel_inspection_id" name="vessel_inspection_id"
                    value="{{ $vesselSchedule->inspections->first()->id }}">
                <div class="modal-body">
                    <div id="inspection-container">
                        <div class="row inspection-row" id="inspection-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">Type of inspection <span class="text-danger">*</span></label>
                                    <select name="title" id="title" class="form-control">
                                        <option>Propeller (Blade No. 1)</option>
                                        <option>Propeller (Blade No. 2)</option>
                                        <option>Propeller (Blade No. 3)</option>
                                        <option>Propeller (Blade No. 4)</option>
                                        <option>Propeller Rope Guard</option>
                                        <option>Propeller Nut Case</option>
                                        <option>Rudder</option>
                                        <option>Portside Astern Hull</option>
                                        <option>Starboard Astern Hull</option>
                                        <option>Portside Amid Hull</option>
                                        <option>Starboard Amid Hull</option>
                                        <option>Portside Forward Hull</option>
                                        <option>Starboard Forward Hull</option>
                                        <option>Seachest (Port and Starboard)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <select name="description" id="description" class="form-control">
                                        <option>Damage</option>
                                        <option>Marine Growth</option>
                                        <option>Corrosion</option>
                                        <option>Paint Coating</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="remarks">Remarks <span class="text-danger"></span></label>
                                    <textarea name="remarks" id="remarks" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Inspection Details</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
