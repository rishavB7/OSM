<?php
use App\Models\User;
use App\Models\District_Master;
use App\Models\District_User_Map;
use App\Models\Departments;
use App\Models\Department_User_Map;
use Carbon\Carbon;
?>

@extends('layouts.app')

@section('title', 'Notifications')
@section('content')
    @include('layouts.header')
    <div class="wrapper">

        <div class="d-flex justify-between">
            @include('layouts.sideNav')
            <div class="w-100">
                <div class="d-flex justify-content-end">

                    <a href="{{ route('createNotification') }}"><button class="btn btn-primary p-2 mt-3 mb-2 mr-2">Create
                            Notification</button></a>
                    <a href="{{ route('dashboard') }}"><button class="btn btn-primary p-2 mt-3 mb-2 mr-5">Back</button></a>
                </div>
                <h1 class="ml-4 mb-3"><b>Notifications</b></h1>

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
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $notification->title }}</td>
                                        <td>
                                            @php
                                                $date = Carbon::parse($notification->created_at);
                                                $readableDateTime = $date->formatLocalized('%e %B %Y');
                                            @endphp
                                            {{ $readableDateTime }}
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/notifications/' . $notification->filename) }}"
                                                target="_blank">
                                                <button class="btn btn-primary btn-sm">View</button>
                                            </a>
                                            <a href="{{ route('delete_notification', ['id' => $notification->id]) }}">
                                                <button type="submit" class="btn btn-danger btn-sm ml-2"
                                                    style="background-color: red;">Delete</button>

                                            </a>
                                        </td>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $notifications->links() }}
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
