@extends('layouts.master')
@section('rentals-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Rental List</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pick-Up Date</th>
                            <th>Return Date</th>
                            <th>Items Borrowed</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rentals as $rental)
                            <tr @if ($rental->status === 'Overdue') class="table-danger" @endif>
                                <td>{{ $rental->id }}</td>
                                <td>{{ date('F j, Y', strtotime($rental->pick_up_date)) }}</td>
                                <td>{{ date('F j, Y', strtotime($rental->return_date)) }}</td>
                                <td>
                                    @foreach ($rental->equipment as $equipment)
                                        <span class="badge badge-info">{{ $equipment->equipment_name }} (Qty:
                                            {{ $equipment->pivot->quantity }})</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($rental->status === 'Returned')
                                        <span class="badge badge-success">Returned</span>
                                    @elseif ($rental->status === 'Overdue')
                                        <span class="badge badge-danger">Overdue</span>
                                    @elseif ($rental->status === 'Pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($rental->status === 'Confirmed')
                                        <span class="badge badge-primary">Confirmed</span>
                                    @elseif ($rental->status === 'Released')
                                        <span class="badge badge-info">Released</span>
                                    @elseif ($rental->status === 'Cancelled')
                                        <span class="badge badge-dark">Cancelled</span>
                                    @else
                                        <span class="badge badge-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($rental->status === 'Pending')
                                        <button type="button" class="btn btn-danger cancelBtn"
                                            data-id="{{ $rental->id }}" title="Cancel">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- Add Rental Modal --}}
    <div class="modal fade" id="addRentalModal" tabindex="-1" role="dialog" aria-labelledby="addRentalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> {{-- Widen the modal for better UX --}}
            <form id="addRentalForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRentalModalLabel">Add New Rental</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        {{-- User --}}
                        <div class="form-group" style="display: none;">
                            <label for="user_id">User</label>
                            <input type="text" class="form-control" id="user_id" name="user_id"
                                value="{{ $user->id }}" required>
                        </div>

                        {{-- Dates --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pick_up_date">Pick-Up Date</label>
                                <input type="date" class="form-control" id="pick_up_date" name="pick_up_date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="return_date">Return Date</label>
                                <input type="date" class="form-control" id="return_date" name="return_date" required>
                            </div>
                        </div>

                        {{-- Equipment Selection --}}
                        <div class="form-group">
                            <label for="equipment">Select Equipment</label>
                            <select class="form-control" id="equipment_select" multiple>
                                @foreach ($allEquipment as $item)
                                    <option value="{{ $item->id }}" data-available="{{ $item->quantity }}">
                                        {{ $item->equipment_name }} (Available: {{ $item->quantity }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Dynamic Equipment Quantity Inputs --}}
                        <div id="selectedEquipmentContainer">
                            {{-- JS will populate quantity fields here based on selected equipment --}}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Rental</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let rentalID = null;
            const equipmentSelect = $('#equipment_select');
            const container = $('#selectedEquipmentContainer');

            $('#equipment_select').select2({
                placeholder: "Select equipment",
                width: '100%'
            });

            equipmentSelect.on('change', function() {
                container.empty(); // Clear previous entries

                equipmentSelect.find(':selected').each(function(index, option) {
                    const equipmentId = $(option).val();
                    const equipmentName = $(option).text();
                    const availableQty = $(option).data('available');

                    container.append(`
                        <div class="form-group">
                            <label>${equipmentName}</label>
                            <input
                                type="number"
                                class="form-control"
                                name="equipment[${index}][quantity]"
                                min="1"
                                max="${availableQty}"
                                placeholder="Enter quantity (max ${availableQty})"
                                required
                            >
                            <input type="hidden" name="equipment[${index}][equipment_id]" value="${equipmentId}">
                        </div>
                    `);
                });
            });

            $('.cancelBtn').on('click', function() {
                const rentalId = $(this).data('id');
                const action = 'cancel';

                $.post(`/employee/rentals/${rentalId}/action`, {
                        action: action,
                    })
                    .done(function(response) {
                        showContainerMessage(response.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    })
                    .fail(function(xhr) {
                        showModalMessage(response.message ||
                            'An error occurred.',
                            'error');
                    });
            });

            $('#addRentalForm').submit(function(e) {
                e.preventDefault();
                const addRentalModal = $('#addRentalModal');
                setModalMessage(addRentalModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/rentals',
                    method: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            $('#addRentalModal').modal('hide');
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
                            console.error('Error adding rental:', err);
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
                    url: `/rentals/${rentalID}`,
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
