<?php
 use App\Models\User;
 use App\Models\District_Master;
 use App\Models\District_User_Map;
 use App\Models\Departments;
?>



<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    
        <h3 class="text-center">List Of Users</h3>
    
      <div class="container">

        <a href="{{route('dashboard')}}">
            <button class="btn btn-primary d-inline-block m-2 float-right ">Back</button>
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
                      <th>Status</th>
                      <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach ($all_users as $all_user)
                    <tr>  
                        <td>{{$i++}}</td>      
                        <td>{{$all_user->name}}</td>
                        <td>{{$all_user->email}}</td>
                        <td>{{$all_user->mobile}}</td>
                        {{-- <td>{{$all_user->role}}</td> --}}
                        @if ($all_user->role == 1)
                            <td>Master Admin</td>                    
                        @elseif($all_user->role == 2)
                            <td>DC/SDO Admin</td>
                        @elseif($all_user->role == 3)
                            <td>Nodal Officer</td>    
                        @else
                            <td>N/A</td>
                        @endif
                        {{-- <td>{{$all_user->district}}</td> --}}
                        @php
                             $district = District_Master::find($all_user->district);
                            //  $department = Departments::find($all_user->department);
                        @endphp
                        @if ($district)
                            <td>{{$district->district}}</td>
                        @endif

                        {{-- @if ($department)
                            <td>{{$departmemnt->department_name}}</td>                            
                        @endif --}}
                        <td>
                            @if ($all_user->status == '1')
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
</body>
</html>