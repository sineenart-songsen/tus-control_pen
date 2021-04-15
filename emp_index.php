<?php
// Create connection
$connect = new mysqli('localhost', 'root', '', 'tus-control_pen');

// Check Connection

if ($connect->connect_error) {
    die("Something wrong.: " . $connect->connect_error);
}

$sql = "SELECT * FROM (((employee 
    INNER JOIN department
    ON employee.dept_id = department.dept_id)
    INNER JOIN work_type
    ON employee.work_type_id = work_type.work_type_id)
    INNER JOIN emp_type
    ON employee.emp_type_id = emp_type.emp_type_id);";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../tus-control_pen/css/nav.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js">
    </script>
    <script>
        $(document).ready(function() {
            $('.employee_data').DataTable();
        });
    </script>


</head>

<body>
    <ul>
        <li><a class="active" href="emp_index.php">หน้าหลัก</a></li>
        <li><a href="emp_form.php">เพิ่มข้อมูล</a></li>
        <li><a href="graf.php">กราฟ</a></li>
        <li><a href="#about">About</a></li>
    </ul>
    </br>
    <div class="container">
        <h1>ข้อมูลพนักงาน</h1>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordered employee_data">
                    <thead>
                        <td width="8%">รหัสพนักงาน</td>
                        <td width="20%">ชื่อ-นามสกุล</td>
                        <td width="5%">เพศ</td>
                        <td width="10%">แผนก</td>
                        <td width="5%">กะ</td>
                        <td width="10%">รายวัน/รายเดือน</td>
                        <td width="13%"></td>
                    </thead>
            </div>
        </div>
        <?php
        if (mysqli_num_rows($result) > 0) {
            // output data of each row

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["gender"] == "M") {
                    $row["gender"] = "ชาย";
                } else {
                    $row["gender"] = "หญิง";
                }
                echo '
        <tr>
        <td>' . $row["emp_id"] . '</td>
        <td>' . $row["emp_name"] . '</td>
        <td>' . $row["gender"] . '</td>
        <td>' . $row["dept_name"] . '</td>
        <td>' . $row["work_type_name"] . '</td>
        <td>' . $row["emp_type"] . '</td>
        <td><a class="btn btn-warning" href="edit.php?id=' . $row["emp_id"] . '">Edit</a>
        <a class="btn btn-danger" 
         href=" de.php?id=' . $row["emp_id"] . ' " onclick="return confirm(\'Are you sure?\')" > Delete </a>
        </td>
        </tr>
        
        ';
            }
        } else {
            echo "0 results";
        }
        mysqli_close($connect);
        ?>
        </table>
        </br>
</body>

</html>