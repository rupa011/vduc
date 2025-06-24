@extends('layouts.master')
@section('vessels-active', 'active')
@section('service-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Service List</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <button type="button" id="addBtn" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                    class="btn btn-primary">Add New</button>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="service-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Service Charge</th>
                            <th>Vessels Applied</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ ucfirst($service->service_name) }}</td>
                                <td>{{ $service->description }}</td>
                                <td>₱ {{ number_format($service->service_charge, 2) }}</td>
                                <td>
                                    <span class="badge badge-primary">
                                        {{ $service->schedules_count }} Vessels
                                    </span>
                                </td>
                                <td>{{ $service->created_at->format('F j, Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary editBtn" data-id="{{ $service->id }}"
                                        data-toggle="modal" data-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $service->id }}"
                                        data-toggle="modal" data-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modals.add_service')
    @include('modals.edit_service')
    @include('modals.delete_service')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let serviceID = null;

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
                    url: `/services/${id}`,
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
                    url: `/services/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        serviceID = data.id;
                        $('#editModal').find('input[name="service_name"]').val(data
                            .service_name);
                        $('#editModal').find('textarea[name="description"]').val(data
                            .description);
                        $('#editModal').find('input[name="service_charge"]').val(data
                            .service_charge);
                        $('#editModal').modal('show');
                    },
                    error: function(err) {
                        console.error('Error fetching service data:', err);
                    }
                });
            });

            $('#addModalForm').submit(function(e) {
                e.preventDefault();
                const addModal = $('#addModal');
                setModalMessage(addModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/services',
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
                    url: `/services/${serviceID}`,
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
