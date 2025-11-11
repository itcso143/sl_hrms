<?php
// include_once('session.php');
include('../config/db_config.php');
$now = new DateTime();


date_default_timezone_set('Asia/Manila');
// $serverTime = time(); 

$user_id = $_SESSION['id'];

$username = '';
$photo = '';
$date_logs = '';
$date_logs1 = '';

// //fetch user from database
$get_user_sql = " SELECT username,emp_id FROM tbl_users where id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $username = strtoupper($result4['username']);
  $emp_id = $result4['emp_id'];

  $get_user_sql = " SELECT emp_id,photo,schedule_code,fullname FROM tbl_employee_info where emp_id = :emp_id";
  $user_data = $con->prepare($get_user_sql);
  $user_data->execute([':emp_id' => $emp_id]);
  while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $photo = $result4['photo'];
    $fullname = $result4['fullname'];
    $schedule = $result4['schedule_code'];
  }

  $get_sched_sql = " SELECT schedule_code,sched_in,sched_out FROM tbl_schedule where schedule_code = :schedule";
  $get_sched_data = $con->prepare($get_sched_sql);
  $get_sched_data->execute([':schedule' => $schedule]);
  while ($result4 = $get_sched_data->fetch(PDO::FETCH_ASSOC)) {

    $sched_in = $result4['sched_in'];
    $sched_out = $result4['sched_out'];
  }



  $date_logs1 = date('Y-m-d');

  // Prepare SQL to get today's punch-in for this employee
  $get_user_logs_sql = "
    SELECT emp_id, date_logs, punch_in, punch_out,overtime_in,overtime_out
    FROM tbl_employee_timelogs 
    WHERE emp_id = :emp_id 
      AND date_logs = :date_logs
    LIMIT 1
";

  $get_user_logs_data = $con->prepare($get_user_logs_sql);
  $get_user_logs_data->execute([
    ':emp_id' => $emp_id,
    ':date_logs' => $date_logs1
  ]);

  $result4 = $get_user_logs_data->fetch(PDO::FETCH_ASSOC);

  if ($result4) {
    $date_logs = $result4['date_logs'];
    $punch_in = $result4['punch_in'];
    $punch_out = $result4['punch_out'];
    $ot_in = $result4['overtime_in'];
    $ot_out = $result4['overtime_out'];
  } else {
    // No punch-in yet today
    $date_logs = null;
    $punch_in = null;
    $punch_out = null;
    $ot_in = null;
    $ot_out = null;
  }

  // TIME OUT

  //   $get_user_logs_sql = "
  //     SELECT emp_id, date_logs, punch_in, punch_out 
  //     FROM tbl_employee_timelogs 
  //     WHERE emp_id = :emp_id 
  //       AND punch_out != '' 
  //       AND date_logs = :date_logs
  //     LIMIT 1
  // ";

  //   $get_user_logs_data = $con->prepare($get_user_logs_sql);
  //   $get_user_logs_data->execute([
  //     ':emp_id' => $emp_id,
  //     ':date_logs' => $date_logs1
  //   ]);

  //   $result4 = $get_user_logs_data->fetch(PDO::FETCH_ASSOC);

  //   if ($result4) {
  //     $date_logs1 = $result4['date_logs'];
  //     $punch_out = $result4['punch_out'];
  //   } else {
  //     // No punch-in yet today
  //     $date_logs1 = null;
  //     $punch_out = null;
  //   }
}






?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<nav class="main-header navbar navbar-expand bg-dark navbar-light border-bottom">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
    <li class="nav-item ">
      <a href="#" class="nav-link"></a>

    </li>


    <li class="nav-item">
      <a href="#" class="nav-link ">HOME PAGE</a>
    </li>

  </ul>



</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="bg-dark">

    <!-- <a href="index" class="brand-link">  
  <img src="../photo/<?php echo $department; ?>.jpg" class="img-circle elevation-4" width="120px">   
</a> -->


    <!-- Sidebar -->

    <!-- Sidebar user panel (optional) -->
    <div class="sidebar" align="center">
      <a href="" class="brand-link">

        <span class="brand-text font-weight-light">SL HRMS</span>
      </a>
      <div class="div">



        <img src="../photo/<?php echo $photo; ?>" class="rounded-circle" style="background-color:white; padding:3px" width="140px" height="120px">


      </div>
      <br>
      <label style="color:white" class="d-block">


        <h6>
          <label style="color:white"> <?php echo $fullname; ?></label>

          <!-- <label style="color:yellow" id="liveTime"></label> -->
        </h6>
        <label style="color:yellow"> Emp ID: <?php echo $emp_id; ?></label>

        <br>
        <label style="color:yellow"> Shedule Code: <?php echo $schedule; ?></label>
        <br>
        <label style="color:yellow"> Shedule In: <?php echo $sched_in; ?></label>
        <br>
        <label style="color:lightgreen"> <?php echo $now->format('Y-m-d'); ?> / ONLINE</label>


    </div>

  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <?php
      date_default_timezone_set('Asia/Manila');

      // Example time-only schedule values (you can replace these with DB values)


      // Get current date and time
      $today = date('Y-m-d');
      $currentTimestamp = time();

      // Convert to timestamps (attach today's date)
      $schedInTimestamp = strtotime("$today $sched_in");
      $schedOutTimestamp = strtotime("$today $sched_out");

      // Handle overnight schedules (e.g. 10PM to 6AM next day)
      if ($schedOutTimestamp <= $schedInTimestamp) {
        $schedOutTimestamp = strtotime("+1 day", $schedOutTimestamp);
      }

      // 30 minutes before schedule in
      $showButtonTime = $schedInTimestamp - (30 * 60);
      // Hide button after schedule out
      $hideButtonTime = $schedOutTimestamp;

      // Debug (optional — remove in production)

      ?>

      <ul class="navbar-nav">
        <?php if ($currentTimestamp >= $showButtonTime && $currentTimestamp <= $hideButtonTime): ?>
          <li class="nav-item w-100 d-flex justify-content-center text-center">
            <?php if (!empty($punch_in) && empty($punch_out)): ?>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#timeOutModal">TIME OUT</button>
            <?php elseif (empty($punch_in)): ?>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#timeInModal">TIME IN</button>
            <?php elseif (!empty($punch_in) && !empty($punch_out)): ?>
              <?php if (empty($ot_in)): ?>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#overTimeInModal">OT - IN</button>
              <?php elseif (!empty($ot_in) && empty($ot_out)): ?>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#overTimeOutModal">OT - OUT</button>
              <?php endif; ?>
            <?php endif; ?>
          </li>
        <?php else: ?>
          <!-- Button hidden until 30 minutes before schedule in -->
        <?php endif; ?>
      </ul>






      <!-- MODAL TIME IN-->
      <div class="modal fade" id="timeInModal" tabindex="-1" aria-labelledby="timeInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header">
              <h5 class="modal-title" id="timeInModalLabel">Time In</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body text-center">
              <p>Click confirm to log your time in.</p>
              <h4 class="fw-bold mt-3">
                Current Time: <span id="liveTime" class="text-primary"></span>
              </h4>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="save_time_in" name="save_time_in" class="btn btn-primary">Confirm Time In</button>
            </div>

          </div>
        </div>
      </div>

      <!-- MODAL TIME OUT-->
      <div class="modal fade" id="timeOutModal" tabindex="-1" aria-labelledby="timeOutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header">
              <h5 class="modal-title" id="timeOutModalLabel">Time Out</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body text-center">
              <p>Click confirm to log your time out.</p>
              <h4 class="fw-bold mt-3">
                Current Time: <span id="liveTime1" class="text-primary"></span>
              </h4>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="save_time_out" name="save_time_out" class="btn btn-primary">Confirm Time Out</button>
            </div>

          </div>
        </div>
      </div>

      <!-- MODAL OVER TIME-->
      <div class="modal fade" id="overTimeInModal" tabindex="-1" aria-labelledby="overTimeInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header">
              <h5 class="modal-title" id="overTimeInModalLabel">Overtime In</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body text-center">
              <p>Click confirm to log your time in.</p>
              <h4 class="fw-bold mt-3">
                Current Time: <span id="liveTime2" class="text-primary"></span>
              </h4>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="save_ot_in" name="save_ot_in" class="btn btn-primary">Confirm OT - In</button>
            </div>

          </div>
        </div>
      </div>

      <!-- MODAL OVER TIME-->
      <div class="modal fade" id="overTimeOutModal" tabindex="-1" aria-labelledby="overTimeOutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header">
              <h5 class="modal-title" id="overTimeOutModalLabel">Overtime Out</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body text-center">
              <p>Click confirm to log your time out.</p>
              <h4 class="fw-bold mt-3">
                Current Time: <span id="liveTime3" class="text-primary"></span>
              </h4>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="save_ot_out" name="save_ot_out" class="btn btn-primary">Confirm OT - Out</button>
            </div>

          </div>
        </div>
      </div>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-exchange"></i>
          <p>
            MASTERLIST
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>

        <ul class="nav nav-treeview">

          <li class="nav-item">
            <a href="list_employee" class="nav-link">
              <i class="fa fa-file nav-icon"></i>
              <p>Employee</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="list_dailylogs" class="nav-link">
              <i class="fa fa-file nav-icon"></i>
              <p>Daily Logs</p>
            </a>
          </li>


        </ul>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-calendar"></i>
          <p>
            Payroll
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>


        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="list_weekly_payslip" class="nav-link">
              <i class="fa fa-file nav-icon"></i>
              <p>Weekly Payslip</p>
            </a>
          </li>

        </ul>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="list_monthly_payslip" class="nav-link">
              <i class="fa fa-file nav-icon"></i>
              <p>Monthly Payslip</p>
            </a>
          </li>

        </ul>


        <!-- <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fa fa-file nav-icon"></i>
              <p>Payroll</p>
            </a>
          </li>

        </ul> -->
      </li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-gear"></i>
          <p>
            Settings
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="list_schedule" class="nav-link">
              <i class="fa fa-clock-o nav-icon"></i>
              <p>Add New Schedule</p>
            </a>
          </li>

        </ul>

          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="list_address" class="nav-link">
              <i class="fa fa-folder nav-icon"></i>
              <p>Add New Address</p>
            </a>
          </li>

        </ul>


      </li>








      <li class="nav-item has-treeview">
        <a href="#" class="nav-link ">
          <i class="nav-icon fa fa-dashboard"></i>
          <p>
            SYTEM
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <!-- <li class="nav-item">
            <a href="../lockscreen.php" class="nav-link">
              <i class="fa fa-lock nav-icon"></i>
              <p>LOCK SCREEN</p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="fa fa-sign-out nav-icon"></i>
              <p>SIGN OUT</p>
            </a>
          </li>
        </ul>


        <form role="form" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">
      <li class="nav-item">


        <!-- <a href="destroy_session" type="button" name="destroy_session" class="nav-link  sidebar-link">
                &nbsp;
                <i class="fa fa-sign-out nav-icon icons"></i>
                <p> &nbsp; Sign Out</p>
              </a> -->

        <!-- <button type="submit"  name="destroy_session" id="btnSubmit" class="btn btn-danger">
                                                Sign Out</button> -->

        <div class="col-md-5">

          <input type="hidden" name="user_name" class="form-control" placeholder="username" value="<?php echo $username ?>">

        </div>

      </li>
      </form>



  </nav>
  <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Live Time Script -->



