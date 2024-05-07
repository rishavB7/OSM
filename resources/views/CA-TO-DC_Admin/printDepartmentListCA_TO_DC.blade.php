<?php
use App\Models\User;
use App\Models\District_Master;
use App\Models\District_User_Map;
use App\Models\Departments;
use App\Models\Department_User_Map;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
</head>
<body>
    <button class="print_btn" onclick="window.print()">Print</button>
    <center><h3>Department List</h3></center>
    <table style="width: 100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Department Name</th>
                <th>Address</th>
                <th>Current HOD</th>
                <th>Contact Number</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $department->department_name }}</td>
                    <td>{{ $department->department_address }}</td>
                    @php
                        $department_user_map = Department_User_Map::on(Session::get('db_conn_name'))
                            ->where('department_id', $department->id)
                            ->first();
                        if ($department_user_map) {
                            $hod = User::where('id', $department_user_map->user_id)->first();
                            echo "<td>$hod->name </td>";
                            echo "<td>$hod->mobile </td>";
                        } else {
                            echo '<td></td>';
                            echo '<td> </td>';
                        }
                    @endphp
            @endforeach
        </tbody>
    </table>
</body>
</html>
   
