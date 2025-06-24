@extends('layouts.master')
@section('equipments-active', 'active')
@section('rental-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Rental List</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <button type="button" id="addBtn" class="btn btn-primary" data-toggle="modal" data-target="#addRentalModal">
                    Add New Rental
                </button>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
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
                                <td>{{ $rental->user->full_name ?? 'N/A' }}</td>
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
                                        <button type="button" class="btn btn-success confirmBtn"
                                            data-id="{{ $rental->id }}" title="Confirm">
                                            <i class="ri-check-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger cancelBtn"
                                            data-id="{{ $rental->id }}" title="Cancel">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    @elseif ($rental->status === 'Confirmed')
                                        <button type="button" class="btn btn-info releaseBtn" data-id="{{ $rental->id }}"
                                            title="Release">
                                            <i class="ri-send-plane-line"></i>
                                        </button>
                                    @elseif ($rental->status === 'Released')
                                        <button type="button" class="btn btn-primary returnBtn"
                                            data-id="{{ $rental->id }}" title="Return">
                                            <i class="ri-arrow-go-back-line"></i>
                                        </button>
                                    @elseif ($rental->status === 'Overdue')
                                        <button type="button" class="btn btn-danger returnBtn"
                                            data-id="{{ $rental->id }}" title="Return (Overdue)">
                                            <i class="ri-time-line"></i>
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
    @include('modals.action_rental')
    @include('modals.confirm_rental')

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
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
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

            $('.cancelBtn, .releaseBtn').on('click', function() {
                const rentalId = $(this).data('id');
                const action = $(this).hasClass('confirmBtn') ? 'confirm' :
                    $(this).hasClass('cancelBtn') ? 'cancel' :
                    $(this).hasClass('releaseBtn') ? 'release' :
                    'return';

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

            $('.confirmBtn').on('click', function() {
                const rentalId = $(this).data('id');
                $('#confirmRentalId').val(rentalId);
                $('#confirmEquipmentList').empty();

                const confirmModal = $('#confirmModal');
                setModalMessage(confirmModal);

                $.ajax({
                    url: `/employee/rentals/${rentalId}/items`,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        response.items.forEach(item => {
                            const html = `
    <div class="form-group">
        <label>${item.equipment_name} (Max: ${item.quantity})</label>
        <input type="number" class="form-control" name="items[${item.id}][quantity]" min="1"
            max="${item.quantity}" value="${item.quantity}">
        <input type="hidden" name="items[${item.id}][equipment_id]" value="${item.equipment_id}">
    </div>
    `;
                            $('#confirmEquipmentList').append(html);
                        });

                        $('#confirmModal').modal('show');
                    },
                    error: function(xhr) {
                        showModalMessage('An error occurred while fetching rental items.',
                            'error');
                    }
                });
            });

            $('#confirmForm').on('submit', function(e) {
                e.preventDefault();

                const confirmModal = $('#confirmModal');
                setModalMessage(confirmModal); // Clear any previous messages

                const formData = $(this).serializeArray();
                const equipmentData = [];
                $('#equipment option:selected').each(function() {
                    equipmentData.push({
                        equipment_id: $(this).val(),
                        quantity: $(this).data('quantity') ||
                            1 // Default quantity, adjust as needed
                    });
                });
                formData.push({
                    name: 'equipment',
                    value: JSON.stringify(equipmentData)
                });
                const submitButton = $(this).find('button[type="submit"]');

                submitButton.prop('disabled', true).text('Processing...');

                $.ajax({
                    url: '{{ route('rentals.confirm') }}',
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            $('#confirmModal').modal('hide');
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showModalMessage(response.message || 'Something went wrong.',
                                'error');
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
                            console.error('Error confirming rental:', err);
                            showModalMessage('An unexpected error occurred. Please try again.',
                                'error');
                        }
                    },
                    complete: function() {
                        submitButton.prop('disabled', false).text('Confirm');
                    }
                });
            });

            // When clicking Return button
            $('.returnBtn').on('click', function() {
                const rentalId = $(this).data('id');
                $('#rental_id').val(rentalId);

                // Clear previous
                $('#equipmentItemsContainer').empty();

                // Fetch rental equipment items (use your real API route)
                $.get('/employee/rentals/' + rentalId + '/items', function(data) {
                    data.items.forEach(function(item) {
                        const itemHtml = `
    <div class="card mb-3" data-item-id="${item.id}">
        <div class="card-body">
            <h5 class="card-title">${item.equipment_name} (Qty: ${item.quantity})</h5>

            <div class="form-row">
                <div class="form-group col">
                    <label>Okay</label>
                    <input type="number" min="0" class="form-control qty-input" data-item-id="${item.id}"
                        data-max="${item.quantity}" name="statuses[${item.id}][okay]" value="0">
                </div>
                <div class="form-group col">
                    <label>Damaged</label>
                    <input type="number" min="0" class="form-control qty-input" data-item-id="${item.id}"
                        data-max="${item.quantity}" name="statuses[${item.id}][damaged]" value="0">
                </div>
                <div class="form-group col">
                    <label>Lost</label>
                    <input type="number" min="0" class="form-control qty-input" data-item-id="${item.id}"
                        data-max="${item.quantity}" name="statuses[${item.id}][lost]" value="0">
                </div>
            </div>

            <input type="hidden" name="statuses[${item.id}][equipment_id]" value="${item.equipment_id}">
            <small class="text-danger d-none" id="error-${item.id}">Total quantity exceeds rented amount!</small>
        </div>
    </div>
    `;

                        $('#equipmentItemsContainer').append(itemHtml);

                        // Attach input change listener
                        $(document).on('input', `.qty-input[data-item-id="${item.id}"]`,
                            function() {
                                const inputs = $(
                                    `.qty-input[data-item-id="${item.id}"]`);
                                let total = 0;

                                inputs.each(function() {
                                    total += parseInt($(this).val()) || 0;
                                });

                                const max = parseInt($(this).data('max'));

                                if (total > max) {
                                    $(`#error-${item.id}`).removeClass('d-none');
                                } else {
                                    $(`#error-${item.id}`).addClass('d-none');
                                }
                            });
                    });

                    $('#returnModal').modal('show');
                });
            });

            $('#returnForm').on('submit', function(e) {
                e.preventDefault();

                const returnModal = $('#returnModal');
                setModalMessage(returnModal); // Clear any previous messages

                const formData = $(this).serialize();
                const submitButton = $(this).find('button[type="submit"]');

                submitButton.prop('disabled', true).text('Processing...');

                $.ajax({
                    url: '/employee/rentals/' + $('#rental_id').val() + '/return',
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            $('#returnModal').modal('hide');
                            showContainerMessage(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showModalMessage(response.message || 'Something went wrong.',
                                'error');
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
                            console.error('Error returning rental:', err);
                            showModalMessage('An unexpected error occurred. Please try again.',
                                'error');
                        }
                    },
                    complete: function() {
                        submitButton.prop('disabled', false).text('Save Return');
                    }
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
