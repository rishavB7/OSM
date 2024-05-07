@extends('layouts.app')

@section('content')
    @include('layouts.header')
    {{-- @include('layouts.navigation') --}}
    <div class="wrapper">
        <div class="container">
            <h3 class="text-center text-4xl mt-4">Progress Log</h3>
            <div class="row justify-content-end mb-3">
                <div class="col-auto">
                    @if (Auth::user()->role == 2)    
            <a href="{{ route('dashboard') }}" class="btn btn-primary d-inline-block m-2 float-right">Dashboard</a>
            @endif
                    <a href="{{ route('listScheme') }}" class="btn btn-primary ml-2 mt-2">Back</a>
                </div>
                <a onclick="raise_query()">
                    <button type="submit" class="btn btn-group-sm btn-dark bg-dark mt-2">Raise Querry</button>
                  </a> 
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
                                {{-- {{dd($scheme)}} --}}
                                {{-- @if ($scheme) --}}
                                <tr>
                                    <td>{{ $schemeProgress->scheme->scheme_name }}</td>
                                    <td>{{ $schemeProgress->percentage_of_progress }}</td>
                                    <td>{{ $schemeProgress->physical_progress }}</td>
                                    <td>{{ $schemeProgress->funds_used }}</td>
                                    <td>{{ $schemeProgress->scheme->remaining_budget }}</td>
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
                                {{-- @else
                                    <tr>
                                        <td colspan="6">No scheme details available.</td>
                                    </tr>
                                @endif --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role == 2 || Auth::user()->role == 4 || Auth::user()->role == 5 || Auth::user()->role == 6)

            {{-- <div class="row justify-content-start mb-3 mt-2">
                <div class="col-auto">
                    <input type="checkbox" id="unlock_query_section" onclick="toggleQuerySection()">
                    <label for="unlock_query_section">Raise Query</label>
                </div>
            </div> --}}

            
            
            <script>
                // href="{{route("messages.create")}}"
                function raise_query() {
                    let curr_schemeId = window.location.pathname.substring(window.location.pathname.indexOf('/log') + 5);
                    window.location.href ="{{route("messages.create")}}" + "?schemeId=" + curr_schemeId;
                }
        
            </script>
            
            {{-- <div id="query_section" style="display: none;">
                <form action="{{ route('progressLog' ,$schemeProgress->id) }}" method="post">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="pending_queries">Query</label>
                        <textarea name="pending_queries" id="pending_queries" placeholder="text..."
                            class="form-control @error('pending_queries') is-invalid @enderror"
                            aria-describedby="helpId" rows="4">{{ old('pending_queries') }}</textarea>
                        @error('pending_queries')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                            class="w-80 form-control form-control-sm @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary bg-blue-700">Send</button>
                    </div>
                </form>
            </div> --}}
            @endif
           
            <div class="row justify-content-end">
                <div class="col-auto">
                    <button class="btn btn-secondary p-2 mb-2 mt-2" onclick="print_section()">Print</button>
                </div>
            </div>
           
        </div>
    </div>
    {{-- @include('layouts.footer') --}}

    <script>
        function print_section() {
            window.print();
        }

        function toggleQuerySection() {
            var querySection = document.getElementById('query_section');
            var checkbox = document.getElementById('unlock_query_section');
            if (checkbox.checked) {
                querySection.style.display = 'block';
            } else {
                querySection.style.display = 'none';
            }
        }
    </script>
@endsection
