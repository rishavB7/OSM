@extends('layouts.app')
@include('layouts.header')
@section('content')
    {{-- @include('layouts.navigation') --}}
    <div class="wrapper d-flex">
        @include('layouts.sideNav')
        <div class="container h-[80vh] d-flex flex-md-column lg:pt-5 lg:px-72 ">
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


            <h1 class="text-center text-2xl">Scheme Entry</h1>

            <form action="{{ route('schemeCreate') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="scheme_name">Name of the scheme</label>
                    <input type="text" name="scheme_name" id="scheme_name" placeholder="Enter scheme name"
                        class="w-96 form-control  @error('scheme_name') is-invalid @enderror" placeholder=""
                        aria-describedby="helpId" value="{{ old('scheme_name') }}">
                    @error('scheme_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    {{-- <label for="scheme_description">Scheme Description</label>
                <input type="text" name="scheme_description" id="scheme_description" class="form-control @error('scheme_description') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('scheme_description') }}">
                @error('scheme_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror --}}

                    <label for="scheme_description">Scheme Description</label>
                    <textarea name="scheme_description" id="scheme_description" placeholder="scheme description"
                        class="form-control @error('scheme_description') is-invalid @enderror" aria-describedby="helpId" rows="4">{{ old('scheme_description') }}</textarea>
                    @error('scheme_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror


                    {{-- <label for="start_date">Starting Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="end_date">Ending Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror --}}

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Start Date -->
                            <div class="form-group">
                                <label for="start_date" class="form-label">Starting Date</label>
                                <div class="input-group input-group-sm">
                                    
                                    <input type="date" name="start_date" id="start_date"
                                        class="w-80 form-control form-control-sm @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- End Date -->
                            <div class="form-group">
                                <label for="end_date" class="form-label">Ending Date</label>
                                <div class="input-group input-group-sm">
                                    <input type="date" name="end_date" id="end_date"
                                        class="form-control form-control-sm @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Budget -->
                            <div class="form-group">
                                <label for="budget" class="form-label">Budget</label>
                                <div class="input-group input-group-sm">
                                    
                                    <input type="number" name="budget" id="budget" placeholder="Enter budget amount" min="0"
                                        class="w-80 form-control form-control-sm @error('budget') is-invalid @enderror"
                                        value="{{ old('budget') }}">
                                    @error('budget')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Supervisor -->
                            <div class="form-group">
                                <label for="supervisor">Supervisor</label>
                                <select class="form-control rounded-md" id="supervisor" name="supervisor" required>
                                    <option selected disabled>Select Supervisor</option>
                                        {{-- <option value="2">DC</option>
                                        <option value="5">CEO,ZP</option>
                                        <option value="6">DDC</option> --}}
                                        @foreach ($supervisors as $supervisor)
                                        <option value="{{$supervisor->user_id}}">{{$supervisor->name}} ({{$supervisor->designation}}) </option> 
                                        @endforeach
                                </select>
                                @error('supervisor')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div> 
                            
                        </div>
                        <div class="col-md-6">
                            <!-- Project Manager -->
                            <div class="form-group">
                                <label for="projectc_coordinator" class="form-label">Project Coordinator</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="projectc_coordinator" id="projectc_coordinator" placeholder="Enter project coordinator name"
                                        class="form-control form-control-sm @error('projectc_coordinator') is-invalid @enderror"
                                        value="{{ old('projectc_coordinator') }}">
                                    @error('projectc_coordinator')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Add error handling for other fields if needed --}}

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary bg-blue-700 w-[150px]">Create</button>
                    </div>
                </div>
            </form>
            <a href="{{ route('listScheme') }}">
                <button class="btn btn-primary float-right mt-[-4.4rem]">Back</button>
            </a>
        </div>
    </div>
    @include('layouts.footer')
@endsection