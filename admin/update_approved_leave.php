<?php
include('../config/db_config.php');
date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['update_approved_leave'])) {

    if (!empty($_POST['emp_id_view']) && !empty($_POST['leave_code_view'])) {


        $leave_id_view = $_POST['leave_id_view'];
        $emp_id_view = $_POST['emp_id_view'];                // employee ID
        $leave_used   = (int) $_POST['leave_deduction_view'];  // leave to deduct
        $leave_used_vacation   = (int) $_POST['leave_deduction_view'];
        $leave_code_view = $_POST['leave_code_view'];


        $leave_sick_balance = $_POST['leave_sick_balance'];
        $leave_vacation_balance = $_POST['leave_vacation_balance'];

        if ($leave_code_view === 'Sick Leave') {
            // GET EMPLOYEE LEAVE BALANCE
            $get_emp_info_sql = "SELECT leave_balance FROM tbl_employee_info WHERE emp_id = :emp_id";
            $stmt = $con->prepare($get_emp_info_sql);
            $stmt->execute([':emp_id' => $emp_id_view]);

            $emp = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$emp) {
                $_SESSION['status'] = "Employee not found!";
                $_SESSION['status_code'] = "error";
                header("Location: list_employee.php");
                exit();
            }

            $leave_balance = (int)$emp['leave_balance'];
            $leave_deduction = max(0, $leave_balance - $leave_used);

            // 1. UPDATE LEAVE STATUS IN LEAVE PROFILE
            $update_profile_sql = "UPDATE tbl_employee_leave_profile 
                               SET status_leave = :status_leave
                               WHERE id = :id";

            $update_profile_stmt = $con->prepare($update_profile_sql);
            $update_profile_stmt->execute([
                ':status_leave' => 'APPROVED',
                ':id'       => $leave_id_view
            ]);

            // 2. UPDATE LEAVE BALANCE IN EMPLOYEE INFO
            $update_leave_sql = "UPDATE tbl_employee_info 
                             SET leave_balance = :leave_balance
                             WHERE emp_id = :emp_id";

            $update_leave_stmt = $con->prepare($update_leave_sql);
            $update_leave_stmt->execute([
                ':leave_balance' => $leave_deduction,
                ':emp_id'        => $emp_id_view
            ]);
        }



        if ($leave_code_view === 'Vacation Leave') {
            // GET EMPLOYEE LEAVE BALANCE
            $get_emp_info_sql = "SELECT vacation_balance FROM tbl_employee_info WHERE emp_id = :emp_id";
            $stmt = $con->prepare($get_emp_info_sql);
            $stmt->execute([':emp_id' => $emp_id_view]);

            $emp = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$emp) {
                $_SESSION['status'] = "Employee not found!";
                $_SESSION['status_code'] = "error";
                header("Location: list_employee.php");
                exit();
            }

            $leave_vacation_balance = (int)$emp['vacation_balance'];
            $leave_vacation_deduction = max(0, $leave_vacation_balance - $leave_used_vacation);

            // 1. UPDATE LEAVE STATUS IN LEAVE PROFILE
            $update_profile_sql = "UPDATE tbl_employee_leave_profile 
                               SET status_leave = :status_leave
                               WHERE id = :id";

            $update_profile_stmt = $con->prepare($update_profile_sql);
            $update_profile_stmt->execute([
                ':status_leave' => 'APPROVED',
                ':id'       => $leave_id_view
            ]);

            // 2. UPDATE LEAVE BALANCE IN EMPLOYEE INFO
            $update_leave_sql = "UPDATE tbl_employee_info 
                             SET vacation_balance = :vacation_balance
                             WHERE emp_id = :emp_id";

            $update_leave_stmt = $con->prepare($update_leave_sql);
            $update_leave_stmt->execute([
                ':vacation_balance' => $leave_vacation_deduction,
                ':emp_id'        => $emp_id_view
            ]);
        }
        // SUCCESS OR FAILURE MESSAGE
        if ($update_profile_stmt->rowCount() > 0 || $update_leave_stmt->rowCount() > 0) {
            $_SESSION['status'] = "Leave approved and balance updated!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "No changes made.";
            $_SESSION['status_code'] = "info";
        }
    } else {
        $_SESSION['status'] = "Missing employee ID.";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_leave_profile.php');
    exit();
}
