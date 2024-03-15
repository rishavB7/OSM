

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
    
        <h3 class="text-center">List Of Schemes</h3>
    
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
</body>
</html>