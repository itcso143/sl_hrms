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

$logs_id = '';

$logs_id_final ='';

$get_logs_id='';

$emp_id_new2='';

include('update_user_activity.php');

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

  $get_sched_sql = " SELECT schedule_code,description,sched_in,sched_out FROM tbl_schedule where schedule_code = :schedule";
  $get_sched_data = $con->prepare($get_sched_sql);
  $get_sched_data->execute([':schedule' => $schedule]);
  while ($result4 = $get_sched_data->fetch(PDO::FETCH_ASSOC)) {

    $sched_in = $result4['sched_in'];
    $sched_out = $result4['sched_out'];
    $date_range = $result4['description'];
  }

  $get_logs_data_sql = "SELECT id,logs_id FROM tbl_employee_timelogs WHERE emp_id= :emp_id order by id DESC LIMIT 1";
  $get_logs_data = $con->prepare($get_logs_data_sql);
  $get_logs_data->execute([':emp_id' => $emp_id]);
  while ($result4 = $get_logs_data->fetch(PDO::FETCH_ASSOC)) {

    $get_logs_id = $result4['logs_id'];
  }

   $get_logs_data_sql = "SELECT 
    t.emp_id, 
    t.date_logs,
    t.logs_id,
    (SELECT punch_in 
     FROM tbl_employee_timelogs 
     WHERE emp_id = '$emp_id' 
	AND logs_id ='$get_logs_id'
       AND punch_in != '' 
     ORDER BY date_logs DESC LIMIT 1) AS punch_in,
     
        (SELECT punch_out 
     FROM tbl_employee_timelogs 
     WHERE emp_id = '$emp_id' 
     AND logs_id ='$get_logs_id'
       AND punch_out != '' 
     ORDER BY date_logs DESC LIMIT 1) AS punch_out,
     
      (SELECT break_in 
     FROM tbl_employee_timelogs 
     WHERE emp_id = '$emp_id' 
     AND logs_id ='$get_logs_id'
       AND break_in != '' 
     ORDER BY date_logs DESC LIMIT 1) AS break_in,
     
     (SELECT break_out 
     FROM tbl_employee_timelogs 
     WHERE emp_id = '$emp_id' 
     AND logs_id ='$get_logs_id'
       AND break_out != '' 
     ORDER BY date_logs DESC LIMIT 1) AS break_out,
     
     (SELECT lunch_in 
     FROM tbl_employee_timelogs 
     WHERE emp_id = '$emp_id' 
     AND logs_id ='$get_logs_id'
       AND lunch_in != '' 
     ORDER BY date_logs DESC LIMIT 1) AS lunch_in,
     
      (SELECT lunch_out 
     FROM tbl_employee_timelogs 
     WHERE emp_id = :emp_id
     AND logs_id ='$get_logs_id'
       AND lunch_out != '' 
     ORDER BY date_logs DESC LIMIT 1) AS lunch_out
     
FROM tbl_employee_timelogs t ORDER BY t.id DESC LIMIT 1;";
  $get_logs_data = $con->prepare($get_logs_data_sql);
  $get_logs_data->execute([':emp_id' => $emp_id]);
  while ($result4 = $get_logs_data->fetch(PDO::FETCH_ASSOC)) {

    $logs_id_new = $result4['logs_id'];
    $emp_id_new2 = $result4['emp_id'];
  }

$get_sched_sql = "
    SELECT logs_id, emp_id, punch_out 
    FROM tbl_employee_timelogs 
    WHERE emp_id = :emp_id 
      AND logs_id = :logs_id
    LIMIT 1
";

$get_sched_data = $con->prepare($get_sched_sql);
$get_sched_data->execute([
    ':emp_id'  => $emp_id_new2,
    ':logs_id' => $logs_id_new
]);

$result4 = $get_sched_data->fetch(PDO::FETCH_ASSOC);

if ($result4) {
    $logs_id_final = $result4['logs_id'];
} else {
    $logs_id_final = null; // explicitly set to null if no result found
}

  $date_logs1 = date('Y-m-d');

  // Prepare SQL to get today's punch-in for this employee
  //   $get_user_logs_sql = "
  //     SELECT emp_id, date_logs, punch_in, punch_out,overtime_in,overtime_out,break_out,break_in,lunch_out,lunch_in
  //     FROM tbl_employee_timelogs 
  //     WHERE emp_id = :emp_id 
  //       AND date_logs = :date_logs
  //     LIMIT 1
  // ";

  //   $get_user_logs_data = $con->prepare($get_user_logs_sql);
  //   $get_user_logs_data->execute([
  //     ':emp_id' => $emp_id,
  //     ':date_logs' => $date_logs1
  //   ]);

  $get_user_logs_sql = "
  SELECT emp_id, date_logs, punch_in, punch_out, overtime_in, overtime_out, break_out, break_in, lunch_out, lunch_in
  FROM tbl_employee_timelogs 
  WHERE emp_id = :emp_id
  ORDER BY date_logs DESC, punch_in DESC
  LIMIT 1
