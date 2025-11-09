<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');

if (isset($_POST['emp_id']) && isset($_POST['time_out'])) {
    $date_logs = date('Y-m-d');
    $emp_id = $_POST['emp_id'];
    $time_out = date('H:i:s'); // 24-hour format: HH:MM:SS

    // Update statement
    $time_logs_sql = "
        UPDATE tbl_employee_timelogs
        SET punch_out = :punch_out
        WHERE emp_id = :emp_id AND date_logs = :date_logs
    ";

    $time_logs_data = $con->prepare($time_logs_sql);
    $time_logs_data->execute([
        ':punch_out' => $time_out,
        ':emp_id'    => $emp_id,
        ':date_logs' => $date_logs
    ]);

    echo json_encode([
        'status' => 'success',
        'message' => 'Time Out saved successfully!'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required data'
    ]);
}
