<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="card-title">Diver's Log for Application #{{ $diversLogs->first()->application_id ?? 'N/A' }}</h4>

        @if ($diversLogs->count())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Location</th>
                            <th>Depth</th>
                            <th>Bottom Time</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diversLogs as $log)
                            <tr>
                                <td>{{ $log->dive_no }}</td>
                                <td>{{ $log->location }}</td>
                                <td>{{ $log->depth }} m</td>
                                <td>{{ $log->bottom_time }} mins</td>
                                <td>{{ $log->date->format('F j, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No diver's logs available for this application.</p>
        @endif

        <button type="button" class="btn btn-secondary mt-3 backToStudentsBtn">Back to Students</button>
    </div>
</div>
