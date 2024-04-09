@extends('layouts.app')

@section('content')
    @include('layouts.header')
    {{-- @include('layouts.navigation') --}}
    <div class="wrapper">
        <div class="container">
            <h3 class="text-center text-4xl mt-4">Progress Log</h3>
            <div class="row justify-content-end mb-3">
                <div class="col-auto">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                    <a href="{{ route('listScheme') }}" class="btn btn-primary ml-2">Back</a>
                </div>
            </div>
            <div id="print_section" class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Scheme Title</th>
                                    <th>% Of Progress</th>
                                    <th>Physical Progress</th>
                                    <th>Fund Used</th>
                                    <th>Remaining Budget</th>
                                    <th>Images</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($scheme)
                                    <tr>
                                        <td>{{ $scheme->scheme_name }}</td>
                                        <td>{{ $schemeProgress->percentage_of_progress }}</td>
                                        <td>{{ $schemeProgress->physical_progress }}</td>
                                        <td>{{ $schemeProgress->funds_used }}</td>
                                        <td>{{ $scheme->remaining_budget }}</td>
                                        <td>
                                            <div class="row">
                                                @foreach (json_decode($schemeProgress->images) as $image)
                                                    <div class="col-md-4 mb-3">
                                                        <img src="{{ asset($image) }}" class="img-fluid rounded"
                                                            alt="Scheme Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="6">No scheme details available.</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-auto">
                    <button class="btn btn-secondary p-2 mb-2 mt-2" onclick="print_section()">Print</button>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')

    <script>
        function print_section() {
            window.print();
        }
    </script>
@endsection
