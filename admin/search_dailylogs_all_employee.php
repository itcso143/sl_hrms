<?php
include('../config/db_config.php');
session_start();

$columns = array(
    0 => 'date_logs',
    1 => 'emp_id',
    2 => 'fullname',
    3 => 'punch_in',
    4 => 'punch_out',
    5 => 'ot_time_in',
    6 => 'ot_time_out'
);

// Store request
$requestData = $_REQUEST;

// === SQL to fetch logs with employee info ===
$get_employee_sql = "
SELECT t.date_logs, t.punch_in, t.punch_out, t.break_in, t.break_out, t.lunch_in, t.lunch_out, t.late,
       e.fullname
FROM tbl_employee_timelogs t
LEFT JOIN tbl_employee_info e ON e.emp_id = t.emp_id
ORDER BY t.id DESC
";
$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute();

// === Count total records ===
$countNoFilter = "SELECT COUNT(id) AS id FROM tbl_employee_timelogs";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute();
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
$totalFiltered = $totalData;

// === Helper function to format time ===
if (!function_exists('formatTime')) {
    function formatTime($time)
    {
        if ($time == "00:00:00" || empty($time)) {
            return "";
        }
        return date("h:i A", strtotime($time)); // 12-hour format with AM/PM
    }
}

$data = array();

while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();
    $nestedData[] = $row["date_logs"];
    $nestedData[] = $row["fullname"] ?? ''; // ensure it exists
    $nestedData[] = formatTime($row["punch_in"]);
    $nestedData[] = formatTime($row["punch_out"]);
    $nestedData[] = formatTime($row["break_in"]);
    $nestedData[] = formatTime($row["break_out"]);
    $nestedData[] = formatTime($row["lunch_in"]);
    $nestedData[] = formatTime($row["lunch_out"]);
    $nestedData[] = '<span style="color:red;">' . $row["late"] . '</span>';

    $data[] = $nestedData;
}

$json_data = array(
    "draw"            => intval($requestData['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
);

echo json_encode($json_data);
?>
