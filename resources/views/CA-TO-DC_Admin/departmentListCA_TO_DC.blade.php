<?php
use App\Models\User;
use App\Models\District_Master;
use App\Models\District_User_Map;
use App\Models\Departments;
?>

@extends('layouts.app')

@section('title', 'Departments List')
@section('content')
    @include('layouts.header')
    <div class="wrapper">

        <div class="d-flex justify-between">
            @include('layouts.sideNav')
            <div class="max-h-[80vh] overflow-y-scroll w-[90%] m-4">
                <table border="1" class="table p-[30rem]" class="overflow-scroll">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Department Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $department->department_name }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
