@extends('layouts.master')
@section('title', 'Rental Report')
@section('APP-NAME', 'Rental Report')
@section('dashboard-active', 'active')
@section('APP-CONTENT')
    <div class="row mb-3">
        <form method="GET" action="{{ route('reports.rental') }}">
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
                    <a href="{{ route('reports.rental.pdf', request()->query()) }}" class="btn btn-danger">Export PDF</a>
                </div>
            </div>
        </form>
    </div>

    <h4>Rental Transactions</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client</th>
                <th>Pick-Up</th>
                <th>Return</th>
                <th>Status</th>
                <th>Penalty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->user->first_name }} {{ $rental->user->last_name }}</td>
                    <td>{{ $rental->pick_up_date }}</td>
                    <td>{{ $rental->return_date }}</td>
                    <td>{{ $rental->status }}</td>
                    <td>₱{{ number_format($rental->penalty, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
