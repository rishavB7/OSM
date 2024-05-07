@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="wrapper d-flex ">
    <div>
    @include('layouts.sideNav')
    </div>
    <div class="w-[100vw]">
       <h1 class="text-center text-3xl">DASHBOARD</h1>
       <div class="p-1 flex flex-wrap items-center justify-center">
        <div class="flex-shrink-0 m-6 relative overflow-hidden bg-indigo-400 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
            <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                style="transform: scale(1.5); opacity: 0.1;">
                <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white" />
                <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
            </svg>
            <div class="relative pt-10 px-10 flex items-center justify-center">
                <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                    style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                </div>
            </div>
            <a class="hover:no-underline" href="{{route('listUser')}}">
            <div class="relative text-white px-6 pb-6 mt-6">
                <span class="block  text-2xl -mb-1">Total Users</span>
                <?php
                         use App\Models\User;
                            $totalUsers = User::count();
                            // dd($totalSchemes);
                    ?>
                <div class="flex justify-between">
                    <span class="block font-semibold text-xl mt-3">{{$totalUsers}}</span>
                </div>
            </div>
           </a>
        </div>
            
        <div class="flex-shrink-0 m-6 relative overflow-hidden bg-red-400 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
            <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                style="transform: scale(1.5); opacity: 0.1;">
                <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white" />
                <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
            </svg>
            <div class="relative pt-10 px-10 flex items-center justify-center">
                <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                    style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                </div>
            </div>
            <a class="hover:no-underline" href="{{route('departmentList')}}">
            <div class="relative text-white px-6 pb-6 mt-6">
                <span class="block  text-2xl -mb-1">Total Departments</span>
                <?php
                         use App\Models\Departments;
                            $totalDepts = Departments::on(Session::get('db_conn_name'))->count();
                            // dd($totalSchemes);
                    ?>
                <div class="flex justify-between">
                    <span class="block font-semibold text-xl mt-3">{{$totalDepts}}</span>
                </div>
            </div>
           </a>
        </div>
       </div>     
    </div>
</div>
</div>
@include('layouts.footer')

@endsection