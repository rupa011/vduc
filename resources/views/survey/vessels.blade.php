@extends('layouts.master')
@section('vessel-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Vessel List</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <button type="button" id="addBtn" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                    class="btn btn-primary">Add New</button>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="vessel-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Vessel Name</th>
                            <th>Owner</th>
                            <th>Location</th>
                            <th>IMO Number</th>
                            <th>Home Port</th>
                            <th>Type of Service</th>
                            <th>Year Built</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vessels as $vessel)
                            <tr>
                                <td>{{ $vessel->id }}</td>
                                <td>{{ ucwords($vessel->vessel_name) }}</td>
                                <td>{{ $vessel->vessel_owner }}</td>
                                <td>{{ $vessel->vessel_location }}</td>
                                <td>{{ $vessel->imo_on }}</td>
                                <td>{{ $vessel->home_port }}</td>
                                <td>{{ $vessel->type_of_service }}</td>
                                <td>{{ date('F j, Y', strtotime($vessel->year_built)) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary editBtn" data-id="{{ $vessel->id }}"
                                        data-toggle="modal" data-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $vessel->id }}"
                                        data-toggle="modal" data-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('survey.add_vessel')
    @include('survey.edit_vessel')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let vesselID = null;

            $('.editBtn').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/vessels/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        vesselID = data.id;
                        const editModal = $('#editModal');
                        editModal.find('input[name="vessel_name"]').val(data.vessel_name);
                        editModal.find('input[name="vessel_owner"]').val(data.vessel_owner);
                        editModal.find('input[name="vessel_location"]').val(data.vessel_location);
                        editModal.find('input[name="imo_on"]').val(data.imo_on);
                        editModal.find('input[name="home_port"]').val(data.home_port);
                        editModal.find('input[name="place_of_built"]').val(data.place_of_built);
                        editModal.find('input[name="type_of_service"]').val(data.type_of_service);
                        editModal.find('input[name="length"]').val(data.length);
                        editModal.find('input[name="no_screws"]').val(data.no_screws);
                        editModal.find('input[name="breadth"]').val(data.breadth);
                        editModal.find('input[name="material"]').val(data.material);
                        editModal.find('input[name="depth"]').val(data.depth);
                        editModal.find('input[name="gross_tonnage"]').val(data.gross_tonnage);
                        editModal.find('input[name="engine"]').val(data.engine);
                        editModal.find('input[name="net_tonnage"]').val(data.net_tonnage);
                        editModal.find('input[name="year_built"]').val(data.year_built);
                        editModal.find('input[name="launch_date"]').val(data.launch_date);
                        editModal.find('input[name="horse_power"]').val(data.horse_power);
                        editModal.modal('show');
                    },
                    error: function(err) {
                        console.error('Error fetching vessel data:', err);
                    }
                });
            });

            $('#addModalForm').submit(function(e) {
                e.preventDefault();
                const addModal = $('#addModal');
                setModalMessage(addModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/vessels',
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
                    url: `/vessels/${vesselID}`,
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
