@extends('layouts.master')
@section('title', 'Dashboard')
@section('APP-NAME', 'Dashboard')
@section('dashboard-active', 'active')
@section('APP-CONTENT')
    <div class="row">
        <div class="col-lg-12">
            <h1>Welcome to the Dashboard</h1>
            <p>This is the main content area.</p>
            <div class="card-deck mt-4">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Employees</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $employees }}</h5>
                        <p class="card-text">Total number of employees in the system.</p>
                    </div>
                </div>
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">Students</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $students }}</h5>
                        <p class="card-text">Total number of students in the system.</p>
                    </div>
                </div>
                <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header">Survey Clients</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $surveys }}</h5>
                        <p class="card-text">Total number of survey clients in the system.</p>
                    </div>
                </div>
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">Rental Clients</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $rentals }}</h5>
                        <p class="card-text">Total number of rental clients in the system.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
