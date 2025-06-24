@section('APP-CSS')
@endsection
<!-- Add User Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0">
            <form id="addModalForm">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white fw-bold" id="addModalLabel">Add User</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label fw-bold">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="middle_name" class="form-label fw-bold">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label fw-bold">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="extension_name" class="form-label fw-bold">Extension Name</label>
                            <input type="text" class="form-control" id="extension_name" name="extension_name">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contact" class="form-label fw-bold">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label fw-bold">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="Employee">Employee</option>
                                <option value="Survey Client">Survey Client</option>
                                <option value="Student">Student</option>
                                <option value="Rental Client">Rental Client</option>
                                <option value="Admin">Admin</option>
                                <option value="Super Admin">Super Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary">Add User</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