<!-- TIME IN -->
<script>
  function updateLiveTime() {
    const now = new Date();
    const options = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // force 24-hour format
    };
    document.getElementById("liveTime").textContent = now.toLocaleTimeString([], options);
  }

  // Update every second
  setInterval(updateLiveTime, 1000);

  // Initialize immediately when modal opens
  document.getElementById('timeInModal').addEventListener('shown.bs.modal', updateLiveTime);
</script>
<script>
  $(document).ready(function() {
    $('#save_time_in').on('click', function() {
      const now = new Date();
      const timeIn = now.toLocaleTimeString();

      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("Time In:", timeIn);

      // Disable button while saving
      $('#save_time_in').prop('disabled', true).text('Saving...');

      // AJAX request
      $.ajax({
        url: 'save_time_in.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          time_in: timeIn // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('Time In saved successfully!');
          $('#save_time_in').prop('disabled', false).text('Confirm Time In');
          $('#timeInModal').modal('hide');

          // 🔄 Reload the page
          location.reload();
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');
          $('#save_time_in').prop('disabled', false).text('Confirm Time In');
        }
      });
    });
  });
</script>

<!-- TIME OUT -->

<script>
  function updateLiveTime() {
    const now = new Date();
    const options = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // force 24-hour format
    };
    document.getElementById("liveTime1").textContent = now.toLocaleTimeString([], options);
  }

  // Update every second
  setInterval(updateLiveTime, 1000);

  // Initialize immediately when modal opens
  document.getElementById('timeOutModal').addEventListener('shown.bs.modal', updateLiveTime);
