@extends('layouts.master')
@section('title', 'Send SMS Notification')
@section('APP-NAME', 'Dashboard')
@section('dashboard-active', 'active')
@section('APP-CONTENT')

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h4 class="mb-4">Send SMS to Employee</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.send.sms') }}">
                @csrf

                <div class="mb-3">
                    <label for="employee_id" class="form-label">Select Employee</label>
                    <select class="form-select" name="employee_id" id="employee_id" required>
                        <option value="" disabled selected>-- Choose an Employee --</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}
                                ({{ $employee->contact }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">SMS Message</label>
                    <textarea class="form-control" name="message" id="message" rows="4" placeholder="Enter your message here..."
                        required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Send SMS</button>
            </form>
        </div>
    </div>

@endsection
