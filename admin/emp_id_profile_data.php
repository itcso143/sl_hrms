<?php
include('../config/db_config.php');

$emp_id = $_POST['emp_id'] ?? '';

if ($emp_id) {
    $stmt = $con->prepare("SELECT * FROM tbl_employee_info WHERE emp_id = :emp_id");
    $stmt->execute([':emp_id' => $emp_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode([
            'success' => true,
            'data' => $row['emp_id'],
            'data1' => $row['fullname'],
            'data2' => ['netpay' => $row['weekly_salary']] // adjust field names
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Employee not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No employee ID provided']);
}
