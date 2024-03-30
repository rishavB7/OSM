@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="wrapper">
    <h3 class="text-center text-4xl">Update User</h3>
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

            <a href="{{route('listUser')}}">
                <button class="btn btn-primary d-inline-block m-2 float-right ">Back</button>
            </a>
            

        <form method="POST" action="{{ route('updateUser', $user->id) }}">
            @csrf
            @method('PATCH')
            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ $user->name }}" required autofocus autocomplete="name" />
                @error('name')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}" required autocomplete="username" />
                @error('email')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                @error('password')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mobile -->
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input id="mobile" class="form-control" type="number" name="mobile" value="{{ $user->mobile }}" required autocomplete="mobile" />
                @error('mobile')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div>

            
             <!-- Status -->
             {{-- <div class="form-group" id="status">
                <label>Status:</label><br>
                <input type="radio" id="status_active" name="status" value="1"  checked required>
                <label for="status_active">Active</label><br>
                <input type="radio" id="status_inactive" name="status" value="0" required>
                <label for="status_inactive">Inactive</label><br>
            </div>  --}}

                <!-- Role -->
            {{-- <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">Select User Type</option>
                        <option value="2">DC/SDO Admin</option>
                        <option value="3">Nodal Officer</option>
                </select>
                @error('role')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div> --}}

            <!-- District -->
            {{-- <div class="form-group">
                <label for="district">District</label>
                <select class="form-control" id="district" name="district" required>
                    <option value="">Select District</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->district }}</option>
                    @endforeach
                </select>
                @error('district')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div> --}}

            <div class="form-group">
                <button type="submit" class="btn btn-primary bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')
@endsection
