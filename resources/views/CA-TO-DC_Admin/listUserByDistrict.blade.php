<?php
use App\Models\User;
use App\Models\District_Master;
use App\Models\District_User_Map;
use App\Models\Departments;
?>

@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="wrapper">
        <h3 class="text-center text-4xl">List Of Users</h3>
        <div class="container ">
            <a href="{{ route('dashboard') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right">Back</button>
            </a>
            <table border="1" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>District</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    ?>
                    @foreach ($all_users as $all_user)
                        @if ($all_user->district_master->district == Auth()::user()->district)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $all_user->user->name }}</td>
                                <!-- Include other user details as needed -->
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.footer')
@endsection
