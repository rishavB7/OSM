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

            <a href="{{ route('dashboard') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right">Dashboard</button>
            </a>
    
            <a href="{{ route('listScheme') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right">Back</button>
            </a>
            
            <div id="print_section">  
                <form>
                    <div class="form-group">
                        <label for="scheme_name">Name of the scheme</label>
                        <input type="text" name="scheme_name" id="scheme_name" class="form-control" readonly value="{{ $scheme_id->scheme_name }}">
                    
                        <label for="scheme_description">Scheme Description</label>
                        <input type="text" name="scheme_description" id="scheme_description" class="form-control" readonly value="{{ $scheme_id->scheme_description }}">
                    
                        <label for="start_date">Starting Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" readonly value="{{ $scheme_id->start_date }}" >
                    
                        <label for="end_date">Ending Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" readonly value="{{ $scheme_id->end_date }}">
                        
                        <label for="physical_progress">Physical Progress</label>
                        <input type="text" name="physical_progress" id="physical_progress" class="form-control" readonly value="{{ $scheme_id->physical_progress }}">
    
                        <label for="percentage_of_progress">% Of Progress</label>
                        <input type="number" min="0" max="100" name="percentage_of_progress" id="percentage_of_progress" class="form-control" readonly value="{{ $scheme_id->percentage_of_progress }}">
    
                        <label for="images">Images</label>
                        <div class="row">
                            @foreach(json_decode($scheme_id->images) as $image)
                                <div class="col-md-4">
                                    <img src="{{ asset($image) }}" class="img-thumbnail" alt="Scheme Image">
                                </div>
                            @endforeach
                        </div>
    
                        {{-- Add error handling for other fields if needed --}}
                    </div>
                </form>
            </div>  
            <button class="btn btn-secondary p-2 mb-2" onclick="print_section()">Print</button>
        </div>
    </div>
    @include('layouts.footer')
    
    <script>
        function print_section() {
            window.print();
        }
    </script>
@endsection
