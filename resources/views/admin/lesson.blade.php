@extends('layouts.master')
@section('diving-active', 'active')
@section('lesson-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Diving Lesson List</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <button type="button" id="addBtn" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                    class="btn btn-primary">Add New</button>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-label="user-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Lesson Name</th>
                            <th>Description</th>
                            <th>Prerequisite</th>
                            <th>Duration</th>
                            <th>Rate</th>
                            <th>Students</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($divingLessons as $divingLesson)
                            <tr>
                                <td>{{ $divingLesson->id }}</td>
                                <td>{{ ucwords($divingLesson->lesson_name) }}</td>
                                <td>{{ $divingLesson->description }}</td>
                                <td>{{ $divingLesson->prerequisiteLesson->lesson_name ?? 'None' }}</td>
                                <td>{{ $divingLesson->duration_minutes }}</td>
                                <td>&#8369; {{ number_format($divingLesson->price, 2) }}</td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <span class="badge bg-success">
                                            {{ $divingLesson->applications()->where('status', 'Approved')->count() }}
                                            Approved
                                        </span>
                                        <span class="badge bg-primary mt-1 mb-1">
                                            {{ $divingLesson->applications()->where('status', 'Ongoing')->count() }} Ongoing
                                        </span>
                                        <span class="badge bg-secondary">
                                            {{ $divingLesson->applications()->where('status', 'Completed')->count() }}
                                            Completed
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $divingLesson->created_at->format('F j, Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary editBtn"
                                        data-id="{{ $divingLesson->id }}">Edit</button>
                                    <button type="button" class="btn btn-danger deleteBtn"
                                        data-id="{{ $divingLesson->id }}">Delete</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modals.add_lesson')
    @include('modals.edit_lesson')
    @include('modals.delete_lesson')
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let divingLessonID = null;

            $('#prerequisite_store').select2({
                placeholder: "Select prerequisite lesson",
                width: '100%'
            });

            $('#prerequisite_update').select2({
                placeholder: "Select prerequisite lesson",
                width: '100%'
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
                    url: `/diving-lessons/${id}`,
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
                const editModal = $('#editModal');
                setModalMessage(editModal);
                $.ajax({
                    url: `/diving-lessons/${id}`,
                    method: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        const data = response.data;
                        divingLessonID = data.id;
                        $('#editModal').find('input[name="lesson_name"]').val(data.lesson_name);
                        $('#editModal').find('textarea[name="description"]').val(data
                            .description);
                        $('#editModal').find('input[name="duration_minutes"]').val(data
                            .duration_minutes);
                        $('#editModal').find('input[name="price"]').val(data.price);
                        $('#editModal').find('select[name="prerequisite"]').val(data
                            .prerequisite_id || '').trigger('change');
                        $('#editModal').modal('show');
                    },
                    error: function(err) {
                        showModalMessage('An unexpected error occurred. Please try again.',
                            'error');
                        console.error('Error fetching diving lesson data:', err);
                    }
                });
            });

            $('#addModalForm').submit(function(e) {
                e.preventDefault();
                const addModal = $('#addModal');
                setModalMessage(addModal);
                const formData = $(this).serialize();
                $.ajax({
                    url: '/diving-lessons',
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
                    url: `/diving-lessons/${divingLessonID}`,
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
