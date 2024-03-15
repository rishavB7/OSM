<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <header>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </header>
    <nav class="navbar navbar-expand-lg bg-slate-700">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User Management
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('addUser') }}">Create User</a>
                    <a class="dropdown-item" href="{{route('listUser')}}">User List</a>
                    <!-- Add more dropdown items as needed -->
                </div>
            </div>

            <div class="dropdown ml-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Scheme Management
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('listScheme')}}">View Schemes</a>
                    <a class="dropdown-item" href="">N/A</a>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <div class="ml-auto login py-2 ">
                <div class="max-w-xl mx-auto sm:px-6 lg:px-3">
                    <div class=" overflow-hidden shadow-sm ">
                        <div class="p-2 text-white font-bold text-xl">
                            {{ __("You're logged in as DC/SDO") }}
                        </div>
                    </div>
                </div>
            </div>
        </nav>
</x-app-layout>
