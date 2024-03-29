@extends('layouts.app')
@include('layouts.header')
@section('content')

{{-- @include('layouts.navigation') --}}
 <div class="wrapper" >
    <div class="container">
        @if (session('alert-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('alert-success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session('alert-failed'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('alert-failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <h1 class="text-center">Scheme Entry</h1>
        <form action="{{route('schemeCreate')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="scheme_name">Name of the scheme</label>
                <input type="text" name="scheme_name" id="scheme_name" class="form-control @error('scheme_name') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('scheme_name') }}">
                @error('scheme_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="scheme_description">Scheme Description</label>
                <input type="text" name="scheme_description" id="scheme_description" class="form-control @error('scheme_description') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('scheme_description') }}">
                @error('scheme_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="start_date">Starting Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="end_date">Ending Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                {{-- Add error handling for other fields if needed --}}
            
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary bg-blue-700">Create</button>
                </div>
            </div>
            
            
            
    </form>
     
    </div>
</div>
@include('layouts.footer')
    

@endsection



