<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['update_emp_leavecredits'])) {

    // Validate input
    if (!empty($_POST['emp_id_leave']) && !empty($_POST['emp_new_credits'])) {

        $emp_id_leave = $_POST['emp_id_leave'];
        $emp_leave_balance = $_POST['emp_leave_balance'];
        $emp_new_credits = $_POST['emp_new_credits'];

        $new_credits = $emp_leave_balance + $emp_new_credits;
        // Update only the schedule_code for the employee
        $employee_sql = "UPDATE tbl_employee_info 
                         SET leave_balance = :leave_balance
                         WHERE emp_id = :emp_id";

        $employee_data_sickleave = $con->prepare($employee_sql);
        $employee_data_sickleave->execute([
            ':leave_balance' => $new_credits,
            ':emp_id' => $emp_id_leave
        ]);

      
    }
    
     if (!empty($_POST['emp_id_leave']) && !empty($_POST['emp_vacation_credits'])) {

        $emp_id_leave = $_POST['emp_id_leave'];
        $emp_vacation_balance = $_POST['emp_vacation_balance'];
        $emp_vacation_credits = $_POST['emp_vacation_credits'];

        $new_credits = $emp_vacation_balance + $emp_vacation_credits;
        // Update only the schedule_code for the employee
        $employee_sql = "UPDATE tbl_employee_info 
                         SET vacation_balance = :vacation_balance
                         WHERE emp_id = :emp_id";

        $employee_data_vacation = $con->prepare($employee_sql);
        $employee_data_vacation->execute([
            ':vacation_balance' => $new_credits,
            ':emp_id' => $emp_id_leave
        ]);
  }


        // Check if any rows were affected
        if ($employee_data_sickleave && $employee_data_vacation->rowCount() > 0) {
            $_SESSION['status'] = "Leave Balance Updated Successfully!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "No changes made or employee not found.";
            $_SESSION['status_code'] = "info";
        }
    }
    else {
        $_SESSION['status'] = "Missing employee ID or new balance.";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_employee.php');
    exit();

