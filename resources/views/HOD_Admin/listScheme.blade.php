@extends('layouts.app')

@section('content')
    @include('layouts.header')
    {{-- @include('layouts.navigation') --}}
    <div class="wrapper">
        <h3 class="text-center text-4xl mt-4">List Of Schemes</h3>

        <div class="container">
            <a href="{{ route('dashboard') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right">Back</button>
            </a>

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
                        <th>Action</th>
                        <th></th>
                        <th>Scheme Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($schemes as $scheme)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $scheme->scheme_name }}</td>
                            <td>{{ $scheme->scheme_description }}</td>
                            <td>{{ $scheme->start_date }}</td>
                            <td>{{ $scheme->end_date }}</td>
                            <td>{{ $scheme->updated_at }}</td>
                            <td>
                                @if ($scheme->status == '1')
                                    <a class="badge badge-success text-white ">Active</a>
                                @else
                                    <a class="badge badge-danger text-white ">Inactive</a>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    @if ($scheme->status == '1')
                                        <a href="{{ route('SchemeUpdate', $scheme->id) }}"
                                            class="btn btn-info text-white mr-2">Edit</a>
                                        <a href="{{ route('SchemeDelete', $scheme->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this notice')"
                                            class="btn btn-danger text-white">Delete</a>
                                    @else
                                            

                                                <a href="{{ route('schemes.apply', $scheme->id) }}"
                                                    class="btn btn-secondary text-white text-sm p-2 mr-2">Commence</a>
                                                    <a href="{{ route('SchemeDelete', $scheme->id) }}"
                                                        onclick="return confirm('Are you sure you want to delete this notice')"
                                                        class="btn btn-danger text-white">Delete</a>
                                           
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{route('schemeInfo', $scheme->id)}}" class="badge badge-warning cursor-pointer text-white p-1 ">
                                    View Details
                                </a>
                            </td>

                            <td>                
                                @if ($scheme->status == 0)
                                    <a class="badge badge-light">Not Available</a>
                                @elseif ($scheme->scheme_status == 0 && $scheme->percentage_of_progress != 100)
                                    <a class="badge badge-warning text-white p-1">Running</a> 
                                @elseif ($scheme->scheme_status == 1 && $scheme->completion_year != null)
                                    <a class="badge badge-success text-white p-1">Completed</a>
                                @endif
                            </td>
                            
                            
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.footer')
@endsection
