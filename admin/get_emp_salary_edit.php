<?php
include('../config/db_config.php');

// Ensure the request is POST and emp_id is provided
if (isset($_POST['salary_id']) && !empty($_POST['salary_id'])) {

    $salary_id = $_POST['salary_id'];

    try {
        // Prepare SQL to fetch net pay
        $sql = "SELECT * FROM tbl_emp_salary WHERE salary_id = :salary_id LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->execute([':salary_id' => $salary_id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $response = [
                'success' => true,
                'data' => [
                    'fullname_salary' => $result['fullname_salary'],
                    'emp_late_deduction' => $result['emp_late_deduction']
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
