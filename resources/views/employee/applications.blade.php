@extends('layouts.master')
@section('diving-active', 'active')
@section('applications-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Diving Application List</h4>
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
                            <th>Applicant Name</th>
                            <th>Lesson Name</th>
                            <th>Prerequisite</th>
                            <th>Schedule Date</th>
                            <th>Schedule Time</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($divingApplications as $divingApplication)
                            <tr>
                                <td>{{ $divingApplication->id }}</td>
                                <td>{{ $divingApplication->user->first_name }} {{ $divingApplication->user->last_name }}
                                </td>
                                <td>{{ $divingApplication->lesson->lesson_name }}</td>
                                <td>{{ $divingApplication->lesson->prerequisite ? $divingApplication->lesson->prerequisiteLesson->lesson_name: 'N/A' }}</td>
                                <td>{{ $divingApplication->schedule_date ? date('F j, Y', strtotime($divingApplication->schedule_date)) : 'N/A' }}
                                </td>
                                <td>{{ $divingApplication->schedule_time ? date('h:i A', strtotime($divingApplication->schedule_time)) : 'N/A' }}
                                </td>
                                <td>
                                    @if ($divingApplication->status === 'Pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($divingApplication->status === 'Approved')
                                        <span class="badge badge-success">Approved</span>
                                    @elseif ($divingApplication->status === 'Ongoing')
                                        <span class="badge badge-primary">Ongoing</span>
                                    @elseif ($divingApplication->status === 'Completed')
                                        <span class="badge badge-secondary">Completed</span>
                                    @elseif ($divingApplication->status === 'Rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @else
                                        <span class="badge badge-dark">Unknown</span>
                                    @endif
                                </td>
                                <td>{{ date('F j, Y', strtotime($divingApplication->created_at)) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        @if ($divingApplication->status === 'Pending')
                                            <button type="button" class="btn btn-sm btn-success approveBtn"
                                                data-id="{{ $divingApplication->id }}">
                                                <i class="ri-checkbox-circle-line"></i> Approve
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger rejectBtn"
                                                data-id="{{ $divingApplication->id }}">
                                                <i class="ri-close-circle-line"></i> Reject
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning deleteBtn"
                                                data-id="{{ $divingApplication->id }}">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        @elseif ($divingApplication->status === 'Approved')
                                            <button type="button" class="btn btn-sm btn-primary setScheduleBtn"
                                                data-id="{{ $divingApplication->id }}">
                                                <i class="ri-calendar-2-line"></i> Set Ongoing
                                            </button>
                                        @elseif ($divingApplication->status === 'Ongoing')
                                            <button type="button" class="btn btn-sm btn-secondary setCompleteBtn"
                                                data-id="{{ $divingApplication->id }}">
                                                <i class="ri-flag-2-line"></i> Set Complete
                                            </button>

                                            <button type="button" class="btn btn-sm btn-secondary setNewScheduleBtn"
                                                data-id="{{ $divingApplication->id }}">
                                                <i class="ri-calendar-2-line"></i> Set Schedule
                                            </button>

                                        @elseif ($divingApplication->status === 'Completed')
                                            <button type="button" class="btn btn-sm btn-info viewDiversLogBtn"
                                                data-id="{{ $divingApplication->id }}">
                                                <i class="ri-book-open-line"></i> View Log
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-dark" disabled>
                                                <i class="ri-close-line"></i> No Action
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('modals.add_diving_application')
    @include('modals.action_diving')
    @include('modals.view_logs_application')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.approveBtn, .rejectBtn, .setScheduleBtn, .setCompleteBtn', function() {
                const actionModal = $('#actionModal');
                const actionType = $(this).hasClass('approveBtn') ? 'approve' :
                    $(this).hasClass('rejectBtn') ? 'reject' :
                    $(this).hasClass('setScheduleBtn') ? 'setOngoing' : 'setCompleted';
                const id = $(this).data('id');
                const message = actionType === 'approve' ?
                    // '<i class="ri-alert-line" style="font-size: 3rem; color: #28a745;"></i>' +
                    // '<p class="mt-3 font-weight-bold">Are you sure you want to approve this application?</p>' :
                    '' :
                    actionType === 'reject' ?
                    '<i class="ri-alert-line" style="font-size: 3rem; color: #dc3545;"></i>' +
                    '<p class="mt-3 font-weight-bold">Are you sure you want to reject this application?</p>' :
                    actionType === 'setOngoing' ?
                    '<i class="ri-alert-line" style="font-size: 3rem; color: #007bff;"></i>' +
                    '<p class="mt-3 font-weight-bold">Are you sure you want to mark this application as Ongoing?</p>' :
                    '<i class="ri-alert-line" style="font-size: 3rem; color: #6c757d;"></i>' +
                    '<p class="mt-3 font-weight-bold">Are you sure you want to mark this application as Completed?</p>';

                $('#actionModalMessage').html(message);
                $('#scheduleFields').toggleClass('d-none', actionType !== 'approve');

                // Inside your click handler after determining actionType:
                if (actionType === 'approve') {
                    $('#scheduleFields').removeClass('d-none');
                    $('#schedule_date').prop('disabled', false);
                    $('#schedule_time').prop('disabled', false);
                } else {
                    $('#scheduleFields').addClass('d-none');
                    $('#schedule_date').prop('disabled', true);
                    $('#schedule_time').prop('disabled', true);
                }

                const actionModalMessage = $('#actionModal');
                setModalMessage(actionModalMessage);

                actionModal.off('submit').on('submit', '#actionModalForm', function(e) {
                    e.preventDefault();
                    const scheduleDate = $('#schedule_date').val();
                    const scheduleTime = $('#schedule_time').val();

                    if (actionType === 'approve') {
                        // Enable the fields for validation
                        $('#schedule_date').prop('disabled', false);
                        $('#schedule_time').prop('disabled', false);

                        if (!scheduleDate || !scheduleTime) {
                            alert('Schedule Date and Time are required.');
                            return;
                        }
                    } else {
                        // Disable the fields if not approving
                        $('#schedule_date').prop('disabled', true);
                        $('#schedule_time').prop('disabled', true);
                    }

                    const data = {
                        schedule_date: scheduleDate,
                        schedule_time: scheduleTime
                    };

                    $.ajax({
                        url: `/employee/diving/applications/${id}/${actionType}`,
                        method: 'POST',
                        data: actionType === 'approve' ? data : {},
                        success: function(response) {
                            if (response.success) {
                                actionModal.modal('hide');
                                showContainerMessage(response.message, 'success');
                                setTimeout(() => location.reload(), 1000);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(err) {
                            console.error(`Error performing ${actionType} action:`,
                                err);
                            showModalMessage(
                                'An unexpected error occurred. Please try again.',
                                'error');
                        }
                    });
                });

                actionModal.modal('show');
            });

            // Load Diver's Logs when an application is selected
            $(document).on('click', '.viewDiversLogBtn', function() {
                var applicationId = $(this).data('id');
                $('#diversLogsTable').empty();
                $('#diversLogsSection').removeClass('d-none');

                $.ajax({
                    url: '/employee/diving/applications/' + applicationId + '/divers-logs',
                    method: 'GET',
                    success: function(logs) {
                        if (logs.length > 0) {
                            $.each(logs, function(index, log) {
                                var logRow = `
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td>${log.location}</td>
                                            <td>${log.depth}</td>
                                            <td>${log.bottom_time}</td>
                                            <td>${(new Date(log.date)).toLocaleDateString()}</td>
                                        </tr>
                                    `;
                                $('#diversLogsTable').append(logRow);
                                $('#diversLogsModal').modal('show');
                            });
                        } else {
                            $('#diversLogsTable').html(
                                '<tr><td colspan="6" class="text-muted text-center">No diver\'s logs available.</td></tr>'
                            );
                        }
                    }
                });
            });

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
                    url: `/divingApplications/${id}`,
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

            $('#addModalForm').submit(function(e) {
                e.preventDefault();
                const addModal = $('#addModal');
                setModalMessage(addModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/diving-applications',
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
                            const response = err.responseJSON;
                            if (response && !response.success && response.message) {
                                showModalMessage(response.message, 'error');
                            } else {
                                const errors = response.errors;
                                let errorMessages = '';
                                for (const field in errors) {
                                    errorMessages += `${errors[field].join(', ')}\n`;
                                }
                                showModalMessage(errorMessages, 'error');
                            }
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
