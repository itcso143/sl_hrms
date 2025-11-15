<?php
include('../config/db_config.php');
date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['update_approved_leave'])) {

    if (!empty($_POST['emp_id_view']) && !empty($_POST['leave_code_view'])) {

        $leave_id = $_POST['leave_id_view'];
        $emp_id   = $_POST['emp_id_view'];

        // force numeric value
        $leave_used = isset($_POST['leave_deduction_view']) ? (float) $_POST['leave_deduction_view'] : 0;

        // normalize leave type
        $leave_code = strtolower(trim($_POST['leave_code_view']));

        try {

            $con->beginTransaction();

            if ($leave_code === 'sick leave') {

                $stmt = $con->prepare("SELECT leave_balance FROM tbl_employee_info WHERE emp_id = :emp_id");
                $stmt->execute([':emp_id' => $emp_id]);
                $emp = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$emp) throw new Exception("Employee not found.");

                $old = (float)$emp['leave_balance'];
                $new = max(0, $old - $leave_used);

                // Log for debugging
                error_log("SL: emp_id=$emp_id old=$old used=$leave_used new=$new");

                $update_profile = $con->prepare("UPDATE tbl_employee_leave_profile 
                    SET status_leave = 'APPROVED' WHERE id = :id");
                $update_profile->execute([':id' => $leave_id]);

                $update_balance = $con->prepare("UPDATE tbl_employee_info 
                    SET leave_balance = :bal WHERE emp_id = :emp_id");
                $update_balance->execute([':bal' => $new, ':emp_id' => $emp_id]);

            } elseif ($leave_code === 'vacation leave') {

                $stmt = $con->prepare("SELECT vacation_balance FROM tbl_employee_info WHERE emp_id = :emp_id");
                $stmt->execute([':emp_id' => $emp_id]);
                $emp = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$emp) throw new Exception("Employee not found.");

                $old = (float)$emp['vacation_balance'];
                $new = max(0, $old - $leave_used);

                error_log("VL: emp_id=$emp_id old=$old used=$leave_used new=$new");

                $update_profile = $con->prepare("UPDATE tbl_employee_leave_profile 
                    SET status_leave = 'APPROVED' WHERE id = :id");
                $update_profile->execute([':id' => $leave_id]);

                $update_balance = $con->prepare("UPDATE tbl_employee_info 
                    SET vacation_balance = :bal WHERE emp_id = :emp_id");
                $update_balance->execute([':bal' => $new, ':emp_id' => $emp_id]);

            } else {
                throw new Exception("Invalid leave type: $leave_code");
            }

            $con->commit();

            $_SESSION['status'] = "Leave approved and deducted successfully!";
            $_SESSION['status_code'] = "success";

        } catch (Exception $e) {
            $con->rollBack();
            $_SESSION['status'] = "ERROR: " . $e->getMessage();
            $_SESSION['status_code'] = "error";
        }

    } else {
        $_SESSION['status'] = "Missing required fields.";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_leave_profile.php');
    exit();
}

?>
