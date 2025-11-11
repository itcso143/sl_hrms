<?php

include('../config/db_config.php');

// include('sql_queries.php');
// include('insert_dailypayment.php');
// include('insert_yearlypayment.php');



include('check_admin_session.php');




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

// $get_emp_sql = "SELECT emp_id,fullname FROM tbl_employee_info";
// $get_all_emp_data = $con->prepare($get_emp_sql);
// $get_all_emp_data->execute();



$get_schedule_sql = "SELECT * FROM tbl_schedule";
$get_schedule_data = $con->prepare($get_schedule_sql);
$get_schedule_data->execute();




?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Schedule </title>
  <?php include('heading.php'); ?>

  <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?php echo $title; ?></title>
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

  <link rel="stylesheet" href="../plugins/pixelarity/pixelarity.css">

  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
  <!-- <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.css"> -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">


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
          <!-- SALARY EDIT Modal -->


          <div class="card-header  text-white bg-dark">
            <h4>LIST Schedule

              <a id="add_employee"
                type="button"
                class="btn btn-primary bg-gradient-success"
                style="float: right; border-radius: 0px;"
                data-bs-toggle="modal"
                data-bs-target="#addPayrollModal">
                <i>ADD NEW SCHEDULE</i>
              </a>

            </h4>

          </div>

          <!-- Add New Payroll Modal -->
          <div class="modal fade" id="addPayrollModal" tabindex="-1" aria-labelledby="v" aria-hidden="true">

            <div class="modal-dialog modal-dialog" style="max-width: 900px; width: 90%;">

              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="addPayrollModalLabel">Add New Schedule</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Your form or content goes here -->
                  <form method="POST" action="insert_new_schedule.php">




                    <br>
                    <div class="row g-3">
                      <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="mb-3">
                          <label for="schedule_code" class="form-label">Schedule Code:</label>
                          <input type="text" class="form-control" id="schedule_code" name="schedule_code" placeholder="">
                        </div>
                      </div>

                      <div class="col-lg-8 col-md-4 col-sm-6">
                        <div class="mb-3">
                          <label for="description" class="form-label">Description</label>
                          <input type="text" class="form-control" id="description" name="description" placeholder="">
                        </div>
                      </div>


                    </div>




                    <br>

                    <div class="row">
                      <div class="col-lg-6">
                        <label for="time_from">Time from:</label>
                        <input type="time" name="time_from" id="time_from" class="form-control" required step="60">
                      </div>

                      <div class="col-lg-6">
                        <label for="time_to">Time to:</label>
                        <input type="time" name="time_to" id="time_to" class="form-control" required step="60">
                      </div>
                    </div>


                    <br>




                    <br>



                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <input type="submit" name="insert_new_schedule" class="btn btn-primary" value="Save Schedule">
                </div>
                </form>
              </div>
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

                      <th> SCHEDULE CODE </th>
                      <th> DESCRIPTION </th>
                      <th> PUNCH IN </th>
                      <th> PUNCH OUT </th>




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
    </div>

    </section>
    <br><br>

  </div><!-- /.content-wrapper -->



  </div>


  <div class="modal fade" id="delete_sched" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="delete_schedule.php">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="sched_code" id="sched_code" class="form-control">
                <input readonly="true" type="text" name="fullname" id="fullname" class="form-control">

              </div>



            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

            <input type="submit" name="delete_schedule" class="btn btn-danger" value="Yes">
          </div>
        </form>


      </div>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->



  </div><!-- /.wrapper -->


  <?php include('pluginscript.php') ?>

  <?php if (isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
    <script>
      Swal.fire({
        title: "<?php echo $_SESSION['status']; ?>",
        icon: "<?php echo $_SESSION['status_code']; ?>",
        confirmButtonText: "OK"
      });
    </script>
  <?php
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
  endif;
  ?>


  <script>
    function enforce24Hour(input) {
      input.addEventListener('change', () => {
        const value = input.value;
        if (value) {
          const [hours, minutes] = value.split(':');
          input.value = `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}`;
        }
      });
    }

    enforce24Hour(document.getElementById('time_from'));
    enforce24Hour(document.getElementById('time_to'));
  </script>

  <script>
    function myFunction() {
      location.reload();
    }
  </script>


  <script>
    var dataTable = $('#users').DataTable({

      page: true,
      stateSave: true,
      processing: true,
      serverSide: true,
      scrollX: false,
      ajax: {
        url: "search_new_schedule.php",
        type: "post",
        error: function(xhr, b, c) {
          console.log(
            "xhr=" +
            xhr.responseText +
            " b=" +
            b.responseText +
            " c=" +
            c.responseText

          );
        }
      },
      columnDefs: [{
        width: "120px",
        targets: -1,
        data: null,
        defaultContent: `
      <div class="dropdown">
        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" 
                id="actionMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenuButton">
        
        
       
     <li>
          <a class="dropdown-item delete" href="#" title="Delete Record">
            <i class="fa fa-trash-o text-danger"></i> Delete
          </a>
        </li>
       
        </ul>
      </div>
    `
      }]

    

    });

    








    $(function() {
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var sched_code = currow.find("td:eq(0)").text();
        var description = currow.find("td:eq(4)").text();
        $('#delete_sched').modal('show');
        $('#sched_code').val(sched_code);
        $('#description').val(description);
      });
    });
  </script>




</body>

</html>