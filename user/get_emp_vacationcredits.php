<?php
include('../config/db_config.php');

// Check POST parameters
if (isset($_POST['emp_id_leave'])) {

    $emp_id_leave = $_POST['emp_id_leave'];

    try {
        // Prepare SQL with placeholder
        $sql = "SELECT vacation_balance FROM tbl_employee_info WHERE emp_id = :emp_id LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->execute([':emp_id' => $emp_id_leave]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $response = [
                'success' => true,
                'data' => [
                    'vacation_balance' => $row['vacation_balance']
                ],
                'message' => 'Vacation balance retrieved successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'data' => [],
                'message' => 'Employee not found.'
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
        'message' => 'Invalid request: emp_id_leave missing.'
    ];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
