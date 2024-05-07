<div class="antialiased flex flex-col">
    <div class="text-center form-control-lg text-white bg-[#2384c6] rounded-none h-16 flex items-center justify-between">
        <div class="flex">
            <a href="http://localhost:82/git-clone/OSM/public/">
                <img class="w-20 h-auto mr-2" src="https://static.javatpoint.com/fullformpages/images/nic.png"
                    alt="NIC LOGO"></a>
            {{-- <img class="w-10 h-auto mr-2" src="public/image/logo2.png" alt="Assam Government logo"> --}}
            <h3 class="font-weight-bold text-sm mt-1">Online Scheme Monitoring and MIS | Government Of Assam</h3>
            <h3 class="font-weight-bold text-sm ml-[10rem] mt-1">DM Dashboard @Assam</h3>

        </div>
        <div>
            @if (Route::has('login'))
                @auth
                    <div class="text-left flex space-x-4 items-center text-lg font-semibold">
                        @if (Auth::user()->role == 1)
                            <div class="ml-auto login py-2 ">
                                <div class="max-w-xl mx-auto sm:px-6 lg:px-3">
                                    <div class=" overflow-hidden  ">
                                        <div class="p-2 text-white font-bold text-sm">
                                            {{ __("You're logged in as Master Admin") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->role == 2)
                            <div class="ml-auto login py-2 ">
                                <div class="max-w-xl mx-auto sm:px-6 lg:px-3">
                                    <div class=" overflow-hidden  ">
                                        <div class="p-2 text-white font-bold text-sm">
                                            You are logged in as DC/SDO (C)
                                            {{-- {{ __("You're logged in as ") . Auth::user()->name . '  (' . Auth::user()->designation . ')' }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->role == 3)
                            <div class="ml-auto login py-2 ">
                                <div class="max-w-xl mx-auto sm:px-6 lg:px-3">
                                    <div class=" overflow-hidden  ">
                                        <div class="p-2 text-white font-bold text-sm">
                                            You are logged in as Department HOD
                                            {{-- {{ __("You're logged in as ") . Auth::user()->name . '  (' . Auth::user()->designation . ')' }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->role == 4)
                            <div class="ml-auto login py-2 ">
                                <div class="max-w-xl mx-auto sm:px-6 lg:px-3">
                                    <div class=" overflow-hidden  ">
                                        <div class="p-2 text-white font-bold text-sm">
                                            You are logged in as CA-TO-DC
                                            {{-- {{ __("You're logged in as ") . Auth::user()->name . '  (' . Auth::user()->designation . ')' }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->role == 5)
                            <div class="ml-auto login py-2 ">
                                <div class="max-w-xl mx-auto sm:px-6 lg:px-3">
                                    <div class=" overflow-hidden  ">
                                        <div class="p-2 text-white font-bold text-sm">
                                            You are logged in as CEO, ZP
                                            {{-- {{ __("You're logged in as ") . Auth::user()->name . '  (' . Auth::user()->designation . ')' }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (Auth::user()->role == 6)
                            <div class="ml-auto login py-2 ">
                                <div class="max-w-xl mx-auto sm:px-6 lg:px-3">
                                    <div class=" overflow-hidden  ">
                                        <div class="p-2 text-white font-bold text-sm">
                                            You are logged in as DDC
                                            {{-- {{ __("You're logged in as ") . Auth::user()->name . '  (' . Auth::user()->designation . ')' }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endauth
                    @auth
                        <div class="hidden sm:flex sm:items-center sm:ms-6 login-btn">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center w-32 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div class="text font-bold">{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @if (Auth::user()->role === 4)
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                    @endif

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
                @endif

                @auth
                    {{-- @if (Auth::user()->role != 3) --}}
                    <a href="{{ url('/dashboard') }}"
                        class="login-btn px-6 py-2 m-2 text-white bg-indigo-600 rounded-[10px] hover:bg-indigo-500 hover:text-indigo-200">Dashboard</a>
                    {{-- @endif     --}}
                @else
                    <a href="{{ route('login') }}"
                        class="login-btn px-6 py-2 m-2 text-white bg-indigo-600 rounded-[10px] hover:bg-indigo-500 hover:text-indigo-200">Log
                        in</a>

                    {{-- @if (Route::has('register'))
          <a href="{{ route('register') }}" class="btn btn-primary py-2 px-4">Register</a>
          @endif --}}
                @endauth
            </div>
            @endif
        </div>

    </div>
    </div>
