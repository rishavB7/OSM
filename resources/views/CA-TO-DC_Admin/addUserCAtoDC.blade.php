@extends('layouts.app')

@section('title', 'Create User')
@section('content')
    @include('layouts.header')

    <div class="wrapper d-flex">
        @include('layouts.sideNav')
        <div class="container mt-0 mx-4 mb-4">
            <h4 class="text-center text-2xl mt-2">Create User</h4>

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

            <a href="{{ route('dashboard') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right py-1">Back</button>
            </a>
            <div class=" w-100 d-flex justify-content-center  align-items-center">

                <form method="POST" action="{{ route('addUserCAtoDC') }}" class="w-[30%]">
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

                    <!-- SHORT Name -->
                    <div class="form-group w-[24rem]">
                        <label for="name">Short Name
                            <span class="text-xs text-red-600">(eg. If your name is Manoj Kumar Das then type mkd)</span>
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

                    <!-- Mobile -->
                    <div class="form-group w-[24rem]">
                        <label for="mobile">Mobile</label>
                        <input id="mobile" class="form-control rounded-md" type="number" name="mobile"
                            value="{{ old('mobile') }}" required autocomplete="mobile" />
                        @error('mobile')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="form-group w-[24rem]">
                        <label for="role">Role</label>
                        <select class="form-control rounded-md" id="role" name="role" required>
                            <option selected disabled>Select User Type</option>
                            <option value="3">DEPT_HOD</option>
                        </select>
                        @error('role')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div class="form-group w-[24rem]">
                        <label for="department">Department</label>
                        <select class="form-control rounded-md" id="department_name" name="department_name" required
                            onchange="generateUsername()">
                            <option value="" selected disabled>Select User Type</option>
                            @foreach ($department_name as $department)
                                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                        @error('department_name')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                        <p class="text-sm">Department not mentioned? <a href="{{ route('addDepartment') }}"
                                class="text-blue-600">Create department</a></p>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group w-[24rem]">
                        <label for="email">Username</label>
                        <input id="email" class="form-control rounded-md" type="email" name="email"
                            value="{{ old('email') }}" required autocomplete="username" readonly />
                        @error('email')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group w-[24rem]">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input id="password" class="form-control rounded-md" type="password" name="password" required
                                autocomplete="new-password" />
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary bg-blue-700"
                                    onclick="generateRandomPassword()">Generate</button>
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group w-[24rem]">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" class="form-control rounded-md" type="text"
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
    <script>
        function generateUsername() {
            var name = document.getElementById("name").value.toLowerCase(); // Convert name to lowercase

            var dept_select = document.getElementById("department_name");
            var dept = dept_select.options[dept_select.selectedIndex].text.trim()
                .toLowerCase();

            var username = name.replace(/\s+/g, '') + "_" + "hod" + "_" + dept.replace(/[^a-zA-Z0-9]/g, '') +
                "@dmdashboard.nic.in";


            document.getElementById("email").value = username;
        }
    </script>

    <script>
        function generateRandomPassword() {
            // Define characters for the password
            var lowercaseChars = "abcdefghijklmnopqrstuvwxyz";
            var uppercaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var numericChars = "0123456789";
            var specialChars = "!@#$%&*";

            // Define minimum length of the password
            var minLength = 8;

            // Generate random characters for each category
            var lowercaseChar = lowercaseChars[Math.floor(Math.random() * lowercaseChars.length)];
            var uppercaseChar = uppercaseChars[Math.floor(Math.random() * uppercaseChars.length)];
            var numericChar = numericChars[Math.floor(Math.random() * numericChars.length)];
            var specialChar = specialChars[Math.floor(Math.random() * specialChars.length)];

            // Concatenate the characters
            var password = lowercaseChar + uppercaseChar + numericChar + specialChar;

            // Fill remaining characters with random characters from all categories
            var remainingLength = minLength - 4; // Subtracting 4 for the already chosen characters
            var allChars = lowercaseChars + uppercaseChars + numericChars + specialChars;
            for (var i = 0; i < remainingLength; i++) {
                var randomIndex = Math.floor(Math.random() * allChars.length);
                password += allChars[randomIndex];
            }

            // Shuffle the password characters
            password = password.split('').sort(function() {
                return 0.5 - Math.random();
            }).join('');

            // Set generated password to password fields
            document.getElementById("password").value = password;
            document.getElementById("password_confirmation").value = password;
        }
    </script>

@endsection
