<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['update_emp_leavecredits'])) {

    $emp_id_leave = $_POST['emp_id_leave'] ?? null;

    // If employee id is missing
    if (!$emp_id_leave) {
        $_SESSION['status'] = "Missing employee ID.";
        $_SESSION['status_code'] = "error";
        header('Location: list_employee.php');
        exit();
    }

    $success = false;  // Track if anything was updated

    /* ---------------------------
       UPDATE SICK LEAVE BALANCE
    -----------------------------*/
    if (!empty($_POST['emp_new_credits'])) {

        $emp_leave_balance = $_POST['emp_leave_balance'] ?? 0;
        $emp_new_credits = $_POST['emp_new_credits'];

        $new_credits = $emp_leave_balance + $emp_new_credits;

        $sql = "UPDATE tbl_employee_info
                SET leave_balance = :leave_balance
                WHERE emp_id = :emp_id";

        $stmt = $con->prepare($sql);
        $stmt->execute([
            ':leave_balance' => $new_credits,
            ':emp_id'        => $emp_id_leave
        ]);

        if ($stmt->rowCount() > 0) {
            $success = true;
        }
    }


    /* ---------------------------
       UPDATE VACATION LEAVE BALANCE
    -----------------------------*/
    if (!empty($_POST['emp_vacation_credits'])) {

        $emp_vacation_balance = $_POST['emp_vacation_balance'] ?? 0;
        $emp_vacation_credits = $_POST['emp_vacation_credits'];

        $new_credits = $emp_vacation_balance + $emp_vacation_credits;

        $sql = "UPDATE tbl_employee_info
                SET vacation_balance = :vacation_balance
                WHERE emp_id = :emp_id";

        $stmt = $con->prepare($sql);
        $stmt->execute([
            ':vacation_balance' => $new_credits,
            ':emp_id'           => $emp_id_leave
        ]);

        if ($stmt->rowCount() > 0) {
            $success = true;
        }
    }


    /* ---------------------------
       SET APPROPRIATE STATUS MESSAGE
    -----------------------------*/
    if ($success) {
        $_SESSION['status'] = "Leave Balance Updated Successfully!";
        $_SESSION['status_code'] = "success";

    } else {
        $_SESSION['status'] = "No changes made or employee not found.";
        $_SESSION['status_code'] = "info";
    }

}

header('Location: list_employee.php');
exit();
?>
