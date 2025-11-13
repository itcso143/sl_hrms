   <table border="1" cellpadding="5" style="margin: 0 auto; border-collapse: collapse; text-align: center;">
     <tr style="background-color: #f0f0f0;">
       <th style="width: 6%;">Emp ID</th>
       <th style="width: 25%;">Name</th>
       <th style="width: 6%;">User Type</th>
       <th style="width: 11%;">Last Activity</th>
       <th style="width: 6%;">Date Logs</th>
       <th style="width: 4%;">Sched Code</th>
       <th style="background-color: blue; color: white; width: 7%;">Time In</th>
       <th style="background-color: darkred; color: white; width: 7%;">Time Out</th>
       <th style="background-color: blue; color: white; width: 7%;">Break In</th>
       <th style="background-color: darkred; color: white; width: 7%;">Break Out</th>
       <th style="background-color: blue; color: white; width: 7%;">Lunch In</th>
       <th style="background-color: darkred; color: white; width: 7%;">Lunch Out</th>
       <th style="background-color: green; color: white; width: 5%;">Status</th>
     </tr>

     <?php foreach ($day_shift as $row): ?>
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
     <?php endforeach; ?>
   </table>