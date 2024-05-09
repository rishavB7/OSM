@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="wrapper d-flex">
        @include('layouts.sideNav')
        <div class="container mt-0 mx-4 my-4">

            {{-- @if (session('success'))
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

            <div class="d-flex justify-content-center  align-items-center">

                <form method="POST" action="{{ route('user_create') }}">
                    @csrf

                    <!-- Short Name -->
                    <div class="form-group w-[24rem]">
                        <label for="name">Short Name
                            <span class="text-xs text-slate-600">(eg. If your name is Manoj Kumar Das then type mkd)</span>
                        </label>

                        <input id="name" class="form-control rounded-md" type="text" name="name"
                            value="{{ old('name') }}" required autofocus autocomplete="name"
                            onchange="generateUsername()" />
                        @error('name')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Designation -->
                    <div class="form-group w-[24rem]">
                        <label for="designation">Designation</label>
                        <input id="designation" class="form-control rounded-md" type="text" name="designation"
                            value="{{ old('designation') }}" required autocomplete="username" />
                        @error('designation')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="form-group w-[24rem]">
                        <label for="role">Role</label>
                        <select class="form-control rounded-md" id="role" name="role" required
                            onchange="generateUsername()">
                            {{-- <option value="">Select User Type</option> --}}
                            <option value="2">DC/SDO (C)</option>
                            <option value="4">CA-TO-DC</option>
                            <option value="5">CEO,ZP</option>
                            <option value="6">DDC</option>
                        </select>
                        @error('role')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- District -->
                    <div class="form-group w-[24rem]">
                        <label for="district">District</label>
                        <select class="form-control rounded-md" id="district" name="district" required
                            onchange="generateUsername()">
                            <option value="">Select District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->district }}</option>
                            @endforeach
                        </select>
                        @error('district')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unique Username -->
                    <div class="form-group w-[24rem]">
                        <label for="email">Username</label>
                        <input id="email" class="form-control rounded-md" type="email" name="email"
                            value="{{ old('email') }}" required autocomplete="username" readonly />
                        @error('email')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mobile -->
                    <div class="form-group w-[24rem]">
                        <label for="mobile">Mobile</label>
                        <input id="mobile" class="form-control rounded-md" type="number" name="mobile"
                            value="{{ old('mobile') }}" required autocomplete="mobile" />
                        @error('mobile')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group w-[24rem]">
                        <label for="password">Password</label>
                        <input id="password" class="form-control rounded-md" type="password" name="password" required
                            autocomplete="new-password" />
                        @error('password')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group w-[24rem]">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" class="form-control rounded-md" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        @error('password_confirmation')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group w-[24rem]">
                        <button type="submit" class="btn btn-primary bg-blue-700 w-[150px]">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection

<script>
    function generateUsername() {
        var name = document.getElementById("name").value.toLowerCase(); // Convert name to lowercase
        var role = document.getElementById("role").value;
        var districtSelect = document.getElementById("district");
        var districtText = districtSelect.options[districtSelect.selectedIndex].text.trim()
            .toLowerCase();
        if (role == 2) {
            role = "dc";
        } else if (role == 4) {
            role = "catodc";
        } else if (role == 5) {
            role = "ceo";
        } else if (role == 6) {
            role = "ddc";
        }

        var username = name.replace(/\s+/g, '') + "_" + role + "_" + districtText.replace(/[^a-zA-Z0-9]/g, '') +
            "@dmdashboard.assam";


        document.getElementById("email").value = username;
    }
</script>
