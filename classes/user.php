<?php
require_once 'database.php';
class User{
    private $conn;
    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }
    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }
    // Redirect URL method
    public function redirect($url){
      header("Location: $url");
    }
    
    // Insert employee
    public function insert($emp_id, $emp_name, $gender, $dept_id, $work_type_id, $emp_type_id){
      try{
        $stmt = $this->conn->prepare("INSERT INTO employee (emp_id, emp_name, gender, dept_id, work_type_id, emp_type_id) 
        VALUES(:emp_id,:emp_name,:gender,:dept_id,:work_type_id,:emp_type_id)");
        $stmt->bindparam(":emp_id", $emp_id);
        $stmt->bindparam(":emp_name", $emp_name);
        $stmt->bindparam(":gender", $gender);
        $stmt->bindparam(":dept_id", $dept_id);
        $stmt->bindparam(":work_type_id", $work_type_id);
        $stmt->bindparam(":emp_type_id", $emp_type_id);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }

  }
?>
