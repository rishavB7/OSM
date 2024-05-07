@extends('layouts.app')
@include('layouts.header')
@section('content')
    <div class="wrapper">
        <div class="container">
            <h1>Progress Reports</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Scheme Name</th>
                        <th>Physical Progress</th>
                        <th>Percentage Progress</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($progressReports as $report)
                        <tr>
                            <td>{{ $report->scheme->scheme_name }}</td>
                            <td>{{ $report->physical_progress }}</td>
                            <td>{{ $report->percentage_progress }}%</td>
                            <!-- Add more columns as needed -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@include('layouts.footer')
