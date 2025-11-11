<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');

if (isset($_POST['emp_id']) && isset($_POST['break_in'])) {
    $date_logs = date('Y-m-d');
    $emp_id = $_POST['emp_id'];
    $break_in = date('H:i:s'); // 24-hour format: HH:MM:SS

    $get_sched_sql = "SELECT * FROM tbl_employee_timelogs where emp_id = :emp_id ORDER BY date_logs DESC LIMIT 1";
    $get_sched_data = $con->prepare($get_sched_sql);
    $get_sched_data->execute([':emp_id' => $emp_id]);
    while ($result4 = $get_sched_data->fetch(PDO::FETCH_ASSOC)) {

        $logs_id = $result4['id'];
    
    }
    // Update statement
    $time_logs_sql = "
        UPDATE tbl_employee_timelogs
        SET break_in = :break_in
        WHERE emp_id = :emp_id AND id = :id
    ";

    $time_logs_data = $con->prepare($time_logs_sql);
    $time_logs_data->execute([
        ':break_in' => $break_in,
        ':emp_id'    => $emp_id,
        ':id' => $logs_id
    ]);

    echo json_encode([
        'status' => 'success',
        'message' => 'Break In saved successfully!'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required data'
    ]);
}
