<?php
include('../config/db_config.php');
session_start();

if (isset($_POST['delete_employee_data'])) {
    $emp_id_new = $_POST['emp_id_new2'];

    $delete_emp_sql = "UPDATE tbl_employee_info 
                           SET status = 'DELETE' 
                           WHERE emp_id = :id";

    $delete_emp_data = $con->prepare($delete_emp_sql);
    $success = $delete_emp_data->execute([':id' => $emp_id_new]);

    $delete_user_sql = "UPDATE tbl_users 
                           SET status = 'DELETE' 
                           WHERE emp_id = :id";

    $delete_user_data = $con->prepare($delete_user_sql);
    $success = $delete_user_data->execute([':id' => $emp_id_new]);

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
