@extends('layouts.app')
@include('layouts.header')
@section('content')

<x-guest-layout>
    <!-- Session Status -->
    
    <x-auth-session-status class="mb-4" :status="session('status')" />
    {{-- @if(session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif --}}


    <form method="POST" action="{{ route('login') }}">
        @csrf

        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 position-relative ">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full "
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <button id="passwordShowBtn" class="passwordShowBtn position-absolute top-9 left-[91%]" onclick="showHidePassword()">
                <svg class="w-6 h-6 text-gray-800 showSVG" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                </svg>  
                <svg class="w-6 h-6 text-gray-800 hideSVG" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z"/>
                    <path d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z"/>
                    <path d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z"/>
                  </svg>                  
              </button>

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
    <div >
        <a href="http://localhost:82/git-clone/OSM/public/">
            <button class="inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-md text-blue-500 uppercase tracking-widest  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</button>
        </a>
    </div
</x-guest-layout>
<script>
    const passwordInput = document.querySelector('#password');
    const passwordShowBtn = document.querySelector('#passwordShowBtn')
    const showSVG = document.querySelector('.showSVG')
    const hideSVG = document.querySelector('.hideSVG')
    passwordShowBtn.addEventListener('click', ()=>{
        passwordInput.type === 'password' ? passwordInput.type = 'text' : passwordInput.type = 'password';
    })

    if(passwordInput.type === 'password'){
        showSVG.style.display = 'block';
        hideSVG.style.display = 'none';
    }else{
        showSVG.style.display = 'none';
        hideSVG.style.display = 'block';
    }

    const showHidePassword = () => {
        event.preventDefault();
        showSVG.style.display !== 'block' ? showSVG.style.display = 'block' : showSVG.style.display = 'none';
        hideSVG.style.display !== 'block' ? hideSVG.style.display = 'block' : hideSVG.style.display = 'none';
    }
</script>
@endsection
