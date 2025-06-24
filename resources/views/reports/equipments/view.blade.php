@extends('layouts.master')
@section('title', 'Select Report')
@section('APP-NAME', 'Select Report')

@section('APP-CONTENT')
    <h2>{{ $title }}</h2>

    @include($view, ['data' => $data])

    <form method="POST" action="{{ route('reports.equipmentReportExport') }}">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">
        <button type="submit">Export as PDF</button>
    </form>



@endsection
