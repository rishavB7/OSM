
@extends('layouts.app')

@section('content')
@include('layouts.header')
{{-- @include('layouts.navigation') --}}
    <div class="wrapper">
        <h3 class="text-center text-4xl mt-4">List Of Schemes</h3>
    
      <div class="container">

        <a href="{{route('dashboard')}}">
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
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach ($schemes as $scheme)
                    <tr>  
                        <td>{{$i++}}</td>      
                        <td>{{$scheme->scheme_name}}</td>
                        <td>{{$scheme->scheme_description}}</td>
                        <td>{{$scheme->start_date}}</td>
                        <td>{{$scheme->end_date}}</td>
                        <td>
                            @if ($scheme->status == '1')
                              <a class="badge badge-success text-white ">Active</a>  
                            @else
                               <a class="badge badge-danger text-white ">Inactive</a>     
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