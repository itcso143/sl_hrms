<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');

// ✅ Use a single SQL query with all necessary joins
$sql = "SELECT 
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
    IF(TIMESTAMPDIFF(SECOND, r.last_activity, NOW()) <= 300, 'online', 'offline') AS current_status
FROM 
    tbl_users r
LEFT JOIN 
    tbl_employee_info e ON e.emp_id = r.emp_id
LEFT JOIN 
    tbl_employee_timelogs t ON t.emp_id = r.emp_id AND DATE(t.date_logs) = :date
ORDER BY 
    e.id ASC";

$stmt = $con->prepare($sql);
$stmt->bindParam(':date', $date);
$stmt->execute();
?>


<table border="1" cellpadding="5" style="margin: 0 auto; border-collapse: collapse; text-align: center;">
  <tr>
    <th style="width: 6%;">Emp ID</th>
    <th style="width: 25%;">Name</th>
    <th style="width: 7%;">User Type</th>
    <th style="width: 13%;">Last Activity</th>
   <th style="background-color: blue; color: white; width: 7%;">Time In</th>
    <th style="background-color: darkred; color: white; width: 7%;">Time Out</th>
  <th style="background-color: blue; color: white; width: 7%;">Break Out</th>
    <th style="background-color: darkred; color: white; width: 7%;">Break in</th>
     <th style="background-color: blue; color: white; width: 7%;">Lunch Out</th>
    <th style="background-color: darkred; color: white; width: 7%;">Lunch in</th>
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
      <td><?= htmlspecialchars($row['break_out']) ?></td>
      <td><?= htmlspecialchars($row['break_in']) ?></td>
      <td><?= htmlspecialchars($row['lunch_out']) ?></td>
      <td><?= htmlspecialchars($row['lunch_in']) ?></td>

      <td style="color: <?= $row['current_status'] === 'online' ? 'green' : 'red' ?>;">
        <?= ucfirst($row['current_status']) ?>
      </td>
    </tr>
  <?php endwhile; ?>
</table>