<?php
use App\Models\User;
use App\Models\District_Master;
use App\Models\District_User_Map;
use App\Models\Departments;
use App\Models\Department_User_Map;

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
                            <th>Address</th>
                            <th>Current HOD</th>
                            <th>Contact Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $department->department_name }}</td>
                                <td>{{ $department->department_address }}</td>
                                @php
                                    $department_user_map = Department_User_Map::on(Session::get('db_conn_name'))
                                        ->where('department_id', $department->id)
                                        ->first();
                                    if ($department_user_map) {
                                        $hod = User::where('id', $department_user_map->user_id)->first();
                                        echo "<td>$hod->name </td>";
                                        echo "<td>$hod->mobile </td>";
                                    } else {
                                        echo '<td></td>';
                                        echo '<td> </td>';
                                    }
                                @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
