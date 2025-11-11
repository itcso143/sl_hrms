<?php
include('../config/db_config.php');
session_start();

$requestData = $_REQUEST;

// -----------------------------------------
// Column mapping for ordering
// -----------------------------------------
$columns = array(
    0 => 't.emp_id',
    1 => 'r.fullname',
    2 => 't.schedule_code',
    3 => 't.date_logs',
    4 => 't.punch_in',
    5 => 't.punch_out',
    6 => 't.late',
    7 => 't.overtime_in',
    8 => 't.overtime_out'
);

// -----------------------------------------
// 1️⃣ Count total records (no filtering)
// -----------------------------------------
$sql = "SELECT COUNT(DISTINCT t.date_logs, t.emp_id) as total FROM tbl_employee_timelogs t";
$stmt = $con->prepare($sql);
$stmt->execute();
$totalData = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalFiltered = $totalData;

// -----------------------------------------
// 2️⃣ Base query
// -----------------------------------------
$sql = "SELECT 
            t.emp_id,
            t.schedule_code,
            t.date_logs,
            MIN(t.punch_in) AS punch_in,
            MAX(t.punch_out) AS punch_out,
            t.late,
            t.overtime_in,
            t.overtime_out,
            r.fullname
        FROM tbl_employee_timelogs t
        LEFT JOIN tbl_employee_info r ON r.emp_id = t.emp_id
        WHERE 1=1";

// -----------------------------------------
// 3️⃣ Filtering
// -----------------------------------------
if (!empty($requestData['search']['value'])) {
    $search = "%" . $requestData['search']['value'] . "%";
    $sql .= " AND (t.emp_id LIKE :search 
                OR t.date_logs LIKE :search 
                OR r.fullname LIKE :search)";
}

// -----------------------------------------
// 4️⃣ Grouping (important for MIN/MAX)
// -----------------------------------------
$sql .= " GROUP BY t.emp_id, t.date_logs";

// -----------------------------------------
// 5️⃣ Ordering
// -----------------------------------------
if (!empty($requestData['order'][0]['column'])) {
    $orderColIndex = intval($requestData['order'][0]['column']);
    $orderDir = strtoupper($requestData['order'][0]['dir']) === 'ASC' ? 'ASC' : 'DESC';
    $orderCol = $columns[$orderColIndex] ?? 't.date_logs';
    $sql .= " ORDER BY $orderCol $orderDir";
} else {
    $sql .= " ORDER BY t.date_logs DESC";
}

// -----------------------------------------
// 6️⃣ Pagination
// -----------------------------------------
$start = intval($requestData['start']);
$length = intval($requestData['length']);
$sql .= " LIMIT $start, $length";

// -----------------------------------------
// 7️⃣ Prepare and bind parameters
// -----------------------------------------
$stmt = $con->prepare($sql);

if (!empty($requestData['search']['value'])) {
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
}

$stmt->execute();
$data = [];

// -----------------------------------------
// 8️⃣ Count filtered data
// -----------------------------------------
if (!empty($requestData['search']['value'])) {
    $countSql = "SELECT COUNT(DISTINCT t.date_logs, t.emp_id) as total
                 FROM tbl_employee_timelogs t
                 LEFT JOIN tbl_employee_info r ON r.emp_id = t.emp_id
                 WHERE (t.emp_id LIKE :search 
                     OR t.date_logs LIKE :search 
                     OR r.fullname LIKE :search)";
    $countStmt = $con->prepare($countSql);
    $countStmt->bindParam(':search', $search, PDO::PARAM_STR);
    $countStmt->execute();
    $totalFiltered = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// -----------------------------------------
// 9️⃣ Build response rows
// -----------------------------------------
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = [];
    $nestedData[] = '<div style="text-align:center;">' . htmlspecialchars($row["emp_id"]) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . strtoupper(htmlspecialchars($row["fullname"])) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . strtoupper(htmlspecialchars($row["schedule_code"])) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . htmlspecialchars($row["date_logs"]) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . htmlspecialchars($row["punch_in"]) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . htmlspecialchars($row["punch_out"]) . '</div>';
    $nestedData[] = '<div style="text-align:center; color:red;">' . htmlspecialchars($row["late"]) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . htmlspecialchars($row["overtime_in"]) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . htmlspecialchars($row["overtime_out"]) . '</div>';

    $data[] = $nestedData;
}

// -----------------------------------------
// 🔟 Return JSON to DataTables
// -----------------------------------------
$json_data = array(
    "draw"            => intval($requestData['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
);

echo json_encode($json_data);
?>
