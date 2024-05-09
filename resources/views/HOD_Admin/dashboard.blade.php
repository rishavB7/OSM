@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="wrapper d-flex ">
        <div>
            @include('layouts.sideNav')
        </div>
        <div class="w-[100vw]">
            @if ($passwordChanged == 0)
                <div id="passwordChangeModal" class="passwordChangeModal">
                    <div class="passwordChangeModal-content">
                        <h2><b>Change Password</b></h2>
                        <br>
                        <form action="{{ route('update_password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Current Password</label>
                                <input class="form-control" type="text" name="old_password"
                                    value="{{ old('old_password') }}" required autofocus autocomplete="old_password" />
                                @error('old_password')
                                    <p class="mt-2 red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input class="form-control" type="password" name="password" value="{{ old('password') }}"
                                    required autofocus autocomplete="password" />
                                @error('password')
                                    <p class="mt-2 red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="text" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" required autofocus
                                    autocomplete="password_confirmation" />
                                @error('password_confirmation')
                                    <p class="mt-2 red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary bg-blue-700 w-[150px]">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <h1 class="text-center text-3xl">DASHBOARD</h1>
            <div class="p-1 flex flex-wrap items-center justify-center">
                <div
                    class="flex-shrink-0 m-6 relative overflow-hidden bg-blue-500 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                        style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8"
                            transform="rotate(-45 159.52 175)" fill="white" />
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)"
                            fill="white" />
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                            style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                        </div>
                    </div>
                    <div class="relative text-white px-6 pb-6 mt-6">
                        <a class="hover:no-underline hover:text-white" href="{{ route('listScheme') }}">
                            <span class="block  text-2xl -mb-1">Total Schemes</span>
                            <div class="flex justify-between">
                                <?php
                                use App\Models\Schemes;
                                $nodalId = Auth::user()->id;
                                $totalSchemes = Schemes::on(Session::get('db_conn_name'))->where('created_by', $nodalId)->count();
                                ?>
                                <span class="block font-semibold text-xl mt-3">{{ $totalSchemes }}</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div
                    class="flex-shrink-0 m-6 relative overflow-hidden bg-yellow-500 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                        style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8"
                            transform="rotate(-45 159.52 175)" fill="white" />
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)"
                            fill="white" />
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                            style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                        </div>
                    </div>
                    <a class="hover:no-underline" href="{{ route('runningSchemesListHod') }}">
                        <div class="relative text-white px-6 pb-6 mt-6">
                            <span class="block  text-2xl -mb-1">Running Schemes</span>
                            <?php
                            $nodalId = Auth::user()->id;
                            $runningSchemes = Schemes::on(Session::get('db_conn_name'))->where('created_by', $nodalId)->where('scheme_status', 0)->count();
                            ?>
                            <div class="flex justify-between">
                                <span class="block font-semibold text-xl mt-3">{{ $runningSchemes }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div
                    class="flex-shrink-0 m-6 relative overflow-hidden bg-green-500 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                        style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8"
                            transform="rotate(-45 159.52 175)" fill="white" />
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)"
                            fill="white" />
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                            style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                        </div>
                    </div>
                    <a class="hover:no-underline" href="{{ route('completedSchemeListHod') }}">
                        <div class="relative text-white px-6 pb-6 mt-6">
                            <span class="block  text-2xl -mb-1">Completed Schemes</span>
                            <?php
                            $nodalId = Auth::user()->id;
                            $completedSchemes = Schemes::on(Session::get('db_conn_name'))->where('created_by', $nodalId)->whereNotNull('completion_year')->count();
                            ?>
                            <div class="flex justify-between">
                                <span class="block font-semibold text-xl mt-3">{{ $completedSchemes }}</span>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
