@extends('layouts.master')
@section('diving-application-active', 'active')
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
                                <td>{{ $divingApplication->lesson->prerequisite ? $divingApplication->lesson->prerequisiteLesson->lesson_name  : 'N/A' }}
                                </td>
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
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        @if ($divingApplication->status === 'Pending')
                                            <button type="button" class="btn btn-sm btn-danger cancelBtn"
                                                data-id="{{ $divingApplication->id }}">
                                                <i class="ri-delete-bin-line"></i> Cancel
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

    <!-- Add Application Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addModalForm">
                    <input type="hidden" class="form-control" id="user_id" name="user_id"
                        value="{{ auth()->user()->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add New Diving Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="lesson_id">Lesson</label>
                            <select class="form-control" id="lesson_id" name="lesson_id" required>
                                <option value="" disabled selected>Select Lesson</option>
                                @foreach ($lessons as $lesson)
                                    <option value="{{ $lesson->id }}">{{ $lesson->lesson_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Application</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Action Button Modal -->
    <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold text-white" id="actionModalLabel">Action Confirmation</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="actionModalForm">
                    <div class="modal-body">
                        <div id="actionModalMessage" class="text-center font-weight-bold mb-3"></div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('modals.view_logs_application')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.cancelBtn', function() {
                const actionModal = $('#actionModal');
                const actionType = 'cancel';
                const id = $(this).data('id');
                const message =
                    '<i class="ri-alert-line" style="font-size: 3rem; color: #dc3545;"></i>' +
                    '<p class="mt-3 font-weight-bold">Are you sure you want to cancel this application?</p>';

                $('#actionModalMessage').html(message);

                const actionModalMessage = $('#actionModal');
                setModalMessage(actionModalMessage);

                actionModal.off('submit').on('submit', '#actionModalForm', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: `/student/divingApplications/${id}/${actionType}`,
                        method: 'POST',
                        data: {},
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
