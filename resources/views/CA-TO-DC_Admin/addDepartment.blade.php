@extends('layouts.app')

@section('title', 'Create Department')
@section('content')
@include('layouts.header')

<div class="d-flex">
    @include('layouts.sideNav')
    <div class="container mt-0 mx-4">
        <h3 class="text-center text-4xl">Create Deparment</h3>

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

            {{-- <a href="{{route('dashboard')}}">
                <button class="btn btn-primary d-inline-block m-2 float-right py-1">Back</button>
            </a> --}}
            

        <form method="POST" action="{{route('addDepartment')}}">
            @csrf
            
            <!-- Name -->
            <div class="form-group px-[20rem]">
                <label for="department_name">Department Name</label>
                <input id="department_name" class="form-control" type="text" name="department_name" value="{{ old('department_name') }}" required autofocus autocomplete="name" />
                @error('department_name')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div> 

            <div class="form-group px-[20rem]">
                <button type="submit" class="btn btn-primary bg-blue-700 w-[150px]">Create</button>
            </div>
        </form>
    </div>
</div>
@include('layouts.footer')
@endsection

