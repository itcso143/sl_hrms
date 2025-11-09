<?php

include('../config/db_config.php');

// include('sql_queries.php');
// include('insert_dailypayment.php');
// include('insert_yearlypayment.php');



session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');
$now = new DateTime();

$btnSave = $btnEdit = "";

$username = '';
// $entity_no = '';
//fetch user from database
$accountType = '';
$user_name = '';
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $username = $result['username'];
}

$get_schedule_sql = "SELECT * FROM tbl_schedule";
$get_schedule_data = $con->prepare($get_schedule_sql);
$get_schedule_data->execute();

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LIST EMPLOYEE </title>
  <?php include('heading.php'); ?>




</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">


      <!-- <div class="float-topright">
        <?php echo "$alert_msg1"; ?>
      </div> -->


      <section class="content">
        <div class="card card-info">
          <div class="card-header  text-white bg-dark">
            <h4>LIST EMPLOYEE

              <!-- <a href="add_employee" id="add_employee" style="float:right;" type="button" class="btn btn-primary bg-gradient-success" style="border-radius: 0px;">
                <i>ADD NEW EMPLOYEE</i></a> -->

            </h4>

          </div>

          <!-- Schedule Modal -->
          <div class="modal fade" id="modal_schedule" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="addScheduleModalLabel">
                    <i class="fa fa-calendar"></i> Add Schedule
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <form method="POST" action="update_employee_schedule.php">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-5">
                        <label for="emp_id">EMP ID:</label>
                        <input readonly type="text" name="emp_id" id="emp_id" class="form-control">
                      </div>
                    </div>

                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <label for="get_schedule">Select Type of Schedule</label>
                        <select class="form-control select2" id="get_schedule" name="get_schedule">
                          <?php while ($get_schedule = $get_schedule_data->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($get_user_schedule == $get_schedule['schedule_code']) ? 'selected' : '';
                          ?>
                            <option <?= $selected; ?> value="<?= $get_schedule['schedule_code']; ?>">
                              <?= $get_schedule['schedule_code']; ?> - <?= $get_schedule['sched_in']; ?> - <?= $get_schedule['sched_out']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" name="update_employee_schedule" class="btn btn-primary" value="Update Schedule">
                  </div>
                </form>

              </div>
            </div>
          </div>


          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">

                  <div class="table-responsive">

                    <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                      <thead align="center">

                        <th> EMP_ID </th>
                        <th> DATE CREATE </th>
                        <th> FULLNAME </th>
                        <th> ADDRESS </th>

                        <th> Options</th>

                      </thead>
                      <tbody>
                    


                      </tbody>
                    </table>
                    <input type="hidden" readonly id="accountType" value="<?php echo $accountType; ?>">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <br>

        </div>

      </section>
      <br><br>

    </div><!-- /.content-wrapper -->



  </div>


  <div class="modal fade" id="delete_employee" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="emp_id_new" id="emp_id_new" class="form-control">
                <input readonly="true" type="text" name="fullname" id="fullname" class="form-control">

              </div>



            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

            <input type="submit" name="delete_employee" class="btn btn-danger" value="Yes">
          </div>
        </form>


      </div>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->



  <div class="modal fade" id="modalupdate" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-white bg-dark">
          <h4 class="modal-title">PROFILE </h4>
        </div>
        <form method="POST" action="">
          <div class="modal-body">


            <div class="row">

              <div class="col-md-5 ">

                <video id="webcam" autoplay playsinline width="300" height="300" align="center" hidden class="photo  img-thumbnail"></video>
                <canvas id="canvas" class="d-none" hidden width="300" height="300" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>
                <audio id="snapSound" src="audio/snap.wav" preload="auto"></audio>
                <img src="/sccdrrmo/flutter/images/default.jpg" id="barangay_photo" style="height: 300px; width:300px; margin:auto;" class="photo img-thumbnail">
                <br>
                <div class="" align="center">
                  <a href="javascript:;" onclick="this.href='/certificate/barangay/view_individual.php?entity_no=' + document.getElementById('entity_no').value" target="blank">
                    <input type="button" name="view_individual" class="btn btn-primary" value="OPEN PROFILE">
                  </a>
                  <a class="btn btn-info btn btn-warning" id="modal8">Refresh</a>
                </div>
              </div>


              <div class="col-md-7 ">
                <div class="card">
                  <div class="card-header text-white bg-dark">
                    <h5>Profile</h5>
                  </div>
                  <div class="card-body">


                    <div class="row">
                      <div class="col-lg-5">

                        <input readonly type="text" name="entity_no" id="entity_no" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-7">
                        <label>Name:</label>
                        <input readonly type="text" name="fullname1" id="fullname1" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                        <label>Address:</label>
                        <input readonly type="text" name="address" id="address" class="form-control">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-5">
                        <label>Barangay:</label>
                        <input readonly type="text" name="barangay" id="barangay" class="form-control">
                      </div>
                    </div>

                  </div>
                </div>
              </div>


            </div>





          </div>


        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
          <input type="submit" name="insert_dailypayment" class="btn btn-primary" value="SAVE">


          <apex:commandButton styleclass="btn btn-primary" value="Ajouter" action="{!addExperience}" reRender="contactTable" onComplete="$('#myModal').modal('hide');$('body').removeClass('modal-open');$('.modal-backdrop').remove(); refresh();" />

          <!-- <button type="submit" <?php echo $btnSave; ?> name="insert_dailypayment" id="btnSubmit" class="btn btn-success">
                                                <i class="fa fa-check fa-fw"> </i> </button> -->
        </div>


      </div>
    </div> <!-- /.modal-content -->

  </div><!-- /.wrapper -->


  <?php include('pluginscript.php') ?>

  <?php

  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

  ?>
    <script>
      swal({
        title: "<?php echo $_SESSION['status'] ?>",
        // text: "You clicked the button!",
        icon: "<?php echo $_SESSION['status_code'] ?>",
        button: "OK. Done!",
      });
    </script>

  <?php
    unset($_SESSION['status']);
  }
  ?>


  <script>
    function myFunction() {
      location.reload();
    }
  </script>


  <script>
 var dataTable = $('#users').DataTable({
  page: false,
  stateSave: true,
  processing: true,
  serverSide: true,
  scrollX: false,
  searching: false, // ✅ disables the built-in search box
  ajax: {
    url: "search_my_profile.php",
    type: "POST",
    error: function(xhr, status, error) {
      console.error("AJAX Error:", {
        xhr: xhr.responseText,
        status: status,
        error: error
      });
    }
  },
  columnDefs: [{
    width: "100px",
    targets: -1,
    data: null,
    orderable: false,
    searchable: false,
    defaultContent: `
      <div class="dropdown">
        <button 
          class="btn btn-sm btn-primary dropdown-toggle" 
          type="button" 
          data-bs-toggle="dropdown" 
          aria-expanded="false">
          Actions
        </button>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" id="view_profile" href="#" title="View Profile">
              <i class="fa fa-folder"></i> View Profile
            </a>
          </li>
  
          <li>
            <a class="dropdown-item" id="view_logs" href="#" title="View Logs">
              <i class="fa fa-history"></i> View Logs
            </a>
          </li>
        </ul>
      </div>
    `
  }]

          // <li>
          //   <a class="dropdown-item" id="modal_schedule" href="#" title="Add Schedule" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
          //     <i class="fa fa-calendar"></i> Add Schedule
          //   </a>
          // </li>
});


    $("#users tbody").on("click", "#view_profile", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var emp_id = currow.find("td:eq(0)").text();
      // $('#viewIndividual').attr("href", "view_individual.php?&id=" + entity, '_parent');
      window.open("view_profile.php?emp_id=" + emp_id, '_parent');

    });

    $("#users tbody").on("click", "#view_logs", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var emp_id = currow.find("td:eq(0)").text();
      // $('#viewIndividual').attr("href", "view_individual.php?&id=" + entity, '_parent');
      window.open("view_employee_logs.php?emp_id=" + emp_id, '_parent');

    });

    $("#users tbody").on("click", "#modal_schedule", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var emp_id = currow.find("td:eq(0)").text();
      var entity_no = currow.find("td:eq(1)").text();
      var fullname = currow.find("td:eq(2)").text();
      var address = currow.find("td:eq(3)").text();
      var barangay = currow.find("td:eq(4)").text();
      var photo = currow.find("td:eq(5)").text();



      console.log("test");
      $('#modal_schedule').modal('show');
      $('#emp_id').val(emp_id);
      $('#entity_no').val(entity_no);
      $('#fullname1').val(fullname);
      $('#address').val(address);
      $('#barangay').val(barangay);

      $('#barangay_photo').attr("src", "/sccdrrmo/flutter/images/" + (photo));


    });
  </script>
</body>

</html>