";

  $get_user_logs_data = $con->prepare($get_user_logs_sql);
  $get_user_logs_data->execute([
    ':emp_id' => $emp_id
  ]);

  $result4 = $get_user_logs_data->fetch(PDO::FETCH_ASSOC);

  if ($result4) {
    $date_logs = $result4['date_logs'];
    $punch_in = $result4['punch_in'];
    $punch_out = $result4['punch_out'];
    $ot_in = $result4['overtime_in'];
    $ot_out = $result4['overtime_out'];
    $break_out = $result4['break_out'];
    $break_in = $result4['break_in'];
    $lunch_out = $result4['lunch_out'];
    $lunch_in = $result4['lunch_in'];
  } else {
    // No punch-in yet today
    $date_logs = null;
    $punch_in = null;
    $punch_out = null;
    $ot_in = null;
    $ot_out = null;
    $break_out = null;
    $break_in = null;
    $lunch_out = null;
    $lunch_in = null;
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
        <label style="color:yellow"> Schedule Code: <?php echo $schedule; ?></label>



        <!-- <label style="color:yellow"> Shedule In: <?php echo $sched_in; ?></label> -->
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

      ?>





 <!-- FLOATING MODAL -->
      <div class="modal floating-modal" id="timeInModal" tabindex="-1" aria-labelledby="timeInModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header draggable">
              <h5 class="modal-title" id="timeInModalLabel">Attendance</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div>
                <!-- Minimize Button -->
                <!-- <button type="button" class="btn btn-secondary btn-sm me-2" id="minimizeModal" title="Minimize">–</button> -->
                <!-- Maximize Button -->
                <!-- <button type="button" class="btn btn-secondary btn-sm me-2" id="maximizeModal" title="Maximize">⬜</button> -->

              </div>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body text-center">
              <p>Click the button to log your time.</p>
              <h4 class="fw-bold mt-3">
                <!-- PHP Date -->
                <?php echo date('F j, Y'); ?>
                <br>
                Current Time: <span id="liveTime" class="text-primary"></span>
                <br>
                <div class="row justify-content-center text-center">
                  <div class="col-md-6 col-sm-8 col-10">
                    <input readonly
                      type="text"
                      id="logs_id"
                      name="logs_id"
                      class="form-control text-center"
                      placeholder=""
                      value="<?php echo $logs_id_final; ?>">
                  </div>
                </div>
              </h4>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer py-3">
              <div class="row justify-content-center text-center">
                <div class="col-auto">
                  <button type="button" id="save_time_in" class="btn btn-primary px-3">Time In</button>
                </div>
                <div class="col-auto">
                  <button type="button" id="save_time_breakout2" class="btn btn-warning px-3">Break In</button>
                </div>

                <div class="col-auto">
                  <button type="button" id="save_time_breakin2" class="btn btn-danger px-3">Break Out</button>
                </div>
                <div class="col-auto">
                  <button type="button" id="save_time_lunchout2" class="btn btn-warning px-3">Lunch In</button>
                </div>

                <div class="col-auto">
                  <button type="button" id="save_time_lunchin2" class="btn btn-danger px-3">Lunch Out</button>
                </div>

                <div class="col-auto">
                  <button type="button" id="save_time_out2" class="btn btn-primary px-3">Time Out</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- MINIMIZED BUTTON -->
      <button id="minimizedBtn" class="btn btn-primary floating-minimized-btn" style="display:none;">Daily Logs</button>


      <!-- MINIMIZED BUTTON -->
      <button id="minimizedBtn" class="btn btn-primary floating-minimized-btn" style="display:none;">Daily Logs</button>




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




      <!-- MODAL BREAK IN -->
      <div class="modal fade" id="breakInModal" tabindex="-1" aria-labelledby="BreakInModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header">
              <h5 class="modal-title" id="BreakInModalLabel">Break In</h5>
              <!-- Optional: Remove close button so user cannot dismiss -->
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body text-center">
              <p>Click confirm to log your Break In.</p>
              <h4 class="fw-bold mt-3">
                Current Time: <span id="liveTimeBreakIn" class="text-primary"></span>
              </h4>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer">
              <button type="button" id="save_time_breakin" name="save_time_breakin" class="btn btn-primary">
                Confirm Break In
              </button>
            </div>

          </div>
        </div>
      </div>



      <!-- MODAL LUNCH OUT-->
      <div class="modal fade" id="lunchOutModal" tabindex="-1" aria-labelledby="LunchOutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header">
              <h5 class="modal-title" id="lunchOutModalLabel">Lunch Out</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body text-center">
              <p>Click confirm to log your Lunch out.</p>
              <h4 class="fw-bold mt-3">
                Current Time: <span id="liveTimeLunchout" class="text-primary"></span>
              </h4>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="save_time_lunchout" name="save_time_lunchout" class="btn btn-primary">Confirm Lunch Out</button>
            </div>

          </div>
        </div>
      </div>

      <!-- MODAL LUNCH IN -->
      <div class="modal fade" id="lunchInModal" tabindex="-1" aria-labelledby="LunchInModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header">
              <h5 class="modal-title" id="LunchInModalLabel">Lunch In</h5>
              <!-- Remove close button so modal cannot be closed manually -->
              <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body text-center">
              <p>Click confirm to log your Lunch In.</p>
              <h4 class="fw-bold mt-3">
                Current Time: <span id="liveTimeLunchin" class="text-primary"></span>
              </h4>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer">
              <button type="button" id="save_time_lunchin" name="save_time_lunchin" class="btn btn-primary">
                Confirm Lunch In
              </button>
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

          <li class="nav-item">
            <a href="list_emp_weekly_payslip" class="nav-link">
              <i class="fa fa-file nav-icon"></i>
              <p>Payslip Weekly</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="list_employee_monthly_payslip" class="nav-link">
              <i class="fa fa-file nav-icon"></i>
              <p>Payslip Monthly</p>
            </a>
          </li>


        </ul>







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
          time_in: timeIn, // send current time
          break_out: timeIn // send current time

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
    $('#save_time_out2').on('click', function() {
      const now = new Date();
      const timeout = now.toLocaleTimeString();
      const logs_id = $('#logs_id').val();
      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("Time Out:", timeout);
      console.log("Logs id:", logs_id);

      // Disable button while saving
      $('#save_time_out2').prop('disabled', true).text('Saved');

      // AJAX request
      $.ajax({
        url: 'save_time_out.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          logs_id: logs_id, // send employee ID
          time_out: timeout // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('Time Out saved successfully!');


        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');

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

<script>
  setInterval(() => {
    fetch('update_user_activity.php');
  }, 60000); // every 60 seconds
</script>



<!-- BREAK OUT -->



<script>
  $(document).ready(function() {
    $('#save_time_breakout2').on('click', function() {
      const now = new Date();
      const timeIn = now.toLocaleTimeString();
      const logs_id = $('#logs_id').val();

      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("Break Out:", timeIn);
      console.log("Logs id:", logs_id);

      // Disable button while saving
      $('#save_time_breakout2').prop('disabled', true).text('Saved');

      // AJAX request
      $.ajax({
        url: 'save_time_breakout.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          logs_id: logs_id, // send employee ID
          break_out: timeIn // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('Break Out saved successfully!');




        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');
          $('#save_time_breakout').prop('disabled', false).text('Confirm Break Out');
        }
      });
    });
  });
</script>



<!-- BREAK In -->

<script>
  function updateLiveTime() {
    const now = new Date();
    const options = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // force 24-hour format
    };
    document.getElementById("liveTimeBreakIn").textContent = now.toLocaleTimeString([], options);
  }

  // Update every second
  setInterval(updateLiveTime, 1000);

  // Initialize immediately when modal opens
  document.getElementById('breakIntModal').addEventListener('shown.bs.modal', updateLiveTime);
</script>

<script>
  $(document).ready(function() {
    $('#save_time_breakin2').on('click', function() {
      const now = new Date();
      const breakin = now.toLocaleTimeString();
      const logs_id = $('#logs_id').val();

      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("Break In:", breakin);
      console.log("Logs id:", logs_id);

      // Disable button while saving
      $('#save_time_breakin2').prop('disabled', true).text('Saved');

      // AJAX request
      $.ajax({
        url: 'save_time_breakin.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          logs_id: logs_id, // send employee ID
          break_in: breakin // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('Break In saved successfully!');



        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');


        }
      });
    });
  });
</script>



<!-- LUNCH OUT -->

<script>
  function updateLiveTime() {
    const now = new Date();
    const options = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // force 24-hour format
    };
    document.getElementById("liveTimeLunchout").textContent = now.toLocaleTimeString([], options);
  }

  // Update every second
  setInterval(updateLiveTime, 1000);

  // Initialize immediately when modal opens
  document.getElementById('lunchOutModal').addEventListener('shown.bs.modal', updateLiveTime);
</script>

<script>
  $(document).ready(function() {
    $('#save_time_lunchout2').on('click', function() {
      const now = new Date();
      const lunchout = now.toLocaleTimeString();
      const logs_id = $('#logs_id').val();
      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("Lunch Out:", lunchout);
      console.log("Logs id:", logs_id);
      // Disable button while saving
      $('#save_time_lunchout2').prop('disabled', true).text('Saved');

      // AJAX request
      $.ajax({
        url: 'save_time_lunchout.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          logs_id: logs_id, // send employee ID
          lunch_out: lunchout // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('Lunch Out saved successfully!');


        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');

        }
      });
    });
  });
