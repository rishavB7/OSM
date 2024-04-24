@extends('layouts.app')


@section('content')
    @include('layouts.header')
    <div class="wrapper d-flex ">
    @include('layouts.sideNav')
    <div class="w-[100vw]">
        <h1 class="text-center text-3xl">ADMIN DASHBOARD</h1>
        <div class="p-1 flex flex-wrap items-center justify-center">
         <div class="flex-shrink-0 m-6 relative overflow-hidden bg-blue-500 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
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
             <div class="d-flex justify-evenly relative text-white px-6 pb-6 mt-6">
                <span class="block  text-2xl -mb-1">Total Users</span>

                <?php
                        use App\Models\User;
                           $totalUsers = User::count();
               ?>
                
                <div class="flex justify-center items-center">
                    <span class="d-flex justify-center block font-semibold text-xl mt-[-0.8rem] bg-blue-700 rounded-[50%] p-[0.8rem] w-[50px]">{{$totalUsers}}</span>
                </div>
            </div>
         </div>
         
         <div class="flex-shrink-0 m-6 relative overflow-hidden bg-yellow-500 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
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
             <div class="d-flex justify-evenly relative text-white px-6 pb-6 mt-6">
                 <span class="block  text-2xl -mb-1">Total District Commissioners</span>

                <?php
                    $totalDCs = User::where('role', 2)->count();
                ?>
                 
                 <div class="flex justify-center items-center">
                     <div class="d-flex justify-center block font-bold text-xl mt-[-0.8rem] bg-yellow-700 rounded-[50%] p-[0.8rem] w-[50px]">{{$totalDCs}}</div>
                 </div>
             </div>
         </div>
         <div class="flex-shrink-0 m-6 relative overflow-hidden bg-green-500 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
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
             <div class="d-flex justify-evenly relative text-white px-6 pb-6 mt-6">
                 <span class="block  text-2xl -mb-1">Total Nodal Officers</span>

                <?php
                    $totalNodalOfcs = User::where('role', 3)->count();
                ?>
                 
                 <div class="d-flex justify-center items-center">
                     <div class="d-flex justify-center block font-semibold text-xl mt-[-0.8rem] bg-green-700 rounded-[50%] p-[0.8rem] w-[50px]">{{$totalNodalOfcs}}</div>
                 </div>
             </div>
         </div>

         <div class="flex-shrink-0 m-6 relative overflow-hidden bg-blue-700 rounded-lg max-w-xs shadow-lg h-40 w-1/3">
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
            <div class="d-flex justify-evenly relative text-white px-6 pb-6 mt-6">
                <div>
                    <span class="block  text-2xl -mb-1">Active Users</span>
                </div>
               <?php
                   $totalActiveUsers = User::where('status', 1)->count();
               ?>
                
                <div class="d-flex justify-center items-center">
                    <div class="d-flex justify-center block font-semibold text-xl mt-[-0.8rem] bg-blue-500 rounded-[50%] p-[0.8rem] w-[50px]">{{$totalActiveUsers}}</div>
                </div>
            </div>
        </div>
        </div>
     </div>
    </div>

@include('layouts.footer')
@endsection

    



