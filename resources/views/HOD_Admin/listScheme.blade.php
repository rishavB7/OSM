@extends('layouts.app')

@section('content')
    @include('layouts.header')
    {{-- @include('layouts.navigation') --}}
    <div class="wrapper">
        <h3 class="text-center text-4xl mt-4">List Of Schemes</h3>

        <div class="container">

            <a href="{{ route('dashboard') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right ">Back</button>
            </a>

            <table border="1" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
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
                            <td>
                                @if ($scheme->status == '1')
                                    <a class="badge badge-success text-white ">Active</a>
                                @else
                                    <a class="badge badge-danger text-white ">Inactive</a>
                                @endif
                            </td>
                            <td>

                                @if ($scheme->status == '1')
                                    <a href="{{ route('SchemeUpdate', $scheme->id) }}"
                                        class="badge badge-info cursor-pointer text-white p-1 mr-2"><svg
                                            class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('SchemeDelete', $scheme->id) }}" onclick="return confirm('Are you sure you want to delete this notice')"
                                        class="badge badge-danger  cursor-pointer text-white p-1"><svg
                                            class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg></a>
                                @else
                                    <a href="{{ route('schemes.apply', $scheme->id) }}"
                                        class="badge badge-secondary cursor-pointer text-white p-1">Apply</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('schemeInfo', $scheme_id->id)}}">
                                <img src="https://cdn.hugeicons.com/icons/information-circle-stroke-rounded.svg" alt="information-circle" width="24" height="24" />
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
