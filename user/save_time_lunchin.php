<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
session_start();
if (isset($_POST['emp_id']) && isset($_POST['lunch_in']) && isset($_POST['logs_id'])) {

    $user_id = $_SESSION['id'];
    $logs_id = $_POST['logs_id'];
    $username = '';

    $date_logs = '';
    $date_logs1 = '';

    // //fetch user from database
    $get_user_sql = " SELECT username,emp_id FROM tbl_users where id = :id";
    $user_data = $con->prepare($get_user_sql);
    $user_data->execute([':id' => $user_id]);
    while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
        $username = strtoupper($result4['username']);
        $emp_id = $result4['emp_id'];

        $get_user_sql = " SELECT emp_id,schedule_code FROM tbl_employee_info where emp_id = :emp_id";
        $user_data = $con->prepare($get_user_sql);
        $user_data->execute([':emp_id' => $emp_id]);
        while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
            $schedule_code = $result4['schedule_code'];
        }


        $date_logs = date('Y-m-d');
        $date_punch_in = date('Y-m-d');
        $emp_id = $_POST['emp_id'];
        $sched_id = "A1";
        $lunch_in = date('H:i:s'); // 24-hour format: HH:MM:SS

        $time_logs_sql = "INSERT INTO tbl_employee_timelogs SET 
        emp_id = :emp_id,
        date_logs = :date_logs,
         logs_id = :logs_id,
      
        lunch_in = :lunch_in,
        schedule_code = :schedule_code
    ";

        $time_logs_data = $con->prepare($time_logs_sql);
        $time_logs_data->execute([
            ':emp_id'   => $emp_id,
            ':date_logs'   => $date_logs,
            ':logs_id'   => $logs_id,
            ':lunch_in' => $lunch_in,
            ':schedule_code' => $schedule_code
        ]);
    }
    echo json_encode([
        'status' => 'success',
        'message' => 'Lunch In saved successfully!'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required data'
    ]);
}
