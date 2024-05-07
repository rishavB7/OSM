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
            <div class="w-100">
                <div class="d-flex justify-content-end">
                    
                    <a href="{{route('printDepartmentListCA_TO_DC')}}" target="_blank"><button class="btn btn-primary p-2 mt-3 mb-2 mr-5">Print</button></a>
                </div>

                <div class="max-h-[80vh] overflow-y-scroll m-4">
                    <div id="print_section">
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
            
        </div>
    </div>
    @include('layouts.footer')
    <script>
        function print_section() {
            window.print();
        }
    </script>
@endsection
