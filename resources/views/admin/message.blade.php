<div id="message" class="modal fade portfolio" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h2 class="modal-title montserrat-text uppercase fw-bold text-center w-100" id="termsModalLabel">Send Message to Employee</h2>
                <a href="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="section-title">
                            <form id="messageForm">
                                <div class="mb-3">
                                    <label for="employeeSelect" class="form-label">Select Employee</label>
                                    <select class="form-select" id="employeeSelect" name="employee" required>
                                        <option value="">-- Select an Employee --</option>
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="messageInput" class="form-label">Message</label>
                                    <textarea class="form-control" id="messageInput" name="message" rows="4" placeholder="Enter your message" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </form>
                            <div id="formFeedback" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
