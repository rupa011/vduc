@extends('layouts.master')
@section('title', 'Equipment Report')
@section('APP-NAME', 'Equipment Report')
@section('dashboard-active', 'active')
@section('APP-CONTENT')
    <div class="row mb-3">
        <form method="GET" action="{{ route('reports.equipment') }}">
            <div class="row g-2">
                <div class="col-md-3">
                    <label>User</label>
                    <select name="user_id" class="form-control">
                        <option value="">-- All Users --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>From</label>
                    <input type="date" name="from" value="{{ request('from') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>To</label>
                    <input type="date" name="to" value="{{ request('to') }}" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('reports.equipment.pdf', request()->query()) }}" class="btn btn-danger">Export PDF</a>
                </div>
            </div>
        </form>
    </div>

    <h4>Equipment Inventory</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipment as $item)
                <tr>
                    <td>{{ $item->equipment_name }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="mt-4">Equipment Rental Items</h4>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>Client</th>
                <th>Equipment</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentalItems as $item)
                <tr>
                    <td>{{ $item->rental->user->first_name }} {{ $item->rental->user->last_name }}</td>
                    <td>{{ $item->equipment->equipment_name }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="mt-4">Damaged/Lost Equipment</h4>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>Client</th>
                <th>Equipment</th>
                <th>Status</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $status->rental->user->first_name }} {{ $status->rental->user->last_name }}</td>
                    <td>{{ $status->equipment->equipment_name }}</td>
                    <td>{{ $status->status }}</td>
                    <td>{{ $status->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
