@extends('layouts.master')
@section('services-active', 'active')
@section('APP-CONTENT')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Service List</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="service-list-page-info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Service Charge</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ ucfirst($service->service_name) }}</td>
                                <td>{{ $service->description }}</td>
                                <td>₱ {{ number_format($service->service_charge, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('APP-SCRIPT')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
