@extends('layouts.app')

@section('content')
@include('layouts.header')
<div class="d-flex">
    @include('layouts.sideNav')
    <div class="container mt-0 mx-4 my-4">

        {{-- @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif --}}

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

            <a href="{{route('dashboard')}}">
                <button class="btn btn-primary d-inline-block m-2 float-right py-1">Back</button>
            </a>

            

        <form method="POST" action="{{route('user_create')}}">
            @csrf
            
            <!-- Name -->
            <div class="form-group px-[35rem]">
                <label for="name">Name</label>
                <input id="name" class="form-control rounded-md" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                @error('name')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group px-[35rem]">
                <label for="email">Email</label>
                <input id="email" class="form-control rounded-md" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                @error('email')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group px-[35rem]">
                <label for="password">Password</label>
                <input id="password" class="form-control rounded-md" type="password" name="password" required autocomplete="new-password" />
                @error('password')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group px-[35rem]">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="form-control rounded-md" type="password" name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Designation -->
            <div class="form-group px-[35rem]">
                <label for="designation">Designation</label>
                <input id="designation" class="form-control rounded-md" type="text" name="designation" value="{{old('designation')}}" required autocomplete="username" />
                @error('designation')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div> 

            <!-- Mobile -->
            <div class="form-group px-[35rem]">
                <label for="mobile">Mobile</label>
                <input id="mobile" class="form-control rounded-md" type="number" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" />
                @error('mobile')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="form-group px-[35rem]">
                <label for="role">Role</label>
                <select class="form-control rounded-md" id="role" name="role" required>
                    {{-- <option value="">Select User Type</option> --}}
                        <option value="2">DC/SDO Admin</option>
                        <option value="4">CA-TO-DC</option>
                        <option value="5">CEO,ZP</option>
                        <option value="6">DDC</option>
                </select>
                @error('role')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>
            

            <!-- District -->
            <div class="form-group px-[35rem]">
                <label for="district">District</label>
                <select class="form-control rounded-md" id="district" name="district" required>
                    <option value="">Select District</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->district }}</option>
                    @endforeach
                </select>
                @error('district')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group px-[35rem]">
                <button type="submit" class="btn btn-primary bg-blue-700 w-[150px]">Create</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

@endsection
