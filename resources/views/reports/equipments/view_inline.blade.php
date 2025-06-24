<div class="card mt-3 shadow-sm">
    <div class="card-header bg-secondary">
        <h5 class="mb-0 text-white">{{ $title }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('reports.equipmentReportExport') }}" class="mt-3">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <button type="submit" class="btn btn-outline-primary">Export as PDF</button>
        </form>
        @include($view, ['data' => $data])
    </div>
</div>
