<?php
    use App\Models\SchemeProgress;
    use App\Models\User;
    use App\Models\Department_User_Map;
    use App\Models\Departments;
    use App\Models\Scheme_Supervisor_Map;
?>
@extends('layouts.app')

@section('title', 'Schemes List')
@section('content')
    @include('layouts.header')
    {{-- @include('layouts.navigation') --}}
    <div class="wrapper d-flex ">
        @include('layouts.sideNav')
        
        <div class="container">
            <h3 class="text-center text-2xl mt-2 mb-2">List Of Schemes</h3>
            {{-- <a href="{{ route('dashboard') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right">Back</button>
            </a> --}}

            

            <table border="1" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Scheme Name</th>
                        {{-- <th>Description</th> --}}
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Last Updated On</th>
                        <th>Status</th>
                        @if(Auth::user()->role != 2)
                            <th class="px-5" colspan="2">Action</th>
                        @endif
                        <th>Details</th>
                        <th>Scheme Progress</th>
                        <th>Scheme Status</th>
                        <th>Created By</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($schemes as $scheme)
                    @if($scheme->created_by == Auth::user()->id)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $scheme->scheme_name }}</td>
                            {{-- <td>{{ $scheme->scheme_description }}</td> --}}
                            <td>{{ $scheme->start_date }}</td>
                            <td>{{ $scheme->end_date }}</td>
                            <td>{{ $scheme->updated_at }}</td>
                            <td>
                                @if ($scheme->status == '1')
                                    <a class="btn btn-success disabled text-white opacity-100">Active</a>
                                @else
                                    <a class="btn btn-danger disabled text-white opacity-100">Inactive</a>
                                @endif
                            </td>
                            @if(Auth::user()->role != 2)
                                {{-- <td>
                                    <div class="btn-group">
                                        @if ($scheme->status == '1')
                                            <a href="{{ route('SchemeUpdate', $scheme->id) }}"
                                                class="btn btn-info text-white mr-2">Edit</a>
                                            <a href="{{ route('SchemeDelete', $scheme->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this notice')"
                                                class="btn btn-danger text-white">Delete</a>
                                        @else
                                            <a href="{{ route('schemes.apply', $scheme->id) }}"
                                                class="btn btn-secondary text-white text-sm p-2 mr-2">Commence</a>
                                            <a href="{{ route('SchemeDelete', $scheme->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this notice')"
                                                class="btn btn-danger text-white">Delete</a>
                                        @endif
                                    </div>
                                </td> --}}
                                @if ($scheme->status == '1')
                                    <td>
                                        <a href="{{ route('SchemeUpdate', $scheme->id) }}"
                                            class="btn btn-info text-white mr-2">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('SchemeDelete', $scheme->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this notice')"
                                            class="btn btn-danger text-white">Delete</a>
                                    </td>
                                @else
                                <td>
                                    <a href="{{ route('schemes.apply', $scheme->id) }}"
                                        class="btn btn-secondary text-white text-sm p-2 mr-2">Commence</a>
                                </td>
                                <td>
                                    <a href="{{ route('SchemeDelete', $scheme->id) }}"
                                        onclick="return confirm('Are you sure you want to delete this notice')"
                                        class="btn btn-danger text-white">Delete</a>
                                </td>
                                @endif
                            @endif
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('schemeInfo', $scheme->id)}}" class="bg-purple-500 hover:bg-purple-600 cursor-pointer p-2 btn text-white">
                                        View
                                    </a>
                                </div>
                            </td>
                            <td>
                               

                                    <?php
                                                
                                        $scheme_progress = SchemeProgress::on(Session::get('db_conn_name'))
                                            ->where('scheme_id', $scheme->id)
                                            ->orderBy('id', 'asc')
                                            ->get();
                                        
                                    ?>
                                    @if(!empty($scheme_progress))
                                        <div class="btn-group">
                                            <button type="button" class="px-3 py-2 ml-[-1px] bg-pink-400 hover:bg-pink-500 active:bg-pink-500 font-bold text-sm text-white rounded-md dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="btn btn-warning cursor-pointer text-white visually-hidden">Toggle Dropdown</span>
                                                Log
                                            </button>
                                            <ul class="dropdown-menu text-sm">
                                            
                                                    @foreach ($scheme_progress as $scheme_progress)
                                                        <li><a href="{{route('progressLog', $scheme_progress->id)}}">{{ $scheme_progress->updated_at }}</a></li>
                                                    @endforeach
                                                
                                            </ul>
                                        </div>
                                    @else
                                        Progress Not Updated Yet.
                                    @endif
                                    
                                
                            
                                
                            </td>
                            <td>                
                                @if ($scheme->status == 0)
                                    <a class="btn btn-light disabled opacity-100">Not Available</a>
                                @elseif ($scheme->scheme_status == 0 && $scheme->percentage_of_progress != 100)
                                    <a class="btn btn-warning disabled opacity-100 p-1 text-white">Running</a> 
                                @elseif ($scheme->scheme_status == 1 && $scheme->completion_year != null)
                                    <a class="btn btn-success disabled opacity-100 text-white p-1">Completed</a>
                                @endif
                            </td>
                            @php
                                 $schemeCreatedBy = User::where('id', $scheme->created_by)->first()->name;   
                            @endphp
                            <td>{{$schemeCreatedBy}}</td>
                            <td>
                                <?php
                                    $departmentId = Department_User_Map::on(Session::get('db_conn_name'))->where('user_id', $scheme->created_by)->get('department_id')->first();
                                    
                                    if($departmentId !== null){
                                        $dName = Departments::on(Session::get('db_conn_name'))->where('id', $departmentId->department_id)->first();
                                    }
                                ?>
                                {{-- {{dd($all_user->user->id)}} --}}
                                @if($departmentId != null)
                                    {{$dName->department_name}}
                                @else
                                    N/A
                                @endif
                            </td>
                           
                        </tr>  
                    @endif 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.footer')
@endsection
