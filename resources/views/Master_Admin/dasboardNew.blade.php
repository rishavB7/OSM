@extends('layouts.app')
@include('layouts.header')
@section('content')
    
<div class="flex">
    <!-- Sidebar -->
    <div class="bg-gray-700 text-white w-64 flex flex-col">
            <div class="p-4">
                <h1 class="text-xl font-bold">Master Admin Panel</h1>
            </div>
            <nav class="flex-1">
                <ul class="h-[52rem] space-y-4">
                    <li>
                        <a href="#" class="block py-2 px-4 text-white hover:bg-gray-700">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 text-white hover:bg-gray-700">User Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('user_create') }}" class="block py-2 px-4 text-white hover:bg-gray-700">User Management</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 text-white hover:bg-gray-700">Tables</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 text-white hover:bg-gray-700">Logout</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Content -->
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold mb-4">Welcome to Admin Panel</h1>
            <!-- Your content goes here -->
        </div>
    </div>
    
    @endsection
