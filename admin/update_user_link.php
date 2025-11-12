<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['update_user_link'])) {

    // Validate input
    if (!empty($_POST['emp_id_livestream'])) {

        $emp_id_livestream = $_POST['emp_id_livestream'];
        $fullname_livestream = $_POST['fullname_livestream'];
        $link_livestream = $_POST['link_livestream'];
        $emp_schedule_code = $_POST['emp_schedule_code'];


        // Insert a new livestream link record
        $insert_sql = "INSERT INTO tbl_livestream_link (emp_id_livestream, fullname_livestream, link_livestream,emp_schedule_code)
               VALUES (:emp_id_livestream, :fullname_livestream, :link_livestream, :emp_schedule_code)";

        $insert_stmt = $con->prepare($insert_sql);
        $insert_stmt->execute([
            ':emp_id_livestream' => $emp_id_livestream,
            ':fullname_livestream' => $fullname_livestream,
            ':link_livestream' => $link_livestream,
            ':emp_schedule_code' => $emp_schedule_code
        ]);

        // Check if any rows were affected
        if ($insert_stmt->rowCount() > 0) {
            $_SESSION['status'] = "Save Successfully!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "No changes made or employee not found.";
            $_SESSION['status_code'] = "info";
        }
    } else {
        $_SESSION['status'] = "Missing employee ID or emp_id.";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_employee.php');
    exit();
}
