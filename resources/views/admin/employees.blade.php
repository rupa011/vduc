@extends('layouts.master')
@section('user-active', 'active')
@section('employee-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">User List</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <button type="button" id="addBtn" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add
                    New</button>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->full_name }}</td>
                                <td>{{ $employee->contact }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->status }}</td>
                                <td>{{ date('F j, Y', strtotime($employee->created_at)) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary editBtn" data-id="{{ $employee->id }}"
                                        data-toggle="modal" data-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $employee->id }}"
                                        data-toggle="modal" data-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modals.add_user')
    @include('modals.edit_user')
    @include('modals.delete_user')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let userID = null;

            $('.deleteBtn').on('click', function() {
                const id = $(this).data('id');
                const deleteModal = $('#deleteModal');
                deleteModal.find('.confirmDelete').data('id', id);
                setModalMessage(deleteModal);
                deleteModal.modal('show');
            });

            $('.confirmDelete').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/users/${id}`,
                    method: 'DELETE',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            $('#deleteModal').modal('hide');
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showModalMessage(response.message, 'error');
                        }
                    },
                    error: function(err) {
                        console.error('Error deleting user:', err);
                        showModalMessage('An unexpected error occurred. Please try again.',
                            'error');
                    }
                });
            });

            $('.editBtn').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/users/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        userID = data.id;
                        $('#editModal').find('input[name="first_name"]').val(data.first_name);
                        $('#editModal').find('input[name="middle_name"]').val(data.middle_name);
                        $('#editModal').find('input[name="last_name"]').val(data.last_name);
                        $('#editModal').find('input[name="extension_name"]').val(data
                            .extension_name);
                        $('#editModal').find('input[name="email"]').val(data.email);
                        $('#editModal').find('input[name="contact"]').val(data.contact);
                        $('#editModal').find('select[name="role"]').val(data.role);
                        $('#editModal').find('select[name="status"]').val(data.status);
                        $('#editModal').modal('show');
                    },
                    error: function(err) {
                        console.error('Error fetching employee data:', err);
                    }
                });
            });

            $('#addModalForm').submit(function(e) {
                e.preventDefault();
                const addModal = $('#addModal');
                setModalMessage(addModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/users',
                    method: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            $('#addModal').modal('hide');
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        }
                    },
                    error: function(err) {
                        if (err.status === 422) {
                            const errors = err.responseJSON.errors;
                            let errorMessages = '';
                            for (const field in errors) {
                                errorMessages += `${errors[field].join(', ')}\n`;
                            }
                            showModalMessage(errorMessages, 'error');
                        } else {
                            console.error('Error adding user:', err);
                            showModalMessage('An unexpected error occurred. Please try again.',
                                'error');
                        }
                    }
                });
            });

            $('#editModalForm').submit(function(e) {
                e.preventDefault();
                const editModal = $('#editModal');
                setModalMessage(editModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: `/users/${userID}`,
                    method: 'PUT',
                    data: formData,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            $('#editModal').modal('hide');
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        }
                    },
                    error: function(err) {
                        if (err.status === 422) {
                            const errors = err.responseJSON.errors;
                            let errorMessages = '';
                            for (const field in errors) {
                                errorMessages += `${errors[field].join(', ')}\n`;
                            }
                            showModalMessage(errorMessages, 'error');
                        } else {
                            console.error('Error updating user:', err);
                            showModalMessage('An unexpected error occurred. Please try again.',
                                'error');
                        }
                    }
                });
            });

        });
    </script>
@endsection
