@extends('layouts.app') 
@include('layouts.header')   
{{-- @include('layouts.menu') --}}
@section('content')
 <div class="wrapper" >
     @include('layouts.carousel')
    </div>
@include('layouts.footer')
@endsection




 {{-- @extends('layouts.app')
 @include('layouts.header')
 @section('content')
 
 
 <x-guest-layout>
     <!-- Session Status -->
     <x-auth-session-status class="mb-4" :status="session('status')" />
 
     <div class="carousel-inner">
         <!-- Carousel slide with login form -->
         <div class="carousel-item active">
             <div class="container">
                 <form method="POST" action="{{ route('login') }}">
                     @csrf
 
                     <!-- Email Address -->
                     <div>
                         <x-input-label for="email" :value="__('Email')" />
                         <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                         <x-input-error :messages="$errors->get('email')" class="mt-2" />
                     </div>
 
                     <!-- Password -->
                     <div class="mt-4">
                         <x-input-label for="password" :value="__('Password')" />
 
                         <x-text-input id="password" class="block mt-1 w-full"
                                         type="password"
                                         name="password"
                                         required autocomplete="current-password" />
 
                         <x-input-error :messages="$errors->get('password')" class="mt-2" />
                     </div>
 
                     <!-- Remember Me -->
                     <div class="block mt-4">
                         <label for="remember_me" class="inline-flex items-center">
                             <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                             <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                         </label>
                     </div>
 
                     <div class="flex items-center justify-end mt-4">
                         @if (Route::has('password.request'))
                             <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                 {{ __('Forgot your password?') }}
                             </a>
                         @endif
 
                         <x-primary-button class="ms-3">
                             {{ __('Log in') }}
                         </x-primary-button>
                     </div>
                 </form>   
             </div>
         </div>
 
         <!-- Other carousel slides -->
         <div class="carousel-item">
             <!-- Add other carousel content here if needed -->
         </div>
     </div>
     
     <div >
         <a href="http://localhost:82/git-clone/OSM/public/">
             <button class="inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-md text-blue-500 uppercase tracking-widest  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</button>
         </a>
     </div>
    </x-guest-layout>
 @include('layouts.footer')
 @endsection --}}
 