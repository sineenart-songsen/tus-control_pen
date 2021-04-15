<?php
// Show PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once 'classes/user.php';

$objUser = new User();
// POST
if (isset($_POST['btn_save'])) {
  $emp_id   = strip_tags($_POST['emp_id']);
  $emp_name  = strip_tags($_POST['emp_name']);
  $gender   = strip_tags($_POST['gender']);
  $dept_id  = strip_tags($_POST['dept_id']);
  $work_type_id   = strip_tags($_POST['work_type_id']);
  $emp_type_id  = strip_tags($_POST['emp_type_id']);

  try {
    if ($objUser->insert($emp_id, $emp_name, $gender, $dept_id, $work_type_id, $emp_type_id)) {
      $objUser->redirect('emp_index.php?inserted');
    } else {
      $objUser->redirect('emp_index.php?error');
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../tus-control_pen/css/nav.css">
  <link rel="stylesheet" type="text/css" href="../tus-control_pen/vendor/bootstrap/css/bootstrap.min.css">
</head>

<body>

  <body>
    <ul>
      <li><a class="active" href="emp_index.php">หน้าหลัก</a></li>
      <li><a href="emp_form.php">เพิ่มข้อมูล</a></li>
      <li><a href="graf.php">กราฟ</a></li>
      <li><a href="#about">About</a></li>
    </ul>
    </br>
    <div class="container">
    <form method="post">
      <div>
        <label for="emp_id">รหัสพนักงาน *</label>
        <input type="text" name="emp_id" id="emp_id" autofocus placeholder="รหัสตามบัตรพนักงาน" required>
      </div><br>

      <div>
        <label for=”emp_name” placeholder=”ชื่อนามสกุล พนักงาน”>ชื่อ นามสกุล * </label>
        <input type="text" name="emp_name" id="emp_name" autofocus placeholder="ชื่อ นามสกุล" required>
      </div><br>

      <div>
        <label for="gender">เพศ *</label><br>
        <input type="radio" id="female" checked name="gender" value="F">
        <label for="female">หญิง</label><br>
        <input type="radio" id="male" name="gender" value="M">
        <label for="male">ชาย</label><br>
      </div><br>

      <div>
        <label for="dept_id">แผนก/ฝ่าย *</label>
        <select name="dept_id" id="dept_id" class="form-control">
          <?php
          $sql = "select * from department";
          $stmt = $objUser->runQuery($sql);
          $stmt->execute();
          if ($stmt->rowCount() > 0) {
            while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
              <option value="<?php print($rows['dept_id']) ?>"><?php print($rows['dept_name']) ?></option>
          <?php
            }
          }
          ?>
        </select>

      </div><br>
      <div>
        <label for="work_type_id">ประเภทงาน *</label>
        <select name="work_type_id" id="work_type_id" class="form-control">
          <?php
          $sql = "select * from work_type";
          $stmt = $objUser->runQuery($sql);
          $stmt->execute();
          if ($stmt->rowCount() > 0) {
            while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
              <option value="<?php print($rows['work_type_id']) ?>"><?php print($rows['work_type_name']) ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div><br>
      <div>
        <label for="work_type_id">ประเภทของพนักงาน *</label>
        <select name="emp_type_id" id="emp_type_id" class="form-control">
          <?php
          $sql = "select * from emp_type";
          $stmt = $objUser->runQuery($sql);
          $stmt->execute();
          if ($stmt->rowCount() > 0) {
            while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
              <option value="<?php print($rows['emp_type_id']) ?>"><?php print($rows['emp_type']) ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div><br><br>
      <div class="container-login100-form-btn">
        <button class="login100-form-btn" type="submit" name="btn_save" value="Save">
          Save
        </button>
      </div>
    </form>
    </div>
  </body>

</html>