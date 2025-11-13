<div class="table-responsive">
  <table class="table table-bordered table-sm table-hover text-center align-middle">
    <thead class="table-light">
      <tr>
        <th>Emp ID</th>
        <th>Name</th>
        <th>User Type</th>
        <th>Last Activity</th>
        <th>Date Logs</th>
        <th>Sched Code</th>
        <th class="bg-primary text-white">Time In</th>
        <th class="bg-danger text-white">Time Out</th>
        <th class="bg-primary text-white">Break In</th>
        <th class="bg-danger text-white">Break Out</th>
        <th class="bg-primary text-white">Lunch In</th>
        <th class="bg-danger text-white">Lunch Out</th>
        <th class="bg-success text-white">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $night_shift->fetch(PDO::FETCH_ASSOC)): ?>
        <?php
        $punch_in  = formatTime($row['punch_in']);
        $punch_out = formatTime($row['punch_out']);
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
          <td><?= $punch_in ?></td>
          <td><?= $punch_out ?></td>
          <td><?= $break_in ?></td>
          <td><?= $break_out ?></td>
          <td><?= $lunch_in ?></td>
          <td><?= $lunch_out ?></td>
          <td style="color: <?= $row['current_status'] === 'online' ? 'green' : 'red' ?>;">
            <?= ucfirst($row['current_status']) ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
