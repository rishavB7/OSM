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
            <a class="hover:no-underline" href="{{route('listNodalScheme')}}">
            <div class="relative text-white px-6 pb-6 mt-6">
                    <span class="block  text-2xl -mb-1">Total Schemes</span>
                    <div class="flex justify-between">
                        <?php
                        use App\Models\Scheme_Supervisor_Map;    
                        use App\Models\Schemes;    
                        $totalSchemes = Scheme_Supervisor_Map::on(Session::get('db_conn_name'))
                            ->join('schemes', 'schemes.id', '=', 'scheme_supervisor_map.scheme_id')
                            ->where('scheme_supervisor_map.supervisor_id', Auth::user()->id)
                            ->count();
                         ?>
                    <span class="block font-semibold text-xl mt-3">{{$totalSchemes}}</span>
                </div>
            </div>
        </a>
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
            <a class="hover:no-underline" href="{{route('runningSchemesList')}}">
            <div class="relative text-white px-6 pb-6 mt-6">
                <span class="block  text-2xl -mb-1">Running Schemes</span>
                <?php
                            $runningSchemes =  Scheme_Supervisor_Map::on(Session::get('db_conn_name'))
                                ->join('schemes', 'schemes.id', '=', 'scheme_supervisor_map.scheme_id')
                                ->where('scheme_supervisor_map.supervisor_id', Auth::user()->id)
                                ->where('schemes.scheme_status', 0) 
                                ->count();
                            
                    ?>
                    
                <div class="flex justify-between">
                    <span class="block font-semibold text-xl mt-3">
                        {{$runningSchemes}}</span> 
                </div>
            </div>
        </a>
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
            <a class="hover:no-underline" href="{{route('completedSchemesList')}}">
            <div class="relative text-white px-6 pb-6 mt-6">
                <span class="block  text-2xl -mb-1">Completed Schemes</span>
                <?php
                            $completedSchemes = Scheme_Supervisor_Map::on(Session::get('db_conn_name'))
                                ->join('schemes', 'schemes.id', '=', 'scheme_supervisor_map.scheme_id')
                                ->where('scheme_supervisor_map.supervisor_id', Auth::user()->id)
                                ->whereNotNull('schemes.completion_year') 
                                ->count();
                    ?>
                <div class="flex justify-between">
                    <span class="block font-semibold text-xl mt-3">{{$completedSchemes}}</span>
                </div>
            </div>
        </a>
        </div>
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
            {{-- <a class="hover:no-underline" href="{{route('departmentList')}}"> --}}
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
           {{-- </a> --}}
        </div>

        <div class="flex-shrink-0 m-6 relative overflow-hidden bg-red-400 rounded-lg max-w-xs shadow-lg h-40 w-[25rem]">
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
           
            <div class="relative text-white px-6 pb-6">
                <span class="block  text-lg font-bold -mb-1">Department-Wise Schemes</span>
              
                <div class="flex justify-between">
                    <span class="block font-semibold text-xl">

                        <form action="{{ route('deptWiseSchemes') }}" onchange="this.submit()">
                            @csrf
                            <label for="filter" class="form-label text-sm"></label>
                            <select name="deptId" class="form-select  rounded-md" id="filter">
                                <?php
                                    $deptNames = Departments::on(Session::get('db_conn_name'))->get();
                                ?>
                    
                                <option value="">Select Department</option>
                                @if ($deptNames->isNotEmpty())
                                    @foreach ($deptNames as $deptName)
                                        <option value="{{ $deptName->id }}">{{ $deptName->department_name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No departments found</option>
                                @endif
                            </select>
                        </form>
                    </span>
                </div>
            </div>
        </div>

       </div>
       {{-- <div>
        <div class="mb-3 px-[40rem]">
            <form action="{{ route('deptWiseSchemes') }}" onchange="this.submit()">
                @csrf
                <label for="filter" class="form-label">Select Department:</label>
                <select name="deptId" class="form-select" id="filter">
                    <?php
                        $deptNames = Departments::on(Session::get('db_conn_name'))->get();
                    ?>
        
                    <option value="">Select</option>
                    @if ($deptNames->isNotEmpty())
                        @foreach ($deptNames as $deptName)
                            <option value="{{ $deptName->id }}">{{ $deptName->department_name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>No departments found</option>
                    @endif
                </select>
            </form>
        </div>
       </div> --}}
    </div>
</div>
@include('layouts.footer')

@endsection