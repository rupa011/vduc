@extends('layouts.master')
@section('equipments-active', 'active')
@section('equipment-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Equipment List</h4>
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
                            <th>Image</th>
                            <th>Equipment Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Remaining</th>
                            <th>Rented</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
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
                                <td>{{ ucwords($equipment->category) }}</td>
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
                                <td>{{ date('F j, Y', strtotime($equipment->created_at)) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary editBtn" data-id="{{ $equipment->id }}"
                                        data-toggle="modal" data-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $equipment->id }}"
                                        data-toggle="modal" data-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modals.add_equipment')
    @include('modals.edit_equipment')
    @include('modals.delete_equipment')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let equipmentID = null;

            $("#equipment_image_store").fileinput({
                theme: "fa", // Use FontAwesome icons (optional)
                showUpload: false, // Hide the 'Upload' button
                showCaption: false, // Hide file caption
                showRemove: false, // Hide file caption
                showCancel: false, // Hide file caption
                browseClass: "btn btn-primary",
                fileActionSettings: {
                    showRemove: false,
                    showZoom: false,
                    showUpload: false,
                },
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"], // Accept images only
                maxFileSize: 2048, // Max 2 MB per image (adjust as needed)
                maxFileCount: 5, // Allow up to 5 files
                previewFileType: "image",
            });

            $("#equipment_image_update").fileinput({
                theme: "fa", // Use FontAwesome icons (optional)
                showUpload: false, // Hide the 'Upload' button
                showCaption: false, // Hide file caption
                showRemove: false, // Hide file caption
                showCancel: false, // Hide file caption
                browseClass: "btn btn-primary" , // Bootstrap button styling
                fileActionSettings: {
                    showRemove: false,
                    showZoom: false,
                    showUpload: false,
                },
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"], // Accept images only
                maxFileSize: 2048, // Max 2 MB per image (adjust as needed)
                maxFileCount: 5, // Allow up to 5 files
                previewFileType: "image",
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
                    url: `/equipments/${id}`,
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
                    url: `/equipments/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        equipmentID = data.id;
                        $('#editModal').find('input[name="equipment_name"]').val(data
                            .equipment_name);
                        $('#editModal').find('input[name="quantity"]').val(data.quantity);
                        $('#editModal').find('select[name="category"]').val(data.category ||
                            '');
                        // Show current image in preview if exists
                        if (data.image) {
                            $('#editImagePreview').html(
                                `<img src='${window.location.origin}/storage/${data.image}' style='max-width:100%;max-height:200px;border:1px solid #ccc;border-radius:5px;' />`
                            );
                        } else {
                            $('#editImagePreview').html(
                                '<span class="text-muted">No Image</span>');
                        }
                        $('#editModal').modal('show');
                    },
                    error: function(err) {
                        console.error('Error fetching equipment data:', err);
                    }
                });
            });

            $('#addModalForm').submit(function(e) {
                e.preventDefault();
                const addModal = $('#addModal');
                setModalMessage(addModal);
                const formData = new FormData(this);
                $.ajax({
                    url: '/equipments',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
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
                        } else if (err.responseJSON && err.responseJSON.message) {
                            // Show backend error message if available
                            showModalMessage(err.responseJSON.message, 'error');
                        } else if (err.responseText) {
                            // Try to show raw response text (may help with debugging)
                            showModalMessage(err.responseText, 'error');
                        } else {
                            console.error('Error adding equipment:', err);
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
                const formData = new FormData(this);
                $.ajax({
                    url: `/equipments/${equipmentID}`,
                    method: 'POST', // Use POST for file upload with _method override
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
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
                        } else if (err.responseJSON && err.responseJSON.message) {
                            // Show backend error message if available
                            showModalMessage(err.responseJSON.message, 'error');
                        } else if (err.responseText) {
                            // Try to show raw response text (may help with debugging)
                            showModalMessage(err.responseText, 'error');
                        } else {
                            console.error('Error updating equipment:', err);
                            showModalMessage('An unexpected error occurred. Please try again.',
                                'error');
                        }
                    }
                });
            });

        });
    </script>
@endsection
