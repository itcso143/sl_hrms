<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['update_employee_schedule'])) {

    // Validate input
    if (!empty($_POST['emp_id']) && !empty($_POST['get_schedule'])) {

        $emp_id = $_POST['emp_id'];
        $schedule_code = $_POST['get_schedule'];

        // Update only the schedule_code for the employee
        $employee_sql = "UPDATE tbl_employee_info 
                         SET schedule_code = :schedule_code
                         WHERE emp_id = :emp_id";

        $employee_data = $con->prepare($employee_sql);
        $employee_data->execute([
            ':schedule_code' => $schedule_code,
            ':emp_id' => $emp_id
        ]);

        // Check if any rows were affected
        if ($employee_data->rowCount() > 0) {
            $_SESSION['status'] = "Updated Successfully!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "No changes made or employee not found.";
            $_SESSION['status_code'] = "info";
        }
    } else {
        $_SESSION['status'] = "Missing employee ID or schedule code.";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_employee.php');
    exit();
}
?>

