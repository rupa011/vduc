@extends('layouts.master')
@section('diving-lessons-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Diving Lesson List</h4>
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
                                <td>{{ $divingLesson->duration_minutes }} Minutes</td>
                                <td>&#8369; {{ number_format($divingLesson->price, 2) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary applyBtn"
                                        data-id="{{ $divingLesson->id }}">Apply</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Apply Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold text-white" id="applyModalLabel">Confirm Application</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="ri-information-line" style="font-size: 3rem; color: #dc3545;"></i>
                    <p class="mt-3 font-weight-bold">Are you sure you want to apply this diving lesson?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary btn-sm confirmApply">Apply</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            let divingLessonID = null;

            $('.applyBtn').on('click', function() {
                const id = $(this).data('id');
                const applyModal = $('#applyModal');
                applyModal.find('.confirmApply').data('id', id);
                setModalMessage(applyModal);
                applyModal.modal('show');
            });

            $('.confirmApply').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/diving-applications/`,
                    method: 'POST',
                    data: {
                        lesson_id: id,
                        user_id: '{{ auth()->user()->id }}',
                    },
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
                            const response = err.responseJSON;
                            if (response && !response.success && response.message) {
                                showModalMessage(response.message, 'error');
                            } else {
                                const errors = response.errors;
                                let errorMessages = '';
                                for (const field in errors) {
                                    errorMessages += `${errors[field].join(', ')}\n`;
                                }
                                showModalMessage(errorMessages, 'error');
                            }
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
