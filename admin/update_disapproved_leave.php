<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Make sure sessions are started

include('../config/db_config.php');
date_default_timezone_set('Asia/Manila');

if (isset($_POST['update_disapproved_leave'])) {

    // Check if leave_id_view is provided
    if (!empty($_POST['leave_id_view'])) {

        $leave_id_view = $_POST['leave_id_view'];

        // 1. UPDATE LEAVE STATUS IN LEAVE PROFILE
        $update_profile_sql = "UPDATE tbl_employee_leave_profile 
                               SET status_leave = :status_leave
                               WHERE id = :id";

        $update_profile_stmt = $con->prepare($update_profile_sql);
        $update_profile_stmt->execute([
            ':status_leave' => 'DISAPPROVED',
            ':id'           => $leave_id_view
        ]);

        // SUCCESS OR FAILURE MESSAGE
        if ($update_profile_stmt->rowCount() > 0) {
            $_SESSION['status'] = "Leave has been disapproved successfully!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "No changes were made to the leave status.";
            $_SESSION['status_code'] = "info";
        }

    } else {
        $_SESSION['status'] = "Missing leave ID.";
        $_SESSION['status_code'] = "error";
    }

    // Redirect back to leave list
    header('Location: list_leave_profile.php');
    exit();
}
