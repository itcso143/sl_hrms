<?php
include('../config/db_config.php');
session_start();

if (isset($_POST['delete_payslip'])) {
    $payslip_id = $_POST['payslip_id'];

    $update_payslip_sql = "UPDATE tbl_weekly_payslip 
                           SET status = 'DELETE' 
                           WHERE payroll_id = :id";

    $update_payslip_data = $con->prepare($update_payslip_sql);
    $success = $update_payslip_data->execute([':id' => $payslip_id]);

    if ($success) {
        $_SESSION['status'] = "Deleted Successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Delete Failed!";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_weekly_payslip.php');
    exit();
}
?>
