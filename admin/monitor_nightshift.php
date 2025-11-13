<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');

$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('-1 day'));

// Format time helper function
function formatTime($time)
{
    if (empty($time) || $time == '00:00:00') return '';
    return date('g:i A', strtotime($time));
}

$sql = "

SELECT 
    r.id,
    r.emp_id, 
    r.username, 
    r.user_type, 
    r.last_activity,
    e.fullname,
    t.today_punch_in,
    t.today_punch_out,
    t.yesterday_punch_in,
    t.break_in,
    t.break_out,
    t.lunch_in,
    t.lunch_out,
    t.schedule_code,
    t.date_logs,
    IF(
        r.last_activity IS NULL, 
        'offline',
        IF(TIMESTAMPDIFF(MINUTE, r.last_activity, NOW()) <= 5, 'online', 'offline')
    ) AS current_status
FROM tbl_users r
LEFT JOIN tbl_employee_info e ON e.emp_id = r.emp_id
LEFT JOIN (
    SELECT 
        emp_id,
        MIN(CASE WHEN DATE(date_logs) = :today THEN punch_in END) AS today_punch_in,
        MAX(CASE WHEN DATE(date_logs) = :today THEN punch_out END) AS today_punch_out,
        MIN(CASE WHEN DATE(date_logs) = :yesterday AND TIME(punch_in) >= '20:00:00' THEN punch_in END) AS yesterday_punch_in,
        MAX(break_in) AS break_in,
        MAX(break_out) AS break_out,
        MAX(lunch_in) AS lunch_in,
        MAX(lunch_out) AS lunch_out,
        MAX(schedule_code) AS schedule_code,
        MAX(date_logs) AS date_logs
    FROM tbl_employee_timelogs
    WHERE DATE(date_logs) IN (:today, :yesterday)
    GROUP BY emp_id
) t ON t.emp_id = r.emp_id
 WHERE t.schedule_code='F5' ORDER BY r.id ASC";

$stmt = $con->prepare($sql);
$stmt->bindParam(':today', $today);
$stmt->bindParam(':yesterday', $yesterday);
$stmt->execute();
?>

<table border="1" cellpadding="5" style="margin: 0 auto; border-collapse: collapse; text-align: center;">
    <tr style="background-color: #f0f0f0;">
        <th style="width: 6%;">Emp ID</th>
        <th style="width: 20%;">Name</th>
        <th style="width: 6%;">User Type</th>
        <th style="width: 11%;">Last Activity</th>
        <th style="width: 6%;">Date Logs</th>
        <th style="width: 4%;">Sched Code</th>
        <th style="background-color: blue; color: white; width: 7%;">Yesterday</th>
        <th style="background-color: blue; color: white; width: 7%;">Time In</th>
        <th style="background-color: darkred; color: white; width: 7%;">Time Out</th>
        <th style="background-color: blue; color: white; width: 7%;">Break In</th>
        <th style="background-color: darkred; color: white; width: 7%;">Break Out</th>
        <th style="background-color: blue; color: white; width: 7%;">Lunch In</th>
        <th style="background-color: darkred; color: white; width: 7%;">Lunch Out</th>
        <th style="background-color: green; color: white; width: 5%;">Status</th>
    </tr>

    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <?php
        $today_punch_in     = formatTime($row['today_punch_in']);
        $today_punch_out    = formatTime($row['today_punch_out']);
        $yesterday_punch_in = formatTime($row['yesterday_punch_in']);
        $break_in  = formatTime($row['break_in']);
        $break_out = formatTime($row['break_out']);
        $lunch_in  = formatTime($row['lunch_in']);
        $lunch_out = formatTime($row['lunch_out']);
        ?>
        <tr>
            <td><?= htmlspecialchars($row['emp_id']) ?></td>
            <td><?= htmlspecialchars($row['fullname']) ?></td>
            <td><?= htmlspecialchars($row['user_type']) ?></td>
            <td><?= htmlspecialchars($row['last_activity']) ?></td>
            <td><?= htmlspecialchars($row['date_logs']) ?></td>
            <td><?= htmlspecialchars($row['schedule_code']) ?></td>
            <td><?= htmlspecialchars($yesterday_punch_in) ?></td>
            <td><?= $today_punch_in ?></td>
            <td><?= $today_punch_out ?></td>
            <td><?= $break_in ?></td>
            <td><?= $break_out ?></td>
            <td><?= $lunch_in ?></td>
            <td><?= $lunch_out ?></td>
            <td style="color: <?= $row['current_status'] === 'online' ? 'green' : 'red' ?>;">
                <?= ucfirst($row['current_status']) ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>