@extends('layouts.app')

@section('content')
    @include('layouts.header')
    {{-- @include('layouts.navigation') --}}
    <div class="wrapper">
        <h3 class="text-center text-4xl mt-4">Scheme Information</h3>

        <div class="container">
            @if (session('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert-success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('alert-failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('alert-failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <a href="{{ route('dashboard') }}" class="btn btn-primary d-inline-block m-2 float-right">Dashboard</a>
            <a href="{{ route('listScheme') }}" class="btn btn-primary d-inline-block m-2 float-right">Back</a>

            <div id="print_section">  
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th style="width: 30%">Name of the scheme</th>
                                <td>{{ $scheme_id->scheme_name }}</td>
                            </tr>
                            <tr>
                                <th>Scheme Description</th>
                                <td>{{ $scheme_id->scheme_description }}</td>
                            </tr>
                            <tr>
                                <th>Starting Date</th>
                                <td>{{ $scheme_id->start_date }}</td>
                            </tr>
                            <tr>
                                <th>Ending Date</th>
                                <td>{{ $scheme_id->end_date }}</td>
                            </tr>
                            <tr>
                                <th>Total Budget</th>
                                <td>{{ $scheme_id->budget }}</td>
                            </tr>
                            <tr>
                                <th>Project Coordinator</th>
                                <td>{{ $scheme_id->projectc_coordinator }}</td>
                            </tr>
                            <tr>
                                <th>Physical Progress</th>
                                <td>{{ $scheme_id->physical_progress }}</td>
                            </tr>
                            <tr>
                                <th>% Of Progress</th>
                                <td>{{ $scheme_id->percentage_of_progress }}</td>
                            </tr>
                            <tr>
                                <th>Images</th>
                                <td>
                                    <div class="row">
                                        @foreach(json_decode($scheme_id->images) as $image)
                                            <div class="col-md-4 mb-2">
                                                <img src="{{ asset($image) }}" class="img-thumbnail" alt="Scheme Image">
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
            <button class="btn btn-secondary p-2 mt-3 mb-2" onclick="print_section()">Print</button>
        </div>
    </div>
    {{-- @include('layouts.footer') --}}
    
    <script>
        function print_section() {
            window.print();
        }
    </script>
@endsection
