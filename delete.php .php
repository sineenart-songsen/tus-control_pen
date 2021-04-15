<?php
include 'emp_index.php';
$sql = "DELETE FROM customers ";
$sql .= "WHERE custId='" . $_GET['emp_id'] . "'";
if (mysqli_query($conn, $sql)) {
  header('Location:emp_index.php');
} else {
  echo " :: Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?> 
