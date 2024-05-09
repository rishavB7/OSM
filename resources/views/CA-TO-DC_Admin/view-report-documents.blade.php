<?php
use App\Models\User;
use App\Models\District_Master;
use App\Models\District_User_Map;
use App\Models\Departments;
use App\Models\Department_User_Map;
use Carbon\Carbon;
?>

@extends('layouts.app')

@section('title', 'Documents')
@section('content')
    @include('layouts.header')
    <div class="wrapper">

        <div class="d-flex justify-between">
            @include('layouts.sideNav')
            <div class="w-100">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('dashboard') }}"><button class="btn btn-primary p-2 mt-3 mb-2 mr-5">Back</button></a>
                </div>
                <h1 class="ml-4 mb-3"><b>Documents</b></h1>

                <div class="px-3">
                    @if (session('alert-success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('alert-success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('alert-failed'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('alert-failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="max-h-[80vh]  m-4">
                    <div id="print_section">
                        <table border="1" class="table p-[30rem]" class="overflow-scroll">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Uploaded On</th>
                                    <th>Uploaded By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($reportDocs as $reportDoc)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            {{ $reportDoc->subject }}
                                        </td>
                                        <td>
                                            @php
                                                $date = Carbon::parse($reportDoc->created_at);
                                                $readableDateTime = $date->formatLocalized('%e %B %Y');
                                            @endphp
                                            {{ $readableDateTime }}
                                        </td>
                                        <td>
                                            @php
                                                $dept_user_map = Department_User_Map::on(Session::get('db_conn_name'))
                                                    ->where('user_id', $reportDoc->uploaded_by)
                                                    ->first();
                                                $user = User::where('id', $dept_user_map->user_id)->first();
                                                $department = Departments::on(Session::get('db_conn_name'))
                                                    ->where('id', $dept_user_map->department_id)
                                                    ->first();
                                                echo $user->name .
                                                    ', ' .
                                                    $user->designation .
                                                    ', ' .
                                                    $department->department_name;
                                            @endphp
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/reportDocs/' . $reportDoc->filename) }}"
                                                target="_blank">
                                                <button class="btn btn-primary btn-sm">View</button>
                                            </a>
                                        </td>
                                        @php
                                            $i++;
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $reportDocs->links() }}
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
