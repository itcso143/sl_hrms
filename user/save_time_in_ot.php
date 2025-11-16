<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['emp_id_2'])) {


    $user_id = $_SESSION['id'];

    $username = '';


    $emp_id_2 = $_POST['emp_id_2'];
    $logs_id = uniqid();
    $time = date("i:s");

    $date_logs = date('Y-m-d');
    $time_in = date('H:i:s'); // 24-hour format: HH:MM:SS
    // //fetch user from database
    $get_user_sql = " SELECT username,emp_id FROM tbl_users where id = :id";
    $user_data = $con->prepare($get_user_sql);
    $user_data->execute([':id' => $user_id]);
    while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
        $username = strtoupper($result4['username']);
        $emp_id = $result4['emp_id'];

        $get_user_sql = "SELECT sched_emp,ot_code FROM tbl_emp_overtime WHERE sched_emp = :emp_id order by id DESC LIMIT 1";
        $user_data = $con->prepare($get_user_sql);
        $user_data->execute([':emp_id' => $emp_id]);
        while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
            $sched_emp = $result4['sched_emp'];
            $schedule_code = $result4['ot_code'];
        }
    }

    $employee_sql = "UPDATE tbl_emp_overtime 
    SET 
        emp_id = :emp_id,
        ot_logs_id = :ot_logs_id,
        date_logs = :date_logs,
        ot_time_in = :ot_time_in
    WHERE ot_code = '$schedule_code'";

    $employee_data = $con->prepare($employee_sql);

    $employee_data->execute([

        ':emp_id'      => $emp_id,   // <-- FIXED
        ':ot_logs_id'  => $date_logs . '-' . $logs_id . '-' . $time, // cleaner format
        ':date_logs'   => $date_logs,
        ':ot_time_in'  => $time_in

    ]);

    echo json_encode([
        'status' => 'success',
        'message' => 'Over Time In saved successfully!'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required data'
    ]);
}
