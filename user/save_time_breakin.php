<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');

if (isset($_POST['emp_id']) && isset($_POST['break_in'])) {
    $date_logs = date('Y-m-d');
    $emp_id = $_POST['emp_id'];
    $break_in = date('H:i:s'); // 24-hour format: HH:MM:SS

    // Update statement
    $time_logs_sql = "
        UPDATE tbl_employee_timelogs
        SET break_in = :break_in
        WHERE emp_id = :emp_id AND date_logs = :date_logs
    ";

    $time_logs_data = $con->prepare($time_logs_sql);
    $time_logs_data->execute([
        ':break_in' => $break_in,
        ':emp_id'    => $emp_id,
        ':date_logs' => $date_logs
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
