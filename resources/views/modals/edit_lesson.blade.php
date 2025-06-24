@section('APP-CSS')
@endsection
<!-- Edit Lesson Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg border-0">
            <form id="editModalForm">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white fw-bold" id="editModalLabel">Edit Lesson</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="lesson_name" class="form-label fw-bold">Lesson Name</label>
                            <input type="text" class="form-control" id="lesson_name" name="lesson_name" maxlength="50" required>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="prerequisite" class="form-label fw-bold">Prerequisite Lesson</label>
                            <select class="form-control" id="prerequisite_update" name="prerequisite">
                                <option value="">None</option>
                                @foreach ($divingLessons as $lesson)
                                    <option value="{{ $lesson->id }}">{{ $lesson->lesson_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="duration_minutes" class="form-label fw-bold">Duration (Minutes)</label>
                            <input type="number" class="form-control" id="duration_minutes" name="duration_minutes" required>
                        </div>
                        <div class="col-md-12">
                            <label for="price" class="form-label fw-bold">Rate</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary">Save Lesson</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
