<!-- Return Rental Modal -->
<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="returnForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Return Equipment Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="rental_id" name="rental_id">

                    <div id="equipmentItemsContainer">
                        <!-- Dynamically populated equipment items -->
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-save-line"></i> Save Return
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
