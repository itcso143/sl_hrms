<?php
include('../config/db_config.php');
session_start();

if (isset($_POST['delete_payslip_monthly'])) {
    $salary_id = $_POST['salary_id'];

    $update_payslip_sql = "UPDATE tbl_emp_salary 
                           SET status = 'DELETE' 
                           WHERE salary_id = :id";

    $update_payslip_data = $con->prepare($update_payslip_sql);
    $success = $update_payslip_data->execute([':id' => $salary_id]);

    if ($success) {
        $_SESSION['status'] = "Deleted Successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Delete Failed!";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_monthly_payslip.php');
    exit();
}
?>
