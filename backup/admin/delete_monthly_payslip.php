<?php
include('../config/db_config.php');
session_start();

if (isset($_POST['delete_monthly_payslip'])) {
    $emp_id_new = $_POST['emp_id_new'];

    $delete_emp_sql = "UPDATE tbl_emp_salary 
                           SET status = 'DELETE' 
                           WHERE id = :id";

    $delete_emp_data = $con->prepare($delete_emp_sql);
    $success = $delete_emp_data->execute([':id' => $emp_id_new]);

    if ($success) {
        $_SESSION['status'] = "Deleted Successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Delete Failed!";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_employee.php');
    exit();
}
?>
