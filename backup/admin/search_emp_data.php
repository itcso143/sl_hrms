<?php
include('../config/db_config.php');

$limit = 20;

// Initialize search term safely
$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';

try {
    if ($searchTerm === '') {
        // Default query (no search)
        $sql = "
            SELECT emp_id, fullname 
            FROM tbl_employee_info 
            ORDER BY lastname 
            LIMIT :limit
        ";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    } else {
        // Search query
        $sql = "
            SELECT emp_id, fullname 
            FROM tbl_employee_info 
            WHERE fullname LIKE :search
               OR emp_id LIKE :search
               OR CONCAT(firstname, ' ', middlename, ' ', lastname) LIKE :search
               OR CONCAT(firstname, ' ', lastname) LIKE :search
               OR CONCAT(lastname, ' ', firstname) LIKE :search
            ORDER BY fullname 
            LIMIT :limit
        ";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':search', "%{$searchTerm}%", PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    }

    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Build JSON response for Select2
    $response = [];
    foreach ($users as $user) {
        $response[] = [
            'id'   => htmlspecialchars($user['emp_id'], ENT_QUOTES, 'UTF-8'),
            'text' => htmlspecialchars($user['emp_id'] . ' - ' . $user['fullname'], ENT_QUOTES, 'UTF-8'),
        ];
    }

    // Return JSON
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
} catch (PDOException $e) {
    // Error handling (optional)
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => $e->getMessage()]);
}

exit;
?>
