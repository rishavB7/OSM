<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    table {
       border-collapse: collapse;
       width: 100%;
   }
   
   th, td {
       border: 1px solid black; /* Adjust border style as needed */
       padding: 8px;
       text-align: left;
   }


   @media print {
       @page {
           size: A4;
           margin: 0; /* Adjust margins as needed */
       }
       .print_btn{
           display: none;
        }
       
       /* Add any additional styles for printing here */
   }
</style>

<body>
    <button class="print_btn" onclick="window.print()">Print</button>
    <center><h3>Progress Log</h3></center>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Scheme Title</th>
                    <th>% Of Progress</th>
                    <th>Physical Progress</th>
                    <th>Fund Used</th>
                    <th>Remaining Budget</th>
                    <th>Images</th>
                </tr>
            </thead>
            <tbody>
        
                <tr>
                    <td>{{ $schemeProgress->scheme->scheme_name }}</td>
                    <td>{{ $schemeProgress->percentage_of_progress }}</td>
                    <td>{{ $schemeProgress->physical_progress }}</td>
                    <td>{{ $schemeProgress->funds_used }}</td>
                    <td>{{ $schemeProgress->scheme->remaining_budget }}</td>
                    <td>
                        <div class="row">
                            @foreach (json_decode($schemeProgress->images) as $image)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ asset($image) }}" class="img-fluid rounded"
                                        alt="Scheme Image">
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
               

            </tbody>
        </table>
    </div>
</body>
</html>