<?php
include('../config/db_config.php');
session_start();

$columns = array(
    0 =>  'date_logs',
    1 => 'emp_id',
    2 => 'fullname',
    3 => 'time_in',
    4 => 'time_out',
    5 => 'ot_time_in',
    6 => 'ot_time_out'
);

$user_id = $_SESSION['id'];
$get_user_sql = "SELECT * FROM tbl_users WHERE id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);

$result = $user_data->fetch(PDO::FETCH_ASSOC);
$emp_id = $result['emp_id'];

// store request
$requestData = $_REQUEST;

$get_employee_sql = "SELECT t.id,r.fullname,t.date_logs,t.emp_id,t.ot_code,t.ot_logs_id,t.ot_time_in,t.ot_time_out,t.ot_late,t.ot_undertime
                     FROM tbl_emp_overtime t LEFT JOIN tbl_employee_info r ON r.emp_id = t.emp_id
                     WHERE t.emp_id = :emp_id 
                     ORDER BY t.id DESC";
$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute([':emp_id' => $emp_id]);

$countNoFilter = "SELECT COUNT(id) AS id FROM tbl_employee_info";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_emp_overtimelogs.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
$totalFiltered = $totalData;

// === Helper function to format time ===
function formatTime($time)
{
    // Replace '00:00:00' or empty values with your preferred default
    if ($time == "00:00:00" || empty($time)) {
        return "";
    }
    return date("h:i A", strtotime($time));
}

$data = array();

while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();
    $nestedData[] = $row["date_logs"];
    $nestedData[] = $row["fullname"];
    $nestedData[] = $row["ot_logs_id"];
    $nestedData[] = $row["ot_code"];
    $nestedData[] = formatTime($row["ot_time_in"]);
    $nestedData[] = formatTime($row["ot_time_out"]);
    // $nestedData[] = formatTime($row["break_in"]);
    // $nestedData[] = formatTime($row["break_out"]);
    // $nestedData[] = formatTime($row["lunch_in"]);
    // $nestedData[] = formatTime($row["lunch_out"]);
    $nestedData[] = '<span style="color:red;">' . $row["ot_late"] . '</span>';
    $nestedData[] = '<span style="color:red;">' . $row["ot_undertime"] . '</span>';

    $data[] = $nestedData;
}

$json_data = array(
    "draw"            => intval($requestData['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
);

echo json_encode($json_data);
