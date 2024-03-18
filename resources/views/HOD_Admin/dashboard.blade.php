@extends('layouts.app')    

@section('content')
@include('layouts.header')
{{-- @include('layouts.navigation') --}}
 <div class="wrapper" >
    {{-- HOD DASHBOARD --}}
    <nav class="navbar navbar-expand-lg dark:bg-blue-900">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle bg-blue-400 hover:bg-blue-500" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Scheme Management
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('schemeCreate')}}">Create Scheme</a>
                <a class="dropdown-item" href="{{route('listScheme')}}">List Of Schemes</a>
                <a class="dropdown-item" href="">Edit Scheme</a>
                <!-- Add more dropdown items as needed -->
            </div>
        </div>
        <div class="ml-4">
            <button class="btn btn-secondary bg-blue-400 hover:bg-blue-500" type="button">
                Overview
            </button>
        </div>
        <div class="ml-auto login py-2 ">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-3">
                <div class=" overflow-hidden shadow-sm ">
                    <div class="p-2 text-white font-bold text-xl">
                        {{ __("You're logged in as NODAL OFFICER") }}
                    </div>
                </div>
            </div>
        </div>
    
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
    
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>
    
                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </nav>
     
    </div>
@include('layouts.footer')
@endsection

    

