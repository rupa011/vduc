@extends('layouts.master')
@section('title', 'Diving Report')
@section('APP-NAME', 'Diving Report')
@section('dashboard-active', 'active')
@section('APP-CONTENT')
<div class="row mb-3">
    <form method="GET" action="{{ route('reports.diving') }}">
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
                <a href="{{ route('reports.diving.pdf', request()->query()) }}" class="btn btn-danger">Export PDF</a>
            </div>
        </div>
    </form>
</div>

<!-- The rest remains same -->
<h4>Diving Applications</h4>
<table class="table table-bordered table-sm">
    <thead>
        <tr><th>User</th><th>Lesson</th><th>Status</th><th>Date</th></tr>
    </thead>
    <tbody>
        @foreach ($applications as $app)
        <tr>
            <td>{{ $app->user->first_name }} {{ $app->user->last_name }}</td>
            <td>{{ $app->lesson->lesson_name }}</td>
            <td>{{ $app->status }}</td>
            <td>{{ $app->created_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
