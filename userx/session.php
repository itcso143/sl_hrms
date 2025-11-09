<?php

session_start();
include ('../config/db_config.php');

$objid = $type = $severity = $title = $image = $latitude= $longitude = $locationAddress = $postedBy = 
$mobileno = $created = $date = $time = $remarks = '';

$btnNew = 'disabled';
$btnStatus = "";

$user_id = $_SESSION['id'];


if (!isset($_SESSION['id'])) {
    header('location:../index');
} else {

}

//querry to select current user's information
$get_user_sql = "SELECT * FROM tbl_users WHERE id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $user_name   = $result['username'];
  $fullname   = $result['fullname'];
  $contact   = $result['mobileno'];
}


$get_all_users_sql = "SELECT * FROM tbl_users ";
$get_all_users_data = $con->prepare($get_all_users_sql);
$get_all_users_data->execute(); 
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $status   = $result['status'];
}
if (isset($_GET['id'])) {
    //select filename
$id = $_GET['id'];
$get_user1_sql = "SELECT * FROM tbl_users where id = :id";
$get_user1_data = $con->prepare($get_user1_sql);
$get_user1_data->execute([':id' => $id]);
    while ($result = $get_user1_data->fetch(PDO::FETCH_ASSOC)) {
        $fullname= $result['fullname'];
             
    }
}

//select all ordinances and sp members
$get_all_name_sql = "SELECT * FROM tbl_users user INNER JOIN tbl_incident inc ON user.fullname = inc.reported_by";
$get_all_name_data = $con->prepare($get_all_name_sql);
$get_all_name_data->execute();

?>