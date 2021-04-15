<?php
// Show PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../tus-control_pen/classes/user.php';

$objUser = new User();

// POST
if (isset($_POST['btn_up'])) {
    $emp_id   = strip_tags($_POST['emp_id']);
    $emp_name  = strip_tags($_POST['emp_name']);
    $gender   = strip_tags($_POST['gender']);
    $dept_id  = strip_tags($_POST['dept_id']);
    $work_type_id   = strip_tags($_POST['work_type_id']);
    $emp_type_id  = strip_tags($_POST['emp_type_id']);

    try {
        $sql = "UPDATE employee SET emp_id = '$emp_id', emp_name = '$emp_name', gender = '$gender', dept_id ='$dept_id',work_type_id = '$work_type_id', emp_type_id = '$emp_type_id' WHERE emp_id ='" . $_GET["id"] . "' ";
        $stmt = $objUser->runQuery($sql);
        $stmt->execute();
        if ($stmt) {
            $objUser->redirect('emp_index.php');
        } else {
            $objUser->redirect('emp_index.php?error');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<head>
    <link rel="stylesheet" type="text/css" href="../tus-control_pen/vendor/bootstrap/css/bootstrap.min.css">
</head>


<body>
    <div class="container">
        <form method="post">
            <div class="form-group">
                </br>
                <div class="form-group row">
                    <label for="emp_id" class="col-2 col-form-label">รหัสพนักงาน </label>
                    <?php
                    $sql = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                    $stmt = $objUser->runQuery($sql);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <div class="col-4">
                                <input class="form-control" type="text" name="emp_id" id="emp_id" autofocus placeholder="รหัสตามบัตรพนักงาน" required value="<?php print($rows['emp_id']) ?>" readonly>
                            </div>
                </div>
        <?php
                        }
                    }
        ?>
            </div>
            <div class="form-group">
                <div class="form-group row">
                    <label for="emp_name" class="col-2 col-form-label">ชื่อ สกุล *</label>
                    <?php
                    $sql = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                    $stmt = $objUser->runQuery($sql);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <div class="col-4">
                                <input class="form-control" type="text" name="emp_name" id="emp_name" placeholder="ชื่อนามสกุล พนักงาน" required value="<?php print($rows['emp_name']) ?>">
                            </div>
                </div>
        <?php
                        }
                    }
        ?>
            </div>
            <div class="form-group row">
                <?php
                $sql = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <label class="col-2" for="gender">เพศ *</label>
                        <div class="col-4">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control" type="radio" id="female" name="gender" value="F" <?php echo ($rows['gender'] == 'F') ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="female">หญิง</label><br>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control" type="radio" id="male" name="gender" value="M" <?php echo ($rows['gender'] == 'M') ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="male">ชาย</label><br>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label" for="dept_id">แผนก/ฝ่าย *</label>
                <div class="col-10">
                    <select name="dept_id" id="dept_id" class="custom-select">
                        <?php
                        $sql = "SELECT * FROM department";
                        $sql2 = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                        $stmt = $objUser->runQuery($sql);
                        $stmt2 = $objUser->runQuery($sql2);
                        $stmt->execute();
                        $stmt2->execute();
                        if ($stmt2->rowCount() > 0) {
                            while ($rows2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                if ($stmt->rowCount() > 0) {
                                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                        <option value="<?php print($rows['dept_id']) ?>" <?php if ($rows2['dept_id'] == $rows['dept_id']) {
                                                                                                echo "selected='selected'";
                                                                                            } ?>>
                                            <?php print($rows['dept_name']) ?></option>
                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label" for="dept_id">ประเภทของงาน *</label>
                <div class="col-10">
                    <select name="work_type_id" id="work_type_id" class="custom-select">
                        <?php
                        $sql = "SELECT * FROM work_type";
                        $sql2 = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                        $stmt = $objUser->runQuery($sql);
                        $stmt2 = $objUser->runQuery($sql2);
                        $stmt->execute();
                        $stmt2->execute();
                        if ($stmt2->rowCount() > 0) {
                            while ($rows2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                if ($stmt->rowCount() > 0) {
                                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                        <option value="<?php print($rows['work_type_id']) ?>"><?php print($rows['work_type_name']) ?>
                                        </option>
                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label" for="dept_id">ประเภทของพนักงาน *</label>
                <div class="col-10">
                    <select name="emp_type_id" id="emp_type_id" class="custom-select">
                        <?php
                        $sql = "SELECT * FROM emp_type";
                        $sql2 = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                        $stmt = $objUser->runQuery($sql);
                        $stmt2 = $objUser->runQuery($sql2);
                        $stmt->execute();
                        $stmt2->execute();
                        if ($stmt2->rowCount() > 0) {
                            while ($rows2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                if ($stmt->rowCount() > 0) {
                                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                        <option value="<?php print($rows['emp_type_id']) ?>" <?php if ($rows2['emp_type_id'] == $rows['emp_type_id']) {
                                                                                                    echo "selected='selected'";
                                                                                                } ?>>
                                            <?php print($rows['emp_type']) ?></option>
                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-3 col-9">
                    <input class="btn btn-primary" type="submit" name="btn_up" value="Save">
                    <a class="btn btn-success" href="emp_index.php">Cancel</a>
                </div>
            </div>
    </div>
    </form>
    </div>
</body>
<?php
?>