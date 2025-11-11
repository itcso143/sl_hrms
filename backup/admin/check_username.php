<?php


session_start();

include('../config/db_config.php');

if (isset($_POST['username'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";


$username = $_POST['username'];

$check_username_sql = "SELECT * FROM tbl_users where username = :username";
        
$check_username_data = $con->prepare($check_username_sql);
$check_username_data ->execute([
  ':username' => $username
]);

if ($check_username_data->rowCount() > 0){

  echo '<div style="color: red;"> <b>'.$username.'</b> is already in use! </div>';
  }else{
  echo '<div style="color: green;"> <b>'.$username.'</b> is avaialable! </div>';
  }

die();

}


