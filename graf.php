<?php
$connect = mysqli_connect("localhost", "root", "", "tus-control_pen");
$query = "SELECT count(*) as present_absent_count, dept_id,
     case
         when dept_id = 01 then 'บัญชี'
         when dept_id = 02 then 'ขาย'
         when dept_id = 03 then 'บุคคล'
       end as dept_id FROM employee GROUP BY dept_id ;";
$result = mysqli_query($connect, $query);
$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $label[$i] = $row["dept_id"];
    $count[$i] = $row["present_absent_count"];
    $i++;
}
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../tus-control_pen/css/nav.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['attendancede', 'Numbder'],
                ['<?php echo $label[0]; ?>', <?php echo $count[0]; ?>],
                ['<?php echo $label[1]; ?>', <?php echo $count[1]; ?>],
                ['<?php echo $label[2]; ?>', <?php echo $count[2]; ?>],
            ]);
            var options = {
                title: 'จำนวนพนักงานแต่ละฝ่าย'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <ul>
        <li><a class="active" href="emp_index.php">หน้าหลัก</a></li>
        <li><a href="emp_form.php">เพิ่มข้อมูล</a></li>
        <li><a href="graf.php">กราฟ</a></li>
        <li><a href="#about">About</a></li>
    </ul>
    </br>    <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>

</html>