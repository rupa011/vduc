<!-- Confirm Rental Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="confirmForm">
            <input type="hidden" name="rental_id" id="confirmRentalId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Rental</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="confirmEquipmentList">
                    <!-- Dynamic equipment list will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
