<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';

if (isset($_POST['insert_employee_leave'])) {

    $alert_msg = '';
    $date_create = date('Y-m-d');
    $emp_id_leave = $_POST['emp_id_leave'];
    $fullname   = $_POST['fullname'];
    // $leave_creadits   = $_POST['leave_creadits'];
    $get_leave   = $_POST['get_leave'];
    $date_from = DateTime::createFromFormat('Y-m-d', $_POST['date_from']);
    $date_to   = DateTime::createFromFormat('Y-m-d', $_POST['date_to']);
    $leave_reason   = $_POST['leave_reason'];

    $targetDir = "../attached_file_leave/"; // Make sure this folder exists and is writable
    $file = $_FILES['file'];

    $fileName = basename($file['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allowed file types (images + general files)
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'txt', 'xlsx'];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            echo "The file $fileName has been uploaded successfully.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, PNG, GIF, PDF, DOC, DOCX, TXT, and XLSX files are allowed.";
    }
} else {
    echo "No file uploaded.";
}


// ✅ Fixed SQL syntax
$sql = "INSERT INTO tbl_employee_leave_profile 
    (emp_id,date_create, fullname, leave_code, date_from, date_to, leave_reason, attached_file)
    VALUES (:emp_id, :date_create, :fullname, :leave_code, :date_from, :date_to, :leave_reason, :attached_file)";

$stmt = $con->prepare($sql);
$stmt->execute([
    ':emp_id' => $emp_id_leave,
     ':date_create' => $date_create,
    ':fullname' => $fullname,
    ':leave_code' => $get_leave,
    ':date_from' => $date_from->format('Y-m-d'),
    ':date_to' => $date_to->format('Y-m-d'),
    ':leave_reason' => $leave_reason,
    ':attached_file' => $fileName
]);



$alert_msg .= '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-check"></i>
            <strong> Success! </strong> Data Inserted.
        </div>';



header('location: list_leave_profile.php?');
