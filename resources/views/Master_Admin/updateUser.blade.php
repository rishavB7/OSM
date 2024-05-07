@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="d-flex">
        @include('layouts.sideNav')
        <div class="wrapper">
            <h3 class="text-center text-4xl">Update User</h3>
            <div class="container mt-0 mx-4 my-4">
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
                    <div class="form-group px-[35rem]">
                        <label for="name">Name</label>
                        <input id="name" class="form-control rounded-md" type="text" name="name" value="{{ $user->name }}"
                            required autofocus autocomplete="name" />
                        @error('name')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-group px-[35rem]">
                        <label for="email">Email</label>
                        <input id="email" class="form-control rounded-md" type="email" name="email" value="{{ $user->email }}"
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
                        <input id="mobile" class="form-control rounded-md" type="number" name="mobile" value="{{ $user->mobile }}"
                            required autocomplete="mobile" />
                        @error('mobile')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group px-[35rem]">
                        <button type="submit" class="btn btn-primary bg-blue-700 w-[150px]">Update</button>
                    </div>
                </form>
                
    
            </div>
        </div>
    </div>

    </div>

    @include('layouts.footer')
@endsection
