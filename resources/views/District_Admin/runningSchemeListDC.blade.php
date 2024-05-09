<?php
    use App\Models\SchemeProgress;
    use App\Models\User;
?>

@extends('layouts.app')

@section('title', 'Running Schemes')
@section('content')
    @include('layouts.header')
    <div class="wrapper d-flex ">
        @include('layouts.sideNav')
        
        <div class="container">
            <h3 class="text-center text-2xl mt-2 mb-2">List Of Running Schemes</h3>
            
            <table border="1" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Last Updated On</th>
                        <th>Status</th>
                        <th>Details</th>
                        <th>Scheme Progress</th>
                        <th>Created By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($runningSchemes as $runningScheme)
                    @if($runningScheme->created_by == Auth::user()->id || Auth::user()->role == 2)
                        @if ($runningScheme->scheme_status == 0 && $runningScheme->percentage_of_progress != 100)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $runningScheme->scheme_name }}</td>
                                <td>{{ $runningScheme->scheme_description }}</td>
                                <td>{{ $runningScheme->start_date }}</td>
                                <td>{{ $runningScheme->end_date }}</td>
                                <td>{{ $runningScheme->updated_at }}</td>
                                <td>
                                    <a class="btn btn-warning disabled text-white opacity-100 p-1">Running</a>
                                </td>
                                
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('schemeInfo', $runningScheme->id)}}" class="bg-purple-500 hover:bg-purple-600 cursor-pointer p-2 btn text-white">
                                            View
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="px-3 py-2 ml-[-1px] bg-pink-400 hover:bg-pink-500 active:bg-pink-500 font-bold text-sm text-white rounded-md dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="btn btn-warning cursor-pointer text-white visually-hidden">Toggle Dropdown</span>
                                            Log
                                        </button>
                                        <ul class="dropdown-menu text-sm">
                                            <?php
                                                $scheme_progress = SchemeProgress::on(Session::get('db_conn_name'))
                                                    ->where('scheme_id', $runningScheme->id)
                                                    ->orderBy('id', 'asc')
                                                    ->get();
                                            ?>
                                            @foreach ($scheme_progress as $scheme_progress)
                                                <li><a href="{{route('progressLog', $scheme_progress->id)}}">{{ $scheme_progress->updated_at }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                @php
                                     $schemeCreatedBy = User::where('id', $runningScheme->created_by)->first()->name;   
                                @endphp
                                <td>{{$schemeCreatedBy}}</td>
                            </tr>  
                        @endif 
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.footer')
@endsection
