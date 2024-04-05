@extends('layouts.app')
@include('layouts.header')

@section('content')

<div class="wrapper">
    <h3 class="text-center text-4xl mt-4">List Of Schemes (Completed)</h3>

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
                    <th>Completion Date</th>
                    <th></th>
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
                        <td>{{ $scheme->completion_year }}</td>
                        <td>
                            <a href="{{route('schemeInfo', $scheme->id)}}" class="badge badge-warning cursor-pointer text-white p-1 ">
                                View Details
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
