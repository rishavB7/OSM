<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for Navbar */
        /* Navbar background color */
        .navbar {
            background-color: #f8f9fa;
        }

        /* Navbar brand color and style */
        .navbar-brand {
            color: #333;
            font-weight: bold;
        }

        /* Navbar brand color on hover */
        .navbar-brand:hover {
            color: #555;
        }

        /* Navbar link color */
        .navbar-nav .nav-link {
            color: #333;
        }

        /* Navbar link color on hover */
        .navbar-nav .nav-link:hover {
            color: #555;
        }

        /* Navbar active link color */
        .navbar-nav .active>.nav-link {
            color: #007bff;
        }

        /* Navbar toggler icon color */
        .navbar-toggler-icon {
            background-color: #555;
        }

        /* Sticky footer */
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body class="antialiased flex flex-col">
    <div
        class="relative bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="container mx-auto py-6 flex justify-between items-center">
            <div class="flex space-x-5 items-center text-xl">
                <div class="mr-10 flex items-start">
                    <a href="#">Logo</a>
                </div>
                <div class="flex space-x-6">
                    <a href="#">Home</a>
                    <a href="#">About</a>
                    <a href="#">Services</a>
                    <a href="#">Contact</a>
                </div>
            </div>
            @if (Route::has('login'))
                <div class="text-right flex space-x-4 items-center text-lg font-semibold">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary py-2 px-4">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary py-2 px-4">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>

    <div class="flex-1">
        <div class="h-64 bg-white text-center py-10">
            <h1>Main content</h1>
            @yield('home-page')
        </div>
    </div>

    <footer class="bg-gray-200 py-20 text-center">
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>

</body>

</html>
