@extends('layouts.master')
@section('equipments-active', 'active')
@section('communicationSafetyTools-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Personal Diving Gear List</h4>
            </div>
           <div class="iq-card-header-toolbar d-flex align-items-center">
                <button type="button" id="addBtn" class="btn btn-primary" data-toggle="modal" data-target="#addRentalModal"
                    class="btn btn-primary">Rent</button>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Remaining</th>
                            <th>Rented</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipments as $equipment)
                            <tr>
                                <td>{{ $equipment->id }}</td>
                                <td>
                                    @php
                                        $thumbUrl = $equipment->getFirstMediaUrl('images', 'thumb');
                                    @endphp

                                    @if (!empty($thumbUrl))
                                        <img src="{{ $thumbUrl }}" alt="{{ $equipment->equipment_name }}"
                                            class="img-fluid" style="max-width: 100px;">
                                    @else
                                        <span class="badge badge-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>{{ ucwords($equipment->equipment_name) }}</td>
                                <td>{{ $equipment->quantity }}</td>
                                <td>
                                    @if ($equipment->available_quantity <= 0)
                                        <span class="badge badge-danger">Out of Stock</span>
                                    @elseif($equipment->available_quantity < 3)
                                        <span class="badge badge-warning">Low Stock
                                            ({{ $equipment->available_quantity }})
                                        </span>
                                    @else
                                        <span class="badge badge-success">{{ $equipment->available_quantity }}
                                            Available</span>
                                    @endif
                                </td>
                                <td><span class="badge badge-primary">{{ $equipment->rented_quantity ?? 0 }} Rented</span>
                                </td>
                                <td>
                                    @if ($equipment->status === 'Available')
                                        <span class="badge badge-success">Available</span>
                                    @elseif ($equipment->status === 'inactive')
                                        <span class="badge badge-secondary">Not Available</span>
                                    @else
                                        <span class="badge badge-warning">Unknown</span>
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
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRentalModalLabel">Add New Rental</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
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
                                @foreach ($equipments as $item)
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

                        {{-- Remarks --}}
                        <div class="form-group mt-3">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
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
