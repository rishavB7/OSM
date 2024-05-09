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
            <div class="d-flex flex-column w-100">
                <div>
                    <a href="{{ route('dashboard') }}">
                        <button class="btn btn-primary d-inline-block m-2 float-right py-1">Back</button>
                    </a>
                </div>
                <div class=" overflow-y-scroll  m-4" >
                    <table border="1" class="table  divide-gray-200 overflow-scroll">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mobile</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    District</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                                @if (Auth::User()->role == 2 || Auth::User()->role == 3 || Auth::User()->role == 4)
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Department</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Designation</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $i = 1; ?>
                            @foreach ($all_users as $all_user)
                                @if (Auth::user()->role == 1)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $i++ }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $all_user->user->fullname }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $all_user->user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $all_user->user->mobile }}</td>
                                        {{-- <td>{{$all_user->role}}</td> --}}
                                        @if ($all_user->user->role == 1)
                                            <td class="px-6 py-4 whitespace-nowrap">Master Admin</td>
                                        @elseif($all_user->user->role == 2)
                                            <td class="px-6 py-4 whitespace-nowrap">DC/SDO (C)</td>
                                        @elseif($all_user->user->role == 3)
                                            <td class="px-6 py-4 whitespace-nowrap">Nodal Officer</td>
                                        @elseif($all_user->user->role == 4)
                                            <td class="px-6 py-4 whitespace-nowrap">CA_to_DC</td>
                                        @elseif($all_user->user->role == 5)
                                            <td class="px-6 py-4 whitespace-nowrap">CEO_ZP</td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap">DDC</td>
                                        @endif
                                       

                                        @if ($all_user->district_master->district)
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $all_user->district_master->district }}
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap">N/A</td>
                                        @endif

                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($all_user->user->status == '1')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-red-800">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('updateUser', $all_user->user->id) }}"
                                                class= "text-indigo-600 hover:text-indigo-900 hover:no-underline">
                                                Edit
                                            </a>
                                        </td>

                                    </tr>
                                @elseif (Auth::user()->role == 2 ||
                                        (Auth::user()->role == 4 && $all_user->district_master->unique_code == $currentUserDistrict))
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $all_user->user->name }}</td>
                                        <td>{{ $all_user->user->email }}</td>
                                        <td>{{ $all_user->user->mobile }}</td>
                                        {{-- <td>{{$all_user->role}}</td> --}}
                                        @if ($all_user->user->role == 1)
                                            <td>Master Admin</td>
                                        @elseif($all_user->user->role == 2)
                                            <td>DC/SDO (C)</td>
                                        @elseif($all_user->user->role == 3)
                                            <td>Deparment_HOD</td>
                                        @elseif($all_user->user->role == 4 || 5 || 6)
                                            <td>NODAL OFFICER</td>
                                        @endif
                                        {{-- <td>{{$all_user->district}}</td> --}}

                                        @if ($all_user->district_master->district)
                                            <td>{{ $all_user->district_master->district }}</td>
                                        @else
                                            <td>N/A</td>
                                        @endif

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
                                            $departmentId = Department_User_Map::on(Session::get('db_conn_name'))
                                                ->where('user_id', $all_user->user->id)
                                                ->get('department_id')
                                                ->first();
                                            if ($departmentId !== null) {
                                                $dName = Departments::on(Session::get('db_conn_name'))
                                                    ->where('id', $departmentId->department_id)
                                                    ->first();
                                            }
                                            ?>
                                            {{-- {{dd($all_user->user->id)}} --}}
                                            @if ($departmentId != null)
                                                {{ $dName->department_name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            {{ $all_user->user->designation }}
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @include('layouts.footer')
@endsection
