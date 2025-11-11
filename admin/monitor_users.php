<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');


// ✅ Simplified and fixed SQL
$yesterday = date('Y-m-d', strtotime('-1 day'));
$today = date('Y-m-d');

$sql = "
SELECT 
    r.id,
    r.emp_id, 
    r.username, 
    r.user_type, 
    r.last_activity,
    e.fullname,
    t.punch_in,
    t.punch_out,
    t.break_in,
    t.break_out,
    t.lunch_in,
    t.lunch_out,
    IF(r.last_activity IS NULL, 'offline',
       IF(TIMESTAMPDIFF(SECOND, r.last_activity, NOW()) <= 300, 'online', 'offline')
    ) AS current_status
FROM tbl_users r
LEFT JOIN tbl_employee_info e ON e.emp_id = r.emp_id
LEFT JOIN (
    SELECT 
        emp_id,
        MIN(punch_in) AS punch_in,
        MAX(punch_out) AS punch_out,
        MIN(break_in) AS break_in,
        MAX(break_out) AS break_out,
        MIN(lunch_in) AS lunch_in,
        MAX(lunch_out) AS lunch_out
    FROM (
        SELECT emp_id, punch_in, punch_out, break_in, break_out, lunch_in, lunch_out, date_logs
        FROM tbl_employee_timelogs
        WHERE DATE(date_logs) = :today

        UNION ALL

        SELECT emp_id, punch_in, punch_out, break_in, break_out, lunch_in, lunch_out, date_logs
        FROM tbl_employee_timelogs
        WHERE DATE(date_logs) = :yesterday AND TIME(punch_in) >= '08:00:00'
    ) combined
    GROUP BY emp_id
) t ON t.emp_id = r.emp_id
ORDER BY r.id ASC";

$stmt = $con->prepare($sql);
$stmt->bindParam(':today', $today);
$stmt->bindParam(':yesterday', $yesterday);
$stmt->execute();


?>

<!-- ✅ HTML Table -->
<table border="1" cellpadding="5" style="margin: 0 auto; border-collapse: collapse; text-align: center;">
  <tr>
    <th style="width: 6%;">Emp ID</th>
    <th style="width: 25%;">Name</th>
    <th style="width: 7%;">User Type</th>
    <th style="width: 13%;">Last Activity</th>
    <th style="background-color: blue; color: white; width: 7%;">Time In</th>
    <th style="background-color: darkred; color: white; width: 7%;">Time Out</th>
    <th style="background-color: blue; color: white; width: 7%;">Break In</th>
    <th style="background-color: darkred; color: white; width: 7%;">Break Out</th>
    <th style="background-color: blue; color: white; width: 7%;">Lunch In</th>
    <th style="background-color: darkred; color: white; width: 7%;">Lunch Out</th>
    <th style="background-color: green; color: white; width: 5%;">Status</th>
  </tr>

  <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
    <tr>
      <td><?= htmlspecialchars($row['emp_id']) ?></td>
      <td><?= htmlspecialchars($row['fullname']) ?></td>
      <td><?= htmlspecialchars($row['user_type']) ?></td>
      <td><?= htmlspecialchars($row['last_activity']) ?></td>
      <td><?= htmlspecialchars($row['punch_in']) ?></td>
      <td><?= htmlspecialchars($row['punch_out']) ?></td>
      <td><?= htmlspecialchars($row['break_in']) ?></td>
      <td><?= htmlspecialchars($row['break_out']) ?></td>
      <td><?= htmlspecialchars($row['lunch_in']) ?></td>
      <td><?= htmlspecialchars($row['lunch_out']) ?></td>
      <td style="color: <?= $row['current_status'] === 'online' ? 'green' : 'red' ?>;">
        <?= ucfirst($row['current_status']) ?>
      </td>
    </tr>
  <?php endwhile; ?>
</table>
