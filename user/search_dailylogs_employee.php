<?php
include('../config/db_config.php');
session_start();

// Fetch current user
$user_id = $_SESSION['id'];
$get_user_sql = "SELECT emp_id FROM tbl_users WHERE id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
$user = $user_data->fetch(PDO::FETCH_ASSOC);
$emp_id = $user['emp_id'] ?? '';

$requestData = $_REQUEST;

// Define columns
$columns = [
    0 => 'date_logs',
    1 => 'emp_id',
    2 => 'schedule_code',
    3 => 'punch_in',
    4 => 'punch_out',
    5 => 'late'
];

// COUNT total records
$sql_count = "SELECT COUNT(*) as total FROM tbl_employee_timelogs WHERE emp_id = :emp_id";
$stmt = $con->prepare($sql_count);
$stmt->execute([':emp_id' => $emp_id]);
$totalData = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalFiltered = $totalData;

// Base query
$sql = "
    SELECT 
        emp_id,
        schedule_code,
        date_logs,
        late,
        MIN(punch_in) AS punch_in,
        MAX(punch_out) AS punch_out,
        MIN(break_in) AS break_in,
        MAX(break_out) AS break_out,
        MIN(lunch_in) AS lunch_in,
        MAX(lunch_out) AS lunch_out
    FROM tbl_employee_timelogs
    WHERE emp_id = :emp_id
";

// Apply search if exists
$search = trim($requestData['search']['value'] ?? '');
if (!empty($search)) {
    $sql .= " AND (emp_id LIKE :search OR date_logs LIKE :search)";
}

// Grouping
$sql .= " GROUP BY date_logs, emp_id, schedule_code, late";

// Ordering
$orderColumn = $columns[$requestData['order'][0]['column']] ?? 'date_logs';
$orderDir = $requestData['order'][0]['dir'] ?? 'DESC';
$sql .= " ORDER BY $orderColumn $orderDir";

// Pagination
$start = intval($requestData['start'] ?? 0);
$length = intval($requestData['length'] ?? 10);
$sql .= " LIMIT :start, :length";

$stmt = $con->prepare($sql);

// Bind parameters
$stmt->bindValue(':emp_id', $emp_id, PDO::PARAM_STR);
if (!empty($search)) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':length', $length, PDO::PARAM_INT);
$stmt->execute();

$data = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = [];
    $nestedData[] = $row["emp_id"];
    $nestedData[] = strtoupper($row["schedule_code"]);
    $nestedData[] = $row["date_logs"];
    $nestedData[] = $row["punch_in"];
    $nestedData[] = $row["punch_out"];
    $nestedData[] = '<span style="color:red;">' . $row["late"] . '</span>';
    $data[] = $nestedData;
}

// Total filtered count (if search applied)
if (!empty($search)) {
    $count_sql = "
        SELECT COUNT(DISTINCT date_logs) as total
        FROM tbl_employee_timelogs
        WHERE emp_id = :emp_id AND (emp_id LIKE :search OR date_logs LIKE :search)
    ";
    $count_stmt = $con->prepare($count_sql);
    $count_stmt->execute([':emp_id' => $emp_id, ':search' => "%$search%"]);
    $totalFiltered = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// Final JSON response
$json_data = [
    "draw"            => intval($requestData['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
];

echo json_encode($json_data);
?>
