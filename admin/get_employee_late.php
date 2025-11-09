<?php
include('../config/db_config.php');

// Check POST parameters
if (isset($_POST['emp_id'], $_POST['date_from'], $_POST['date_to']) && !empty($_POST['emp_id'])) {

    $emp_id = $_POST['emp_id'];
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];

    try {
        // Fetch all logs for the employee between the dates
        $sql = "SELECT t.date_logs, r.sched_in, r.sched_out, t.punch_in, t.punch_out
                FROM tbl_employee_timelogs t
                INNER JOIN tbl_schedule r ON r.schedule_code = t.schedule_code
                WHERE t.emp_id = :emp_id
                  AND t.date_logs BETWEEN :date_from AND :date_to";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ':emp_id' => $emp_id,
            ':date_from' => $date_from,
            ':date_to' => $date_to
        ]);

        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total_minutes = 0; // Combined late + early leave minutes

        foreach ($logs as $log) {
            // Compute late arrival
            if (!empty($log['punch_in']) && $log['punch_in'] > $log['sched_in']) {
                $time_in = new DateTime($log['punch_in']);
                $schedule_in = new DateTime($log['sched_in']);
                $diff = $time_in->diff($schedule_in);
                $minutes_late = ($diff->h * 60) + $diff->i;
                $total_minutes += $minutes_late;
            }

            // Compute early leave
            if (!empty($log['punch_out']) && $log['punch_out'] < $log['sched_out']) {
                $time_out = new DateTime($log['punch_out']);
                $schedule_out = new DateTime($log['sched_out']);
                $diff = $schedule_out->diff($time_out);
                $minutes_early = ($diff->h * 60) + $diff->i;
                $total_minutes += $minutes_early;
            }
        }

        $response = [
            'success' => true,
            'data' => [
                'total_late' => $total_minutes
            ],
            'message' => 'Total deduction (late + early leave) calculated successfully'
        ];

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

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;
