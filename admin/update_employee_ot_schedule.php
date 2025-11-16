<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['update_employee_ot_schedule'])) {

    // Validate input
    if (!empty($_POST['emp_ot_id']) && !empty($_POST['get_ot_schedule'])) {

        $emp_id = $_POST['emp_ot_id'];
         $sched_code = $_POST['get_ot_schedule'];
        $sched_date_from = $_POST['date_from_ot'];
        $sched_date_to = $_POST['date_to_ot'];
        $sched_time_from = $_POST['sched_ot_time_in'];
        $sched_time_to = $_POST['sched_ot_time_out'];
        // Update only the schedule_code for the employee
        $add_ot_sched_sql = "INSERT INTO tbl_emp_overtime
                    (ot_code, sched_emp, sched_date_from, sched_date_to, sched_time_from, sched_time_to)
                 VALUES
                    (:ot_code, :sched_emp, :sched_date_from, :sched_date_to, :sched_time_from, :sched_time_to)";

        $add_ot_sched = $con->prepare($add_ot_sched_sql);
        $add_ot_sched->execute([
            ':ot_code'   => $sched_code,
            ':sched_date_from'   => $sched_date_from,
            ':sched_date_to'   => $sched_date_to,
            ':sched_time_from'   => $sched_time_from,
            ':sched_time_to'   => $sched_time_to,
            ':sched_emp' => $emp_id
        ]);

        // Check if any rows were affected
        if ($add_ot_sched->rowCount() > 0) {
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
