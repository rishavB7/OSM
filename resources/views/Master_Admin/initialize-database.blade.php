@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="wrapper d-flex">
        @include('layouts.sideNav')
        <div class="container mt-0 mx-4 my-4">
            <center>
                <h1 class="text-md mb-3"><b>Initialize Database</b></h1>
            </center>
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

            <div class="d-flex justify-content-center  align-items-center">

                <form method="POST" action="{{ route('initializeDatabase') }}">
                    @csrf
                    <!-- District -->
                    <div class="form-group w-[24rem]">
                        <label for="district">District</label>
                        <select class="form-control rounded-md" id="district" name="district" required>
                            <option value="">Select District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->district }}">{{ $district->district }}</option>
                            @endforeach
                        </select>
                        @error('district')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group w-[24rem]">
                        <button type="submit" class="btn btn-primary bg-blue-700">Initialize</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection
