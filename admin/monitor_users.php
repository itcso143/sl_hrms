<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');

$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('-1 day'));
$get_dayshift = '';
$get_nightshift = '';

// Format time helper function
function formatTime($time)
{
  if (empty($time) || $time == '00:00:00') return '';
  return date('g:i A', strtotime($time));
}

$get_info_sql = "SELECT schedule_code FROM tbl_employee_info where status='ACTIVE' AND schedule_code !='F5' ";
$get_info_data = $con->prepare($get_info_sql);
$get_info_data->execute();
while ($result = $get_info_data->fetch(PDO::FETCH_ASSOC)) {


  $get_dayshift = $result['schedule_code'];
}



if ($get_dayshift != '') {


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
        MAX(punch_in) AS punch_in,
        MAX(punch_out) AS punch_out,
        MAX(break_in) AS break_in,
        MAX(break_out) AS break_out,
        MAX(lunch_in) AS lunch_in,
        MAX(lunch_out) AS lunch_out,
        MAX(schedule_code) AS schedule_code,
        MAX(date_logs) AS date_logs
    FROM tbl_employee_timelogs
    WHERE DATE(date_logs) = :today   -- ✅ Only today's records
    GROUP BY emp_id
) t ON t.emp_id = r.emp_id WHERE t.schedule_code !='F5'
ORDER BY r.id ASC";

  $day_shift = $con->prepare($sql);
  $day_shift->bindValue(':today', date('Y-m-d'));
  $day_shift->execute();
};

$get_info_sql = "SELECT schedule_code FROM tbl_employee_info where status='ACTIVE' AND schedule_code ='F5' ";
$get_info_data = $con->prepare($get_info_sql);
$get_info_data->execute();
while ($result = $get_info_data->fetch(PDO::FETCH_ASSOC)) {


  $get_nightshift = $result['schedule_code'];
}

if ($get_nightshift != '') {


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
        MAX(punch_in) AS punch_in,
        MAX(punch_out) AS punch_out,
        MAX(break_in) AS break_in,
        MAX(break_out) AS break_out,
        MAX(lunch_in) AS lunch_in,
        MAX(lunch_out) AS lunch_out,
        MAX(schedule_code) AS schedule_code,
        MAX(date_logs) AS date_logs
    FROM tbl_employee_timelogs
    WHERE DATE(date_logs) = :today   -- ✅ Only today's records
    GROUP BY emp_id
) t ON t.emp_id = r.emp_id WHERE t.schedule_code ='F5'
ORDER BY r.id ASC";

  $night_shift = $con->prepare($sql);
  $night_shift->bindValue(':today', date('Y-m-d'));
  $night_shift->execute();
}
?>



<div class="container mt-4" style="max-width: 1490px;"> <!-- Set max-width here -->


  <!-- Tabs -->
  <ul class="nav nav-tabs" id="attendanceTabs" role="tablist">
    <li class="nav-item">
      <button class="nav-link active"
        data-bs-toggle="tab"
        data-bs-target="#dayshift"
        type="button"
        role="tab">
        Day Shift
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link"
        data-bs-toggle="tab"
        data-bs-target="#nightshift"
        type="button"
        role="tab">
        Night Shift
      </button>
    </li>
  </ul>

  <div class="tab-content mt-3">
    <!-- Day Shift Tab -->
    <div class="tab-pane fade show active" id="dayshift">
      <div class="table-responsive"> <!-- Makes table scrollable horizontally if too wide -->
        <div id="attendanceTable">
          <?php include 'table_dayshift.php'; ?>
        </div>
      </div>
    </div>

    <!-- Night Shift Tab -->
    <div class="tab-pane fade" id="nightshift">
      <div class="table-responsive">
        <?php include 'table_nightshift.php'; ?>
      </div>
    </div>
  </div>
</div>


<br>
<br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<head>
  <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">

  <!-- <script src="https://kit.fontawesome.com/629c6e6cbc.js" crossorigin="anonymous"></script> -->
  <!-- <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.css"> -->

  <link rel="stylesheet" href="../plugins/select2/select2.min.css">

  <style>
    #my_camera {
      width: 320px;
      height: 240px;
      border: 1px solid black;
    }
  </style>

</head>
<!-- 
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
$(document).ready(function() {
    // Reload table every 5 seconds (5000ms)
    setInterval(function() {
        $('#attendanceTable').load('table_dayshift.php');
    }, 5000);
});
</script> -->