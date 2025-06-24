@extends('layouts.master')
@section('dive-logs-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Diving Application List</h4>
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
                                <td>{{ $divingApplication->lesson->prerequisite ? $divingApplication->lesson->prerequisiteLesson->lesson_name : 'N/A' }}
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
                                        <button type="button" class="btn btn-sm btn-info viewDiversLogBtn"
                                            data-id="{{ $divingApplication->id }}">
                                            <i class="ri-book-open-line"></i> View Log
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- View Diver's Log Modal (Text Version) -->
    <div class="modal fade" id="viewDiversLogModal" tabindex="-1" aria-labelledby="viewDiversLogModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="viewDiversLogModalLabel">View Diver's Log</h5>
                    <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Example for each field -->
                        <div class="col-md-6 mb-3">
                            <strong>Dive Number:</strong>
                            <p id="view_dive_no"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Location:</strong>
                            <p id="view_location"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Depth (m):</strong>
                            <p id="view_depth"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Bottom Time (mins):</strong>
                            <p id="view_bottom_time"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Minutes Stop:</strong>
                            <p id="view_mins_stop"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Time In:</strong>
                            <p id="view_time_in"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Time Out:</strong>
                            <p id="view_time_out"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Tank Start (psi):</strong>
                            <p id="view_tank_start"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Tank End (psi):</strong>
                            <p id="view_tank_end"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Visibility (m):</strong>
                            <p id="view_visibility"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Current (knots):</strong>
                            <p id="view_current"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Weight (kg):</strong>
                            <p id="view_weight"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Temperature (°C):</strong>
                            <p id="view_temperature"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Date:</strong>
                            <p id="view_date"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('modals.view_logs_application')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {

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
                                            <td>
                                                <button type="button" class="btn btn-primary viewDiversLog"
                                                    data-id="${log.id}">
                                                    View Logs
                                                </button>
                                            </td>
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

            $(document).on('click', '.viewDiversLog', function() {
                $('#diversLogsModal').modal('hide');
                const id = $(this).data('id');
                $.ajax({
                    url: `/divers-logs/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        // Populate each field in the modal with plain text
                        $('#view_dive_no').text(data.dive_no);
                        $('#view_location').text(data.location);
                        $('#view_depth').text(data.depth);
                        $('#view_bottom_time').text(data.bottom_time);
                        $('#view_mins_stop').text(data.mins_stop);
                        $('#view_time_in').text(data.time_in);
                        $('#view_time_out').text(data.time_out);
                        $('#view_tank_start').text(data.tank_start);
                        $('#view_tank_end').text(data.tank_end);
                        $('#view_visibility').text(data.visibility);
                        $('#view_current').text(data.current);
                        $('#view_weight').text(data.weight);
                        $('#view_temperature').text(data.temperature);
                        $('#view_date').text(data.date);

                        setTimeout(function() {
                            $('#viewDiversLogModal').modal('show');
                        }, 500);
                    },
                    error: function(err) {
                        console.error('Error fetching diver log data:', err);
                    }
                });
            });

        });
    </script>
@endsection
