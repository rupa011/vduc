@extends('layouts.master')
@section('vessels-active', 'active')
@section('schedule-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Schedule List</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <button type="button" id="addBtn" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                    class="btn btn-primary">Add New</button>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>IMO ON</th>
                            <th>Vessel Name</th>
                            <th>Vessel Location</th>
                            <th>Service Name</th>
                            <th>Schedule Date</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vesselSchedules as $vesselSchedule)
                            @foreach ($vesselSchedule->schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->id }}</td>
                                    <td>{{ $vesselSchedule->imo_on }}</td>
                                    <td>{{ $vesselSchedule->vessel_name }}</td>
                                    <td>{{ $vesselSchedule->vessel_location }}</td>
                                    <td>{{ $schedule->service->service_name }}</td>
                                    <td>{{ date('F j, Y', strtotime($schedule->schedule_date)) }}</td>
                                    <td>
                                        @if ($schedule->status === 'Pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($schedule->status === 'Approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif ($schedule->status === 'Declined')
                                            <span class="badge badge-danger">Declined</span>
                                        @elseif ($schedule->status === 'Completed')
                                            <span class="badge badge-primary">Completed</span>
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>{{ date('F j, Y', strtotime($schedule->created_at)) }}</td>
                                    <td>
                                        @if ($schedule->status === 'Pending')
                                            <!-- Trigger Button -->
                                            <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-4"
                                                data-toggle="modal" data-target="#actionModal{{ $schedule->id }}">
                                                <i class="ri-settings-3-line mr-1"></i> Actions
                                            </button>

                                            <!-- Action Modal -->
                                            <div class="modal fade" id="actionModal{{ $schedule->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="actionModalLabel{{ $schedule->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-0 shadow-sm">
                                                        <div class="modal-header bg-light">
                                                            <h5 class="modal-title"
                                                                id="actionModalLabel{{ $schedule->id }}">
                                                                Manage Schedule #{{ $schedule->id }} |
                                                                {{ $schedule->vessel->vessel_name }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <div
                                                                class="btn-group-vertical d-sm-flex flex-wrap justify-content-center">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary mb-2 mr-2 editBtn"
                                                                    data-id="{{ $schedule->id }}" data-toggle="modal"
                                                                    data-target="#editModal">
                                                                    <i class="ri-edit-line mr-1"></i> Edit
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-outline-danger mb-2 mr-2 deleteBtn"
                                                                    data-id="{{ $schedule->id }}" data-toggle="modal"
                                                                    data-target="#deleteModal">
                                                                    <i class="ri-delete-bin-line mr-1"></i> Delete
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-outline-success mb-2 mr-2 approveBtn"
                                                                    data-id="{{ $schedule->id }}">
                                                                    <i class="ri-checkbox-circle-line mr-1"></i> Approve
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-outline-warning mb-2 mr-2 declineBtn"
                                                                    data-id="{{ $schedule->id }}">
                                                                    <i class="ri-close-circle-line mr-1"></i> Decline
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($schedule->status === 'Approved')
                                            <button type="button" class="btn btn-outline-warning mb-2 mr-2 completeBtn"
                                                data-id="{{ $schedule->id }}">
                                                <i class="ri-close-circle-line mr-1"></i> Set Completed
                                            </button>
                                        @else
                                            <span class="text-muted font-italic">No Actions Available</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modals.add_schedule')
    @include('modals.edit_schedule')
    @include('modals.delete_schedule')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let vesselScheduleID = null;

            $('.deleteBtn').on('click', function() {
                const id = $(this).data('id');
                const deleteModal = $('#deleteModal');
                deleteModal.find('.confirmDelete').data('id', id);
                setModalMessage(deleteModal);
                $('#actionModal' + id).modal('hide');
                deleteModal.modal('show');
            });

            $('.confirmDelete').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/vessel-schedules/${id}`,
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
                $('#actionModal' + id).modal('hide');
                $.ajax({
                    url: `/vessel-schedules/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        vesselScheduleID = data.id;
                        $('#editModal').find('input[name="schedule_date"]').val(data
                            .schedule_date);
                        $('#editModal').find('select[name="status"]').val(data.status);
                        $('#editModal').find('select[name="service_id"]').val(data.service_id);
                        $('#editModal').find('select[name="vessel_id"]').val(data.vessel_id);
                        $('#editModal').modal('show');
                    },
                    error: function(err) {
                        console.error('Error fetching vessel schedule data:', err);
                    }
                });
            });

            $('.approveBtn').on('click', function() {
                const id = $(this).data('id');
                $('#actionModal' + id).modal('hide');
                $.ajax({
                    url: `/employee/vessels/schedules/${id}/approved`,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showContainerMessage(response.message, 'error');
                        }
                    },
                    error: function(err) {
                        console.error('Error approving schedule:', err);
                        showContainerMessage('An unexpected error occurred. Please try again.',
                            'error');
                    }
                });
            });

            $('.declineBtn').on('click', function() {
                const id = $(this).data('id');
                $('#actionModal' + id).modal('hide');
                $.ajax({
                    url: `/employee/vessels/schedules/${id}/declined`,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showContainerMessage(response.message, 'error');
                        }
                    },
                    error: function(err) {
                        console.error('Error declining schedule:', err);
                        showContainerMessage('An unexpected error occurred. Please try again.',
                            'error');
                    }
                });
            });

            $('.completeBtn').on('click', function() {
                const id = $(this).data('id');
                $('#actionModal' + id).modal('hide');
                $.ajax({
                    url: `/employee/vessels/schedules/${id}/completed`,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showContainerMessage(response.message, 'error');
                        }
                    },
                    error: function(err) {
                        console.error('Error declining schedule:', err);
                        showContainerMessage('An unexpected error occurred. Please try again.',
                            'error');
                    }
                });
            });

            $('#addModalForm').submit(function(e) {
                e.preventDefault();
                const addModal = $('#addModal');
                setModalMessage(addModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/vessel-schedules',
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
                    url: `/vessel-schedules/${vesselScheduleID}`,
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
