@extends('layouts.master')
@section('vessels-active', 'active')
@section('inspection-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Inspection List</h4>
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
                            <th>Completed Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vesselInspections as $vesselInspection)
                            @foreach ($vesselInspection->schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->id }}</td>
                                    <td>{{ $vesselInspection->imo_on }}</td>
                                    <td>{{ $vesselInspection->vessel_name }}</td>
                                    <td>{{ $vesselInspection->vessel_location }}</td>
                                    <td>{{ $schedule->service->service_name }}</td>
                                    <td>{{ date('F j, Y', strtotime($schedule->schedule_date)) }}</td>
                                    <td><span class="badge badge-primary">Completed</span></td>
                                    <td>{{ date('F j, Y', strtotime($schedule->updated_at)) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning mb-2 mr-2 inspectionBtn"
                                            data-id="{{ $schedule->id }}">
                                            <i class="ri-close-circle-line mr-1"></i> Inspection Report
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {

            $('.inspectionBtn').on('click', function() {
                var scheduleId = $(this).data('id');
                window.location.href = `/employee/vessels/inspection/${scheduleId}`;
            });

        });
    </script>
@endsection
