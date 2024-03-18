<div class="relative bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-blue-900 selection:bg-red-500 selection:text-white">
        <div class="container mx-auto py-6 flex justify-between items-center">
            <div class="flex space-x-5 items-center text-xl text-white">
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