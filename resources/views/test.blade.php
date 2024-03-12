<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>


<h3 class="text-center">Map Users with District</h3>
<div class="container">
    <a href="{{route('dashboard')}}">
        <button type="button" class="btn btn-primary mb-4">Back</button>
    </a>

    <table border="1" class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>District Unique Code</th>
                <th>Department ID</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($users as $user)      
                <td>{{$user->id}}</td>
                <td>{{$user->district_unique_code}}</td>
                <td>{{$user->department_id}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
