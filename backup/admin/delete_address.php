<?php
include('../config/db_config.php');
session_start();

if (isset($_POST['delete_address'])) {
    $company_id = $_POST['company_id'];

    $delete_address_sql = "UPDATE tbl_company 
                           SET status = 'DELETE' 
                           WHERE id = :id";

    $delete_sched_data = $con->prepare($delete_address_sql);
    $success = $delete_sched_data->execute([':id' => $company_id]);

    if ($success) {
        $_SESSION['status'] = "Deleted Successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Delete Failed!";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_address.php');
    exit();
}
?>
