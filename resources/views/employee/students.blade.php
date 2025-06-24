@extends('layouts.master')
@section('diving-active', 'active')
@section('student-active', 'active')
@section('title', 'Students')
@section('APP-CSS')
    <style>
        #applicationsList {
            max-height: 400px;
            /* adjust as needed */
            overflow-y: auto;
            padding-right: 10px;
        }

        #applicationsList::-webkit-scrollbar {
            width: 6px;
        }

        #applicationsList::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        #applicationsList::-webkit-scrollbar-thumb:hover {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>

@endsection
@section('APP-CONTENT')
    <div class="iq-card studentsTableSection">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Student List</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
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
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->contact }}</td>
                                <td>
                                    @if ($student->status === 'Active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ date('F j, Y', strtotime($student->created_at)) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary diversLogsBtn"
                                        data-student-id="{{ $student->id }}" data-toggle="modal"
                                        data-target="#diversLogsModal">
                                        Divers Logs
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modals.view_logs')
    @include('modals.add_logs')
    @include('modals.edit_logs')
@endsection
@section('APP-SCRIPT')
    <script>
        let logID = null;

        $(document).ready(function() {
            $('.diversLogsBtn').on('click', function() {
                var studentId = $(this).data('student-id');
                $('#applicationsList').empty();
                $('#diversLogsSection').addClass('d-none');

                $.ajax({
                    url: '/employee/diving/students/' + studentId + '/applications',
                    method: 'GET',
                    success: function(applications) {
                        if (applications.length > 0) {
                            var filteredApplications = applications.filter(function(app) {
                                return app.status === 'Ongoing' || app.status ===
                                    'Completed';
                            });

                            if (filteredApplications.length > 0) {
                                var content = '';

                                $.each(filteredApplications, function(index, app) {
                                    var statusBadgeClass = 'badge-primary';

                                    content += `
                                        <div class="card shadow-sm mb-3">
                                            <div class="card-body">
                                                <div class="d-flex w-100 justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="card-title mb-1">${app.lesson.lesson_name}</h5>
                                                        <p class="card-text mb-1">
                                                            <small>Application ID: #${app.id}</small>
                                                        </p>
                                                    </div>
                                                    <span class="badge ${statusBadgeClass}">${app.status}</span>
                                                </div>
                                                <div class="mt-3 d-flex justify-content-end">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm mr-2 selectApplicationBtn"
                                                        data-application-id="${app.id}">
                                                        Select Application
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                });

                                $('#applicationsList').html(content);
                            } else {
                                $('#applicationsList').html(
                                    '<p class="text-muted text-center">No Ongoing applications.</p>'
                                );
                            }
                        } else {
                            $('#applicationsList').html(
                                '<p class="text-muted text-center">No applications found.</p>'
                            );
                        }
                    }
                });
            });

            // Load Diver's Logs when an application is selected
            $(document).on('click', '.selectApplicationBtn', function() {
                var applicationId = $(this).data('application-id');

                $('#addDiversLogForm').find('input[name=application_id]').val(
                    applicationId);
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
                                            <td>
                                                <button type="button" class="btn btn-primary editDiversLogBtn"
                                                    data-id="${log.id}">
                                                    Edit Logs
                                                </button>
                                            </td>
                                        </tr>
                                    `;
                                $('#diversLogsTable').append(logRow);
                            });
                        } else {
                            $('#diversLogsTable').html(
                                '<tr><td colspan="6" class="text-muted text-center">No diver\'s logs available.</td></tr>'
                            );
                        }
                    }
                });
            });

            $('.addDiversLog').on('click', function() {
                $('#diversLogsModal').modal('hide');
                setTimeout(function() {
                    $('#addDiversLogModal').modal('show');
                }, 500);
            });

            $(document).on('click', '.editDiversLogBtn', function() {
                $('#diversLogsModal').modal('hide');
                const id = $(this).data('id');
                $.ajax({
                    url: `/divers-logs/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        logID = data.id;
                        const form = $('#editDiversLogForm');
                        form.find('input[name=application_id]').val(data.application_id);
                        form.find('input[name=dive_no]').val(data.dive_no);
                        form.find('input[name=location]').val(data.location);
                        form.find('input[name=depth]').val(data.depth);
                        form.find('input[name=bottom_time]').val(data.bottom_time);
                        form.find('input[name=mins_stop]').val(data.mins_stop);
                        form.find('input[name=time_in]').val(data.time_in);
                        form.find('input[name=time_out]').val(data.time_out);
                        form.find('input[name=tank_start]').val(data.tank_start);
                        form.find('input[name=tank_end]').val(data.tank_end);
                        form.find('input[name=visibility]').val(data.visibility);
                        form.find('input[name=current]').val(data.current);
                        form.find('input[name=weight]').val(data.weight);
                        form.find('input[name=temperature]').val(data.temperature);
                        form.find('input[name=date]').val(data.date);
                        setTimeout(function() {
                            $('#editDiversLogModal').modal('show');
                        }, 500);
                    },
                    error: function(err) {
                        console.error('Error fetching diver log data:', err);
                    }
                });
            });

            $('#addDiversLogForm').submit(function(e) {
                e.preventDefault();
                const addDiversLogModal = $('#addDiversLogModal');
                setModalMessage(addDiversLogModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/divers-logs',
                    method: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            $('#addDiversLogModal').modal('hide');
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

            $('#editDiversLogForm').submit(function(e) {
                e.preventDefault();
                const editDiversLogModal = $('#editDiversLogModal');
                setModalMessage(editDiversLogModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: `/divers-logs/${logID}`,
                    method: 'PUT',
                    data: formData,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            $('#editDiversLogModal').modal('hide');
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => $('.diversLogsBtn').click(), 1000);
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
