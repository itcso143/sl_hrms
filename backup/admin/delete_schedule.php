<?php
include('../config/db_config.php');
session_start();

if (isset($_POST['delete_schedule'])) {
    $sched_code = $_POST['sched_code'];

    $delete_sched_sql = "UPDATE tbl_schedule 
                           SET status = 'DELETE' 
                           WHERE schedule_code = :sched_code";

    $delete_sched_data = $con->prepare($delete_sched_sql);
    $success = $delete_sched_data->execute([':sched_code' => $sched_code]);

    if ($success) {
        $_SESSION['status'] = "Deleted Successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Delete Failed!";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_schedule.php');
    exit();
}
?>
