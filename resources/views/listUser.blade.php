<?php
use App\Models\User;
use App\Models\District_Master;
use App\Models\District_User_Map;
use App\Models\Departments;
use App\Models\Department_User_Map;
?>

@extends('layouts.app')
@section('title', 'Users List')
@section('content')
    @include('layouts.header')
    <div class="wrapper">

        <div class="d-flex justify-between">
            @include('layouts.sideNav')
            <div class="max-h-[80vh] overflow-y-scroll w-[90%] m-4">
                <table border="1" class="table" class="overflow-scroll">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>District</th>
                            <th>Status</th>
                            <th>Action</th>
                            @if (Auth::User()->role == 2 || Auth::User()->role == 3)
                            <th>Department</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($all_users as $all_user)
                            @if(Auth::user()->role == 1)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $all_user->user->name }}</td>
                                <td>{{ $all_user->user->email }}</td>
                                <td>{{ $all_user->user->mobile }}</td>
                                {{-- <td>{{$all_user->role}}</td> --}}
                                @if ($all_user->user->role == 1)
                                    <td>Master Admin</td>
                                @elseif($all_user->user->role == 2)
                                    <td>DC/SDO Admin</td>
                                @elseif($all_user->user->role == 3)
                                    <td>Nodal Officer</td>
                                @elseif($all_user->user->role == 4)
                                    <td>Assistant 1</td>
                                @elseif($all_user->user->role == 5)
                                    <td>Assistant 2</td>
                                @else
                                    <td>N/A</td>
                                @endif
                                {{-- <td>{{$all_user->district}}</td> --}}

                                @if ($all_user->district_master->district)
                                    <td>{{ $all_user->district_master->district }}</td>
                                @else
                                    <td>N/A</td>
                                @endif

                                {{-- @if ($department)
                        <td>{{$departmemnt->department_name}}</td>                            
                    @endif --}}
                                <td>
                                    @if ($all_user->user->status == '1')
                                        <a class="badge badge-success text-white ">Active</a>
                                    @else
                                        <a class="badge badge-danger text-white ">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('updateUser', $all_user->user->id) }}">
                                        <button class="btn-link">Edit</button>
                                    </a>
                                </td>
                            </tr>
                            @elseif (Auth::user()->role == 2 && $all_user->district_master->unique_code == $currentUserDistrict)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $all_user->user->name }}</td>
                                    <td>{{ $all_user->user->email }}</td>
                                    <td>{{ $all_user->user->mobile }}</td>
                                    {{-- <td>{{$all_user->role}}</td> --}}
                                    @if ($all_user->user->role == 1)
                                        <td>Master Admin</td>
                                    @elseif($all_user->user->role == 2)
                                        <td>DC/SDO Admin</td>
                                    @elseif($all_user->user->role == 3)
                                        <td>Nodal Officer</td>
                                    @elseif($all_user->user->role == 4)
                                        <td>Assistant 1</td>
                                    @elseif($all_user->user->role == 5)
                                        <td>Assistant 2</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    {{-- <td>{{$all_user->district}}</td> --}}

                                    @if ($all_user->district_master->district)
                                        <td>{{ $all_user->district_master->district }}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif

                                    {{-- @if ($department)
                            <td>{{$departmemnt->department_name}}</td>                            
                        @endif --}}
                                    <td>
                                        @if ($all_user->user->status == '1')
                                            <a class="badge badge-success text-white ">Active</a>
                                        @else
                                            <a class="badge badge-danger text-white ">Inactive</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('updateUser', $all_user->user->id) }}">
                                            <button class="btn-link">Edit</button>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                            $departmentId = Department_User_Map::on(Session::get('db_conn_name'))->where('user_id', $all_user->user->id)->get('department_id')->first();
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
    </div>
    @include('layouts.footer')
@endsection
