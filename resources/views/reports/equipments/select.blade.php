@extends('layouts.master')

@section('title', 'Select Report')
@section('APP-NAME', 'Select Report')
@section('reports-active', 'active')
@section('equipment-report-active', 'active')

@section('APP-CONTENT')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-white">Select Report</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="report-type" class="mr-2">Report Type:</label>
                    <select name="report_type" id="report-type" class="form-control" required>
                        <option value="">-- Select --</option>
                        @foreach ($options as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="report-content" class="mt-4"></div>
            </div>
        </div>
    </div>
@endsection

@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {
            const $select = $('#report-type');
            const $content = $('#report-content');

            $select.on('change', function() {
                const reportType = $(this).val();
                if (!reportType) return;

                $content.html(
                    '<div class="text-center my-3"><div class="spinner-border text-primary" role="status"></div></div>'
                );

                $.ajax({
                    url: `/employee/equipmentReports/render`,
                    method: 'GET',
                    data: { report_type: reportType },
                    success: function(html) {
                        $content.html(html);
                    },
                    error: function(xhr) {
                        $content.html(
                            `<div class="alert alert-danger">Failed to load report: ${xhr.statusText}</div>`
                        );
                    }
                });
            });
        });
    </script>
@endsection
