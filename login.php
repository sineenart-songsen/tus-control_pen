<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/user.php';

$objUser = new User();

// POST
if(isset($_POST["submit"])){
  $username   = strip_tags($_POST['username']);
  $password  = strip_tags($_POST['password']);

    }catch(PDOException $e){
    echo $e->getMessage();
  }
}

try{
  $sql = "select * from users where username = ?";
  $stmt = $objUser->runQuery($sql);
  $stmt->execute([$username]);
  $user = $stmt->fetch();
  if(md5($password) == ($user['password'])){

      $username = $user['username'];
      $_SESSION['username'] = $username;
      $objUser->redirect('pen_index.php');
 }else{
   $objUser->redirect('index.php');
 }
}catch(PDOException $e){
  echo $e->getMessage();
}

?>

