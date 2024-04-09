@extends('layouts.app')

@section('content')
@include('layouts.header')
        <div class="container">
            <header class="bg-warning text-center py-3">
                <h1>PROGRESS REPORT</h1>
            </header>
            <section class="my-4">
                <div class="form-group">
                    <label for="projectTitle">Project Title:</label>
                    <input type="text" class="form-control" id="projectTitle" placeholder="Enter project title">
                </div>
                <!-- Other form fields for Date, Period Covered, Author(s), and Contributions -->
            </section>
            <section class="my-4">
                <h2 class="bg-dark text-white p-2">A. Activities Performed during the period</h2>
                <!-- Content -->
            </section>
            <section class="my-4">
                <h2 class="bg-dark text-white p-2">B. Problems Encountered and Corrective Actions</h2>
                <!-- Content -->
            </section>
            <section class="my-4">
                <h2 class="bg-dark text-white p-2">C. Planned Activities for Next Period</h2>
                <!-- Content -->
            </section>
            <section class="my-4">
                <h2 class="bg-dark text-white p-2">D. Updated Milestone Completion Forecast</h2>
                <!-- Content -->
            </section>
        </div>

@include('layouts.footer')
@endsection