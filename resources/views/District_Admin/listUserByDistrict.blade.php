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
                    <?php $i=1 ?>
                    @foreach ($all_users as $all_user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $all_user->user->name }}</td>
                            <td>{{ $all_user->user->email }}</td>
                            <td>{{ $all_user->user->mobile }}</td>
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
                            @if ($all_user->district_master->district)
                                <td>{{ $all_user->district_master->district }}</td>
                            @else
                                <td>N/A</td>
                            @endif
                            {{-- <td>
                                @php
                                    $department = Departments::where('id', $all_user->user->department_id)->first();
                                @endphp
                                @if ($department)
                                    {{ $department->department_name }}
                                @else
                                    N/A
                                @endif
                            </td> --}}
                            <td>
                                @if ($all_user->user->status == '1')
                                    <a class="badge badge-success text-white">Active</a>
                                @else
                                    <a class="badge badge-danger text-white">Inactive</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('updateUser', $all_user->user->id) }}">
                                    <button class="btn-link">Edit</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.footer')
@endsection