</script>



<!-- LUNCH IN -->

<script>
  function updateLiveTime() {
    const now = new Date();
    const options = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // force 24-hour format
    };
    document.getElementById("liveTimeLunchin").textContent = now.toLocaleTimeString([], options);
  }

  // Update every second
  setInterval(updateLiveTime, 1000);

  // Initialize immediately when modal opens
  document.getElementById('lunchInModal').addEventListener('shown.bs.modal', updateLiveTime);
</script>

<script>
  $(document).ready(function() {
    $('#save_time_lunchin2').on('click', function() {
      const now = new Date();
      const lunchin = now.toLocaleTimeString();
      const logs_id = $('#logs_id').val();
      // Get emp_id from PHP
      const emp_id = "<?php echo $emp_id; ?>"; // Inject PHP variable

      // 🔍 Log the values to the browser console
      console.log("Employee ID:", emp_id);
      console.log("Lunch In:", lunchin);
      console.log("Logs id:", logs_id);

      // Disable button while saving
      $('#save_time_lunchin2').prop('disabled', true).text('Saved');

      // AJAX request
      $.ajax({
        url: 'save_time_lunchin.php',
        type: 'POST',
        data: {
          emp_id: emp_id, // send employee ID
          logs_id: logs_id, // send employee ID
          lunch_in: lunchin // send current time
        },
        success: function(response) {
          console.log('Server response:', response);
          alert('Lunch In saved successfully!');


        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('Something went wrong. Please try again.');

        }
      });
    });
  });
</script>
<script>
  const modalDialog = document.querySelector('#timeInModal .modal-dialog');
  const header = modalDialog.querySelector('.modal-header');
  const minimizeBtn = document.getElementById('minimizeModal');
  const maximizeBtn = document.getElementById('maximizeModal');
  const minimizedBtn = document.getElementById('minimizedBtn');
  const modal = document.getElementById('timeInModal');

  // Drag functionality
  let isDragging = false;
  let offsetX, offsetY;

  header.addEventListener('mousedown', (e) => {
    if (!modal.classList.contains('maximized')) {
      isDragging = true;
      offsetX = e.clientX - modalDialog.offsetLeft;
      offsetY = e.clientY - modalDialog.offsetTop;
      document.body.style.userSelect = 'none';
    }
  });

  document.addEventListener('mouseup', () => {
    isDragging = false;
    document.body.style.userSelect = 'auto';
  });

  document.addEventListener('mousemove', (e) => {
    if (isDragging) {
      modalDialog.style.left = `${e.clientX - offsetX}px`;
      modalDialog.style.top = `${e.clientY - offsetY}px`;
    }
  });

  // Minimize modal
  minimizeBtn.addEventListener('click', () => {
    modal.classList.remove('show', 'maximized');
    modal.style.display = 'none';
    minimizedBtn.style.display = 'block';
  });

  // Restore modal from minimized button
  minimizedBtn.addEventListener('click', () => {
    modal.classList.add('show');
    modal.style.display = 'block';
    minimizedBtn.style.display = 'none';
  });

  // Maximize modal
  maximizeBtn.addEventListener('click', () => {
    modal.classList.toggle('maximized');
  });
</script>