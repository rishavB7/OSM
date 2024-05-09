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
    <center><h3>Scheme Information</h3></center>

            <div class="table-responsive mt-4">
                @if($scheme_id)
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th style="width: 30%">Name of the scheme</th>
                            <td>{{ $scheme_id->scheme_name }}</td>
                        </tr>
                        <tr>
                            <th>Scheme Description</th>
                            <td>{{ $scheme_id->scheme_description }}</td>
                        </tr>
                        <tr>
                            <th>Starting Date</th>
                            <td>{{ $scheme_id->start_date }}</td>
                        </tr>
                        <tr>
                            <th>Ending Date</th>
                            <td>{{ $scheme_id->end_date }}</td>
                        </tr>
                        <tr>
                            <th>Total Budget</th>
                            <td>{{ $scheme_id->budget }}</td>
                        </tr>
                        <tr>
                            <th>Project Coordinator</th>
                            <td>{{ $scheme_id->projectc_coordinator }}</td>
                        </tr>
                        <tr>
                            <th>Physical Progress</th>
                            <td>{{ $scheme_id->physical_progress }}</td>
                        </tr>
                        <tr>
                            <th>% Of Progress</th>
                            <td>{{ $scheme_id->percentage_of_progress }}</td>
                        </tr>
                        <tr>
                            <th>Images</th>
                            <td>
                                <div class="row">
                                    @if ($scheme_id->images != null)
                                        @foreach(json_decode($scheme_id->images) as $image)
                                            <div class="col-md-4 mb-2">
                                                <img src="{{ asset($image) }}" class="img-thumbnail" alt="Scheme Image">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @else
                   <p>No Data</p> 
                @endif
                
            </div>
        </div>  
    </div>

</body>
</html>