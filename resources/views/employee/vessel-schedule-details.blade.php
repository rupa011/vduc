@extends('layouts.master')
@section('vessels-active', 'active')
@section('inspection-active', 'active')
@section('APP-CONTENT')
    <div class="card shadow-sm border">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h4 class="card-title mb text-white">Vessel Information</h4>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>IMO ON:</strong> {{ $vesselSchedule->imo_on }} |
                            {{ $vesselSchedule->inspections->first()->id }}</p>
                        <p><strong>Vessel Name:</strong> {{ $vesselSchedule->vessel_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Vessel Location:</strong> {{ $vesselSchedule->vessel_location }}</p>
                        <p><strong>Scheduled Date:</strong>
                            {{ date('F j, Y', strtotime($vesselSchedule->schedules->firstWhere('id', $schedule_id)->schedule_date)) }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Vessel Inspection Details</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <button type="button" id="addBtn" class="btn btn-primary" data-toggle="modal"
                            data-target="#addModal" class="btn btn-primary">Add New Inspection Details</button>
                        <a href="/employee/vessels/inspection/{{ $vesselSchedule->id }}/sendVesselInspectionReport" id="printBtn"
                            F class="btn btn-success" class="btn btn-primary">Print Inspection Reports</a>
                    </div>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vesselInspectionDetails as $detail)
                                <tr>
                                    <td>{{ $detail['id'] }}</td>
                                    <td>{{ $detail['title'] }}</td>
                                    <td>{{ $detail['description'] }}</td>
                                    <td>{{ $detail['remarks'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary editBtn" data-id="{{ $detail['id'] }}"
                                            data-toggle="modal" data-target="#editModal">Edit</button>
                                        <button type="button" class="btn btn-danger deleteBtn"
                                            data-id="{{ $detail['id'] }}" data-toggle="modal"
                                            data-target="#deleteModal">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('modals.add_inspection_details')
    @include('modals.edit_inspection_details')
    @include('modals.delete_inspection_details')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let vesselInspectionID = null;

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
                    url: `/vessel-inspections-details/${id}`,
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
                    url: `/vessel-inspections-details/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        vesselInspectionID = data.id;
                        $('#editModal').find('select[name="title"]').val(data.title);
                        $('#editModal').find('select[name="description"]').val(data
                            .description);
                        $('#editModal').find('textarea[name="remarks"]').val(data.remarks);
                        $('#editModal').modal('show');
                    },
                    error: function(err) {
                        console.error('Error fetching inspection detail data:', err);
                    }
                });
            });

            $('#addModalForm').submit(function(e) {
                e.preventDefault();
                const addModal = $('#addModal');
                setModalMessage(addModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/vessel-inspections-details',
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
                    url: `/vessel-inspections-details/${vesselInspectionID}`,
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
