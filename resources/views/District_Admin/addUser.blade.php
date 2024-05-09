@extends('layouts.app')

@section('title', 'Create User')
@section('content')
    @include('layouts.header')

    <div class="d-flex">
        @include('layouts.sideNav')
        <div class="container mt-0 mx-4">
            <h3 class="text-center text-4xl">Create User</h3>

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


            <form method="POST" action="{{ route('addUser') }}">
                @csrf

                <!-- Full Name -->
                <div class="form-group w-[24rem]">
                    <label for="fullname">Full Name</label>
                    <input id="fullname" class="form-control rounded-md" type="text" name="fullname" value="{{ old('fullname') }}"
                        required autofocus autocomplete="fullname" />
                    @error('fullname')
                        <p class="mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Short Name -->
                <div class="form-group px-[35rem]">
                    <label for="name">Short Name
                        <span class="text-xs  text-red-600">(eg. If your name is Manoj Kumar Das then type mkd)</span>
                    </label>
                    <input id="name" class="form-control rounded-md" type="text" name="name" value="{{ old('name') }}"
                        required autofocus autocomplete="name" />
                    @error('name')
                        <p class="mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group px-[35rem]">
                    <label for="email">Email</label>
                    <input id="email" class="form-control rounded-md" type="email" name="email" value="{{ old('email') }}"
                        required autocomplete="username" />
                    @error('email')
                        <p class="mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group px-[35rem]">
                    <label for="password">Password</label>
                    <input id="password" class="form-control rounded-md" type="password" name="password" required
                        autocomplete="new-password" />
                    @error('password')
                        <p class="mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group px-[35rem]">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" class="form-control rounded-md" type="password" name="password_confirmation"
                        required autocomplete="new-password" />
                    @error('password_confirmation')
                        <p class="mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mobile -->
                <div class="form-group px-[35rem]">
                    <label for="mobile">Mobile</label>
                    <input id="mobile" class="form-control rounded-md" type="number" name="mobile" value="{{ old('mobile') }}"
                        required autocomplete="mobile" />
                    @error('mobile')
                        <p class="mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="form-group px-[35rem]">
                <label for="role">Role</label>
                <select class="form-control rounded-md" id="role" name="role" required>
                    <option selected disabled>Select User Type</option>
                        <option value="3">Nodal Officer</option>
                </select>
                @error('role')
                    <p class="mt-2">{{ $message }}</p>
                @enderror
            </div> 

                <!-- Role -->
                {{-- <div class="form-group px-[35rem]">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required onchange="setDesignation()">
                        <option selected disabled>Select User Type</option>
                        <option value="3">Nodal Officer</option>
                    </select>
                    @error('role')
                        <p class="mt-2">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Designation -->
                <div class="form-group px-[35rem]">
                    <label for="designation">Designation</label>
                    <input id="designation" class="form-control rounded-md" type="text" name="designation" value="{{old('designation')}}" required autocomplete="username" />
                    @error('designation')
                        <p class="mt-2">{{ $message }}</p>
                    @enderror
                </div>


                {{-- {{dd(asdas)}} --}}
                <!-- Department -->
                <div class="form-group px-[35rem]">
                    <label for="department">Department</label>
                    <select class="form-control rounded-md" id="department_name" name="department_name" required>
                        <option value="" selected disabled>Select User Type</option>
                        @foreach ($department_name as $department)
                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                    @error('department_name')
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

    {{-- <script>
        function setDesignation() {
            var roleSelect = document.getElementById("role");
            var designationInput = document.getElementById("designation");

            if (roleSelect.value === "3") {
                designationInput.value = "Nodal Officer";
                designationInput.disabled = true; 
            } else {
                designationInput.value = ""; 
                designationInput.disabled = false; 
            }
        }
    </script> --}}

@endsection