</script>


<script>
  $(document).ready(function() {
    $('#save_time_out').on('click', function() {
      const now = new Date();
      const timeout = now.toLocaleTimeString();

      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("Time Out:", timeout);

      // Disable button while saving
      $('#save_time_out').prop('disabled', true).text('Saving...');

      // AJAX request
      $.ajax({
        url: 'save_time_out.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          time_out: timeout // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('Time Out saved successfully!');
          $('#save_time_out').prop('disabled', false).text('Confirm Time Out');
          $('#timeInModal').modal('hide');

          // 🔄 Reload the page
          location.reload();
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');
          $('#save_time_out').prop('disabled', false).text('Confirm Time Out');
        }
      });
    });
  });
</script>


<!-- OVERTIME IN -->

<script>
  function updateLiveTime() {
    const now = new Date();
    const options = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // force 24-hour format
    };
    document.getElementById("liveTime2").textContent = now.toLocaleTimeString([], options);
  }

  // Update every second
  setInterval(updateLiveTime, 1000);

  // Initialize immediately when modal opens
  document.getElementById('overTimeInModal').addEventListener('shown.bs.modal', updateLiveTime);
</script>


<script>
  $(document).ready(function() {
    $('#save_ot_in').on('click', function() {
      const now = new Date();
      const ot_in = now.toLocaleTimeString();

      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("OT - In:", ot_in);

      // Disable button while saving
      $('#save_ot_in').prop('disabled', true).text('Saving...');

      // AJAX request
      $.ajax({
        url: 'save_ot_in.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          ot_in: ot_in // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('OT - In saved successfully!');
          $('#save_ot_in').prop('disabled', false).text('Confirm OT - In');
          $('#timeInModal').modal('hide');

          // 🔄 Reload the page
          location.reload();
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');
          $('#save_ot_in').prop('disabled', false).text('Confirm OT - In');
        }
      });
    });
  });
</script>


<!-- OVERTIME OUT -->

<script>
  function updateLiveTime() {
    const now = new Date();
    const options = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // force 24-hour format
    };
    document.getElementById("liveTime3").textContent = now.toLocaleTimeString([], options);
  }

  // Update every second
  setInterval(updateLiveTime, 1000);

  // Initialize immediately when modal opens
  document.getElementById('overTimeOutModal').addEventListener('shown.bs.modal', updateLiveTime);
</script>


<script>
  $(document).ready(function() {
    $('#save_ot_out').on('click', function() {
      const now = new Date();
      const ot_out = now.toLocaleTimeString();

      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("OT - Out:", ot_out);

      // Disable button while saving
      $('#save_ot_out').prop('disabled', true).text('Saving...');

      // AJAX request
      $.ajax({
        url: 'save_ot_out.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          ot_out: ot_out // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('OT - Out saved successfully!');
          $('#save_ot_out').prop('disabled', false).text('Confirm OT - Out');
          $('#timeInModal').modal('hide');

          // 🔄 Reload the page
          location.reload();
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');
          $('#save_ot_out').prop('disabled', false).text('Confirm OT - Out');
        }
      });
    });
  });
</script>

<script>
  // Get server time from PHP
  let currentTime = <?php echo $serverTime * 1000; ?>; // convert to milliseconds

  function updateTime() {
    // Increment by 1 second
    currentTime += 1000;
    const now = new Date(currentTime);

    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0'); // months are 0-indexed
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    document.getElementById('liveTime').textContent = `${year}-${month}-${day} ${hours}:${minutes}:${seconds} / ONLINE`;
  }

  // Initial display
  updateTime();

  // Update every second
  setInterval(updateTime, 1000);
</script>