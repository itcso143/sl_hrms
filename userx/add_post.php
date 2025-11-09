<?php

include ('../config/db_config.php');
// session_start();
// $user_id = $_SESSION['id'];

$alert_msg = '';
$alert_msg1 = '';
$alert_msg2 = '';

     //echo "<pre>";
     //print_r($_POST);
     //echo "</pre>";

if (isset($_POST['addPost'])) {
// $content = $_POST['Content_Type'];
$objid = $_POST['objid'];
$type = $_POST['type'];
$severity = $_POST['topicSeverity'];
$title = $_POST['topicTitle'];
$latitude='Latitude';
$longitude = 'Longitude';
$locationAddress = $_POST['topicLocationAddress'];
$postedBy = $_POST['topicPostedBy'];
$created = $_POST['topicDateAndTimePosted'];
$mobileno = $_POST['mobileNo'];
$date = date('Y-m-d');
$time = date('h:i:s');
$remarks = 'NEW REPORT';

$currentDir = getcwd();
    $uploadDirectory = "../dist/img/";

    $errors = [];

    $fileExtensions = ['png','jpg','jpeg','gif',''];

    $fileName = $_FILES['myFiles']['name'];
    $fileSize = $_FILES['myFiles']['size'];
    $fileTmpName = $_FILES['myFiles']['tmp_name'];
    $fileType = $_FILES['myFiles']['type'];
    $target_file = $uploadDirectory . basename($_FILES['myFiles']['name']);
    $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $fileExtension = strtolower(end(explode('.',$fileName)));
    $uploadPath = $uploadDirectory . basename($fileName);

    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed.";
    }
    if (empty($errors)) {
        $dipUpload = move_uploaded_file($fileTmpName, $uploadPath);


        if ($dipUpload) {
            $alert_msg1 .= ' 
       <div class="table-bordered">
           <i class="icon fa fa-success"></i>
           File has been uploaded
       </div>     
   ';
            // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';


        } else {
            $alert_msg1 .= ' 
       <div class="alert alert-warning alert-dismissible"">
           <i class="icon fa fa-warning"></i>
           An Error Occured;
       </div>     
   ';
            // $fname = $mname = $lname = $contact_number = $email = $uname = $upass = '';

            $btnStatus = 'disabled';
            $btnNew = 'disabled';
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "Thses are the errors" . "\n";

        }
    }


$addPost_sql = "INSERT INTO tbl_incident SET
objid                = :objid,
type                = :type,
severity            = :severity,
topic               = :topic,
latitude            = :latitude,
longitude           = :longitude,
image               = :filename,
createdat           = :createdat,
location_address    = :locationAddress,
reported_by         = :reportedBy,
date               = :date,
time                = :time,
mobileno            = :mobileno,
remarks             = :remarks";


$insert_data = $con->prepare($addPost_sql);
$insert_data->execute([
':objid'             => $objid,
':type'             => $type,
':severity'         => $severity,
':topic'            => $title,
':createdat'        => $created,
':latitude'         => $latitude,
':filename'       => $fileName,
':longitude'        => $longitude,
':locationAddress'  => $locationAddress,
':reportedBy'       => $postedBy,
':date'             => $date,
':time'             => $time,
':mobileno'         => $mobileno,
':remarks'          => $remarks
]);

   $alert_msg .= ' 
       <div class="alert alert-success alert-dismissible">
    <i class="icon fa fa-warning"></i>
    Send Details!
    </div>     
      ';
  $btnStatus = 'disabled';
    $btnNew = 'enabled';
}
?>





