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
                            <th>Designation</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            {{-- <th>District</th> --}}
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($dcs as $dc)
                            @if (Auth::user()->role == 1) 
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $dc->name }}</td>
                                    <td>{{ $dc->designation }}</td>
                                    <td>{{$dc->email}}</td>
                                    <td>{{$dc->mobile}}</td>   
                                    {{-- <td>{{$dc->district}}</td> --}}
                                    <td>
                                        @if ($dc->status == '1')
                                            <a class="badge badge-success text-white ">Active</a>
                                        @else
                                            <a class="badge badge-danger text-white ">Inactive</a>
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
