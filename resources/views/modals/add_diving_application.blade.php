<!-- Add Application Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Diving Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">Applicant</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="" disabled selected>Select Applicant</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lesson_id">Lesson</label>
                        <select class="form-control" id="lesson_id" name="lesson_id" required>
                            <option value="" disabled selected>Select Lesson</option>
                            @foreach ($lessons as $lesson)
                                <option value="{{ $lesson->id }}">{{ $lesson->lesson_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Application</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
