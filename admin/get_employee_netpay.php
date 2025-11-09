<?php
include('../config/db_config.php');

// Ensure the request is POST and emp_id is provided
if (isset($_POST['emp_id']) && !empty($_POST['emp_id'])) {

    $emp_id = $_POST['emp_id'];

    try {
        // Prepare SQL to fetch net pay
        $sql = "SELECT emp_id, net_pay FROM tbl_employee_info WHERE emp_id = :emp_id LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->execute([':emp_id' => $emp_id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $response = [
                'success' => true,
                'data' => [
                    'netpay' => $result['net_pay']
                ],
                'message' => 'Net pay retrieved successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'data' => [],
                'message' => 'Employee not found'
            ];
        }

    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'data' => [],
            'message' => 'Database error: ' . $e->getMessage()
        ];
    }

} else {
    $response = [
        'success' => false,
        'data' => [],
        'message' => 'Invalid request'
    ];
}

// Set JSON header and return response
header('Content-Type: application/json');
echo json_encode($response);
exit;

