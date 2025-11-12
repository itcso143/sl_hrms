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

$get_schedule_sql = "SELECT * FROM tbl_schedule where status ='ACTIVE'";
$get_schedule_data = $con->prepare($get_schedule_sql);
$get_schedule_data->execute();

$get_company_sql = "SELECT * FROM tbl_company";
$get_company_data = $con->prepare($get_company_sql);
$get_company_data->execute();

$get_quantity_sql = "SELECT * FROM tbl_quantity";
$get_quantity_data = $con->prepare($get_quantity_sql);
$get_quantity_data->execute();

$get_basic_salary_sql = "SELECT * FROM tbl_salary_grade";
$get_basic_salary_data = $con->prepare($get_basic_salary_sql);
$get_basic_salary_data->execute();

$get_rate_sql = "SELECT * FROM tbl_salary_grade";
$get_rate_data = $con->prepare($get_rate_sql);
$get_rate_data->execute();

$get_emp_total_sql = "SELECT * FROM tbl_salary_grade";
$get_emp_total_data = $con->prepare($get_emp_total_sql);
$get_emp_total_data->execute();

$get_emp_gross_sql = "SELECT * FROM tbl_salary_grade";
$get_emp_gross_data = $con->prepare($get_emp_gross_sql);
$get_emp_gross_data->execute();

$get_emp_net_pay_sql = "SELECT * FROM tbl_salary_grade";
$get_emp_netpay_data = $con->prepare($get_emp_net_pay_sql);
$get_emp_netpay_data->execute();


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
          <!-- SALARY EDIT Modal -->


          <div class="card-header  text-white bg-dark">
            <h4>LIST EMPLOYEE

              <a href="add_employee" id="add_employee" style="float:right;" type="button" class="btn btn-primary bg-gradient-success" style="border-radius: 0px;">
                <i>ADD NEW EMPLOYEE</i></a>

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
                              <?= $get_schedule['schedule_code']; ?> - <?= $get_schedule['sched_in']; ?> - <?= $get_schedule['sched_out']; ?> - <?= $get_schedule['description']; ?>
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


          <!-- SALARY Modal -->
          <div class="modal fade" id="modal_salary" tabindex="-1" aria-labelledby="addSalaryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 900px; width: 90%;">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="addSalaryModalLabel">
                    <i class="fa fa-calendar"></i>Salary
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <form method="POST" action="create_employee_salary.php">
                  <div class="modal-body">
                    <div class="card">
                      <div class="row">
                        <!-- Left column: webcam / photo -->
                        <div class="col-md-3 text-center">
                          <video id="webcam" autoplay playsinline width="300" height="300" class="photo img-thumbnail d-none"></video>
                          <canvas id="canvas" width="300" height="300" class="photo img-thumbnail d-none" onclick="setup()"></canvas>
                          <audio id="snapSound" src="audio/snap.wav" preload="auto"></audio>
                          <img src="../photo/default.jpg" id="photo_employee" class="photo img-thumbnail mx-auto d-block" style="height:100px; width:100px;">
                        </div>

                        <!-- Right column: form inputs -->
                        <div class="col-md-9">
                          <div class="row mb-3">
                            <div class="col-lg-6">
                              <label for="emp_id_salary" class="form-label">EMP ID:</label>
                              <input readonly type="text" name="emp_id_salary" id="emp_id_salary" class="form-control">
                            </div>
                            <div class="col-lg-6">
                              <label for="date_joining" class="form-label">Date Hired:</label>
                              <input type="date" name="date_joining" id="date_joining" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-6">
                            <label for="date_from">Date:</label>
                            <input type="date" name="date_create_salary" id="date_create_salary" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-lg-12">
                            <label for="fullname_salary">Name:</label>
                            <input readonly type="text" name="fullname_salary" id="fullname_salary" class="form-control">
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <label for="get_schedule">Select Type of Address</label>
                            <select class="form-control select2" id="get_company" name="get_company">
                              <?php while ($get_company = $get_company_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_company == $get_company['company_name']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_company['company_name']; ?>">
                                  <?= $get_company['company_name']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-lg-3">
                            <label for="date_from">Date from:</label>
                            <input type="date" name="date_from" id="date_from" class="form-control" required>
                          </div>

                          <div class="col-lg-3">
                            <label for="date_to">Date to:</label>
                            <input type="date" name="date_to" id="date_to" class="form-control" required>
                          </div>



                          <div class="col-lg-4">

                            <button type="button" id="btn_generate_late" class="btn btn-primary">
                              <i class="fa fa-clock-o"></i> Generate Late
                            </button>
                          </div>

                        </div>
                        <br>

                        <!-- LATE DEDUCTIONS -->
                        <div class="row">
                          <div class="col-lg-3">
                            <label for="emp_late_deduction">Late:</label>
                            <input type="text" name="emp_late_deduction" id="emp_late_deduction" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_quantity_late">Quantity:</label>
                            <input type="number" name="emp_quantity_late" id="emp_quantity_late" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_rate_late">Rate:</label>
                            <input type="number" name="emp_rate_late" id="emp_rate_late" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_total_late">Total Late:</label>
                            <input type="number" name="emp_total_late" id="emp_total_late" class="form-control" value="">
                          </div>

                        </div>
                        <br>
                        <!-- ABSENCES DEDUCTIONS -->
                        <div class="row">
                          <div class="col-lg-3">
                            <label for="emp_absences_deduction">Absences:</label>
                            <input type="text" name="emp_absences_deduction" id="emp_absences_deduction" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_quantity_absences">Quantity:</label>
                            <input type="number" name="emp_quantity_absences" id="emp_quantity_absences" class="form-control" value="">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_rate_absences">Rate:</label>
                            <input type="number" name="emp_rate_absences" id="emp_rate_absences" class="form-control" value="">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_total_absences">Total Absences:</label>
                            <input type="number" name="emp_total_absences" id="emp_total_absences" class="form-control" value="">
                          </div>

                        </div>
                        <br>
                        <!-- HRMO DEDUCTIONS -->
                        <div class="row">
                          <div class="col-lg-3">
                            <label for="emp_hrmo_deduction">HMO:</label>
                            <input type="text" name="emp_hrmo_deduction" id="emp_hrmo_deduction" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_hrmo_quantity">Quantity:</label>
                            <input type="number" name="emp_hrmo_quantity" id="emp_hrmo_quantity" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_hrmo_rate">Rate:</label>
                            <input type="number" name="emp_hrmo_rate" id="emp_hrmo_rate" class="form-control">
                          </div>

                          <div class="col-lg-3">
                            <label for="emp_hrmo_total">Total HMO:</label>
                            <input type="number" name="emp_hrmo_total" id="emp_hrmo_total" class="form-control">
                          </div>

                        </div>
                        <br>

                        <div class="row">
                          <div class="col-lg-3">
                            <label for="emp_basic_salary">Basic Salary:</label>
                            <input type="text" name="emp_basic_salary" id="emp_basic_salary" class="form-control">
                          </div>



                          <div class="col-md-3">
                            <label for="get_schedule">Select Quantity</label>
                            <select class="form-control select2" id="emp_quantity" name="emp_quantity">
                              <?php while ($get_quantity = $get_quantity_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_quantity == $get_quantity['quantity']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_quantity['quantity']; ?>">
                                  <?= $get_quantity['quantity']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>

                          <!-- <div class="col-md-3">
                            <label for="get_schedule">Select Rate</label>
                            <select class="form-control select2" id="emp_rate" name="emp_rate">
                              <?php while ($get_rate = $get_rate_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_rate == $get_rate['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_rate['salary']; ?>">
                                  <?= $get_rate['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div> -->

                          <div class="col-lg-3">
                            <label for="emp_rate">Rate:</label>
                            <input type="text" name="emp_rate" id="emp_rate" class="form-control">
                          </div>
                          <div class="col-lg-3">
                            <label for="emp_total">Total:</label>
                            <input type="text" name="emp_total" id="emp_total" class="form-control">
                          </div>

                          <!-- <div class="col-md-3">
                            <label for="get_schedule">Select Total</label>
                            <select class="form-control select2" id="emp_total" name="emp_total">
                              <?php while ($get_total_salary = $get_emp_total_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_total_salary == $get_total_salary['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_total_salary['salary']; ?>">
                                  <?= $get_total_salary['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div> -->

                        </div>
                        <br>
                        <div class="row">
                          <div class="col-lg-6">
                            <label for="emp_gross_pay">Current Gross Pay:</label>
                            <input type="text" name="emp_gross_pay" id="emp_gross_pay" class="form-control">
                          </div>

                          <!-- <div class="col-md-3">
                            <label for="get_schedule">Select Gross</label>
                            <select class="form-control select2" id="emp_gross_pay" name="emp_gross_pay">
                              <?php while ($get_gross = $get_emp_gross_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_gross == $get_gross['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_gross['salary']; ?>">
                                  <?= $get_gross['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div> -->

                          <div class="col-lg-3">
                            <label for="netpay">Net Pay:</label>
                            <input type="number" name="emp_current_pay" id="netpay" class="form-control" value="">
                          </div>

                          <!-- <div class="col-lg-6">
                            <label for="emp_current_pay">Current Net Pay:</label>
                            <input type="text" name="emp_current_pay" id="netpay" class="form-control">
                          </div> -->

                          <!-- <div class="col-md-3">
                            <label for="get_schedule">Select Current Net Pay</label>
                            <select class="form-control select2" id="emp_current_pay" name="emp_current_pay">
                              <?php while ($get_netpay = $get_emp_netpay_data->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($get_emp_netpay == $get_netpay['salary']) ? 'selected' : '';
                              ?>
                                <option <?= $selected; ?> value="<?= $get_netpay['salary']; ?>">
                                  <?= $get_netpay['salary']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div> -->

                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" name="create_employee_salary" class="btn btn-primary" value="Update Salary">
                  </div>
                </form>

              </div>
            </div>
          </div>



          <!-- Payslip Modal -->
          <div class="modal fade" id="modal_payslip" tabindex="-1" aria-labelledby="addPayslipModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 1100px;">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="addPayslipModalLabel">
                    <i class="fa fa-folder"></i> Payslip
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <form method="POST" action="">
                  <div class="modal-body">
                    <div class="card mb-3">
                      <div class="row g-3 p-3">

                        <!-- Right column: form inputs -->
                        <div class="col-md-6">
                          <label for="emp_id_payslip" class="form-label">EMP ID:</label>
                          <input readonly type="text" name="emp_id_payslip" id="emp_id_payslip" class="form-control">
                        </div>

                        <div class="col-md-6">
                          <label for="fullname_payslip" class="form-label">Name:</label>
                          <input readonly type="text" name="fullname_payslip" id="fullname_payslip" class="form-control">
                        </div>


                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table id="users2" class="table table-bordered table-striped w-500">
                            <thead class="text-center">
                              <tr>
                                <th>ID</th>
                                <th>SALARY ID</th>
                                <th>EMP ID</th>
                                <th>DATE CREATED</th>
                                <th>DATE</th>

                                <th>TOTAL</th>
                                <th>PAYABLE</th>
                                <th>OPTIONS</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                              <!-- Example placeholder row -->
                              <tr>
                                <td colspan="8">No data available</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- Modal Footer -->
                  <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" name="create_employee_salary" class="btn btn-primary" value="Update Salary">
                  </div> -->
                </form>

              </div>
            </div>
          </div>


          <!-- Schedule Modal -->
          <div class="modal fade" id="modal_livestream" tabindex="-1" aria-labelledby="addlivestreamModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="addLivestreamModalLabel">
                    <i class="fa fa-calendar"></i> Add Live Stream Link
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <form method="POST" action="update_user_link.php">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-5">
                        <label for="emp_id_livestream">EMP ID:</label>
                        <input readonly type="text" name="emp_id_livestream" id="emp_id_livestream" class="form-control">
                      </div>

                      <div class="col-lg-5">
                        <label for="emp_schedule_code">SCHEDULE CODE:</label>
                        <input readonly type="text" name="emp_schedule_code" id="emp_schedule_code" class="form-control">
                      </div>
                    </div>

                    <br>

                    <div class="row">
                      <div class="col-lg-12">
                        <label for="fullname_livestream">Name:</label>
                        <input type="text" name="fullname_livestream" id="fullname_livestream" class="form-control">
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-lg-12">
                        <label for="link_livestream">URL:</label>
                        <input type="text" name="link_livestream" id="link_livestream" class="form-control">
                      </div>
                    </div>

                    <br>


                  </div>

                  <!-- Modal Footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" name="update_user_link" class="btn btn-primary" value="Save">
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

                      <th> EMP_ID </th>
                      <th> DATE HIRED </th>
                      <th> SCHEDULE </th>
                      <th> FULLNAME </th>
                      <th> PHOTO </th>



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







    <div class="modal fade" id="delete_payslip" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirm Delete</h4>
          </div>
          <form method="POST" action="delete_monthly_payslip.php">
            <div class="modal-body">
              <div class="box-body">
                <div class="form-group">
                  <label>Delete Record?</label>
                  <input readonly="true" type="text" name="emp_id_new" id="emp_id_new" class="form-control">
                  <input readonly="true" type="text" name="payslip_id" id="payslip_id" class="form-control">

                </div>



              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

              <input type="submit" name="delete_monthly_payslip" class="btn btn-danger" value="Yes">
            </div>
          </form>


        </div>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->


    <div class="modal fade" id="delete_emp" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirm Delete</h4>
          </div>
          <form method="POST" action="delete_employee_data.php">
            <div class="modal-body">
              <div class="box-body">
                <div class="form-group">
                  <label>Delete Record?</label>
                  <input readonly="true" type="text" name="emp_id_new2" id="emp_id_new2" class="form-control">
                  <input readonly="true" type="text" name="fullname_emp" id="fullname_emp" class="form-control">

                </div>



              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

              <input type="submit" name="delete_employee_data" class="btn btn-danger" value="Yes">
            </div>
          </form>


        </div>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->




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

      page: true,
      stateSave: true,
      processing: true,
      serverSide: true,
      scrollX: false,
      ajax: {
        url: "search_employee.php",
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
            <a class="dropdown-item " id="view_profile" href="#" title="View Profile">
              <i class="fa fa-folder"></i> View Profile
            </a>
          </li>



            <li>
        <a class="dropdown-item" id="modal_salary" href="#" title="Add Schedule" data-bs-toggle="modal" data-bs-target="#addSalaryModal">
           <i class="fa fa-money"></i> Salary
          </a>
          </li>

        <li>
        <a class="dropdown-item" id="modal_payslip" href="#" title="Payslip" data-bs-toggle="modal" data-bs-target="#addPayslipModal">
           <i class="fa fa-file"></i> Payslip
          </a>
          </li>

          <li>
        <a class="dropdown-item" id="modal_schedule" href="#" title="Add Schedule" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
           <i class="fa fa-calendar"></i> Add Schedule
          </a>
          </li>

            <li>
        <a class="dropdown-item" id="modal_livestream" href="#" title="Add Livestream" data-bs-toggle="modal" data-bs-target="#addLivestreamModal">
           <i class="fa fa-link"></i> Add Livestream Link
          </a>
          </li>

        

          <li>
            <a class="dropdown-item " id="view_logs" href="#" title="View Logs">
              <i class="fa fa-history"></i> View Logs
            </a>
          </li>

           <li>
          <a class="dropdown-item delete_emp" href="#" title="Delete Record">
            <i class="fa fa-trash-o text-danger"></i> Delete
          </a>
        </li>
       
       
        </ul>
      </div>
    `
      }]

      //  <li>
      //     <a class="dropdown-item delete" href="#" title="Delete Record">
      //       <i class="fa fa-trash-o"></i> Delete
      //     </a>
      //   </li>

      // <li>
      //   <a class="dropdown-item editIndividual" id="modal" href="#" title="View">
      //     <i class="fa fa-file-o"></i> Clearance
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

    $(document).ready(function() {
      $("#users tbody").on("click", "#modal_livestream", function() {
        event.preventDefault();
        var currow = $(this).closest("tr");
        var emp_id = currow.find("td:eq(0)").text();
        var fullname = currow.find("td:eq(3)").text();
        var schedule = currow.find("td:eq(2)").text();

        console.log("test");
        $('#modal_livestream').modal('show');
        $('#emp_id_livestream').val(emp_id);
        $('#fullname_livestream').val(fullname);
        $('#emp_schedule_code').val(schedule);

      });


    });

    $(document).ready(function() {
      $("#users tbody").on("click", "#modal_schedule", function() {
        event.preventDefault();
        var currow = $(this).closest("tr");

        var emp_id = currow.find("td:eq(0)").text();
        var entity_no = currow.find("td:eq(1)").text();
        var fullname = currow.find("td:eq(2)").text();
        var address = currow.find("td:eq(3)").text();
        var barangay = currow.find("td:eq(4)").text();




        console.log("test");
        $('#modal_schedule').modal('show');
        $('#emp_id').val(emp_id);

        $('#fullname1').val(fullname);





      });

      $("#users tbody").on("click", "#modal_salary", function(event) {
        event.preventDefault();

        var currow = $(this).closest("tr");

        // Get basic info from the table row
        var emp_id = currow.find("td:eq(0)").text();
        var date_joining = currow.find("td:eq(1)").text();
        var fullname = currow.find("td:eq(3)").text();
        var photo = currow.find("td:eq(4) img").attr("src");

        // Set basic info in modal
        $('#emp_id_salary').val(emp_id);
        $('#date_joining').val(date_joining);
        $('#fullname_salary').val(fullname);

        // Set photo
        if (photo && photo.trim() !== "") {
          $('#photo_employee').attr("src", photo);
        } else {
          $('#photo_employee').attr("src", "/sl_hrms/photo/default.jpg");
        }


        // Make sure this runs after employee is selected
        $('#emp_id_data').on('change', function() {
          const emp_id = $(this).val();
          if (!emp_id) return; // Exit if nothing selected


        });

        $(document).ready(function() {
          $('#btn_generate_late').on('click', function(e) {
            e.preventDefault();

            // Grab input values safely
            var empId = $('#emp_id_salary').val();
            var dateFrom = $('#date_from').val();
            var dateTo = $('#date_to').val();

            console.log('Employee ID:', empId);
            console.log('Date From:', dateFrom);
            console.log('Date To:', dateTo);

            // Validate inputs
            if (!empId || !dateFrom || !dateTo) {
              alert('Please select employee and date range');
              return;
            }

            // AJAX request to calculate late + early leave
            $.ajax({
              url: 'get_employee_late.php', // your PHP script
              type: 'POST',
              dataType: 'json',
              data: {
                emp_id: empId,
                date_from: dateFrom,
                date_to: dateTo
              },
              success: function(response) {
                if (response.success) {
                  // Combine late + early leave
                  const totalDeduction = response.data.total_late;

                  // Populate the result into the text field
                  $('#emp_late_deduction').val(totalDeduction);
                } else {
                  alert(response.message);
                  $('#emp_late_deduction').val('0');
                }
              },
              error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('#emp_late_deduction').val('0');
              }
            });
          });
        });


        $('#emp_quantity_absences, #emp_rate_absences').on('input', function() {
          const qty = parseFloat($('#emp_quantity_absences').val()) || 0;
          const rate = parseFloat($('#emp_rate_absences').val()) || 0;
          const total = qty * rate;
          $('#emp_total_absences').val(total.toFixed(2));

          // 👇 Trigger recalculation of Net Pay (from your earlier script)
          $('#emp_total_absences').trigger('input');
        });

        $('#emp_quantity_late, #emp_rate_late').on('input', function() {
          const qty = parseFloat($('#emp_quantity_late').val()) || 0;
          const rate = parseFloat($('#emp_rate_late').val()) || 0;
          const total = qty * rate;
          $('#emp_total_late').val(total.toFixed(2));

          // 👇 Trigger recalculation of Net Pay (from your earlier script)
          $('#emp_total_late').trigger('input');
        });

        $('#emp_hrmo_quantity, #emp_hrmo_rate').on('input', function() {
          const qty = parseFloat($('#emp_hrmo_quantity').val()) || 0;
          const rate = parseFloat($('#emp_hrmo_rate').val()) || 0;
          const total = qty * rate;

          $('#emp_hrmo_total').val(total.toFixed(2));

          // 👇 Trigger recalculation of Net Pay (from your earlier script)
          $('#emp_hrmo_total').trigger('input');
        });

        // --- Fetch Net Pay via AJAX ---
        $.ajax({
          url: 'get_employee_netpay.php',
          method: 'POST',
          data: {
            emp_id: emp_id
          },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              var baseNetPay = parseFloat(response.data.netpay) || 0;
              $('#netpay').val(baseNetPay);
              $('#emp_basic_salary').val(response.data.netpay);
              $('#emp_gross_pay').val(response.data.netpay);
              $('#emp_rate').val(response.data.netpay);
              $('#emp_total').val(response.data.netpay);


              // --- Automatic deduction for multiple fields ---
              function recalcNetPay() {
                var late = parseFloat($('#emp_total_late').val()) || 0;
                var absences = parseFloat($('#emp_total_absences').val()) || 0;
                var hrmo = parseFloat($('#emp_hrmo_total').val()) || 0;

                var totalDeduction = late + absences + hrmo;
                var newNetPay = baseNetPay - totalDeduction;

                $('#netpay').val(newNetPay >= 0 ? newNetPay : 0);
              }

              // Bind input event to all deduction fields
              $('#emp_total_late, #emp_total_absences, #emp_hrmo_total').off('input').on('input', recalcNetPay);

            } else {
              console.error("Failed to fetch net pay:", response.message);
              $('#netpay').val("N/A");
            }
            // Show modal after success
            $('#modal_salary').modal('show');
          },
          error: function(xhr, status, error) {
            console.error("AJAX error:", error);
            $('#netpay').val("N/A");
            $('#modal_salary').modal('show');
          }
        });







        console.log("Clicked Emp ID:", emp_id);


      });

    });


    if ($.fn.DataTable.isDataTable('#users2')) {
      $('#users2').DataTable().clear().destroy();
    }

    $("#users tbody").on("click", "#modal_payslip", function() {
      event.preventDefault();
      var currow = $(this).closest("tr");

      var emp_id_new = currow.find("td:eq(0)").text();
      var emp_id_new2 = currow.find("td:eq(0)").text();

      var fullname = currow.find("td:eq(3)").text();





      console.log("test");
      $('#modal_payslip').modal('show');
      $('#emp_id_payslip').val(emp_id_new);

      $('#fullname_payslip').val(fullname);


      if ($.fn.DataTable.isDataTable('#users2')) {
        $('#users2').DataTable().clear().destroy();
      }

      $('#users2').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        scroller: true,
        searching: false,
        paging: true,
        scrollY: false,

        ajax: {
          url: "search_payslip.php",
          type: "POST",
          data: function(d) {
            d.emp_id = emp_id_new2; // match PHP variable
          },
          error: function(xhr, textStatus, errorThrown) {
            console.error("AJAX Error:", xhr.responseText);
          }
        },

        columnDefs: [{
          targets: -1,
          width: "160px",
          data: null,
          defaultContent: '<button class="btn btn-primary btn-sm editIndividual" id="print_payslip"  title="Print">Print</button>'

            +
            ' <button class="btn btn-danger btn-sm  delete" id="delete"  title="View"><i class=" text-white">Delete</i></button>'


        }]
      });




      $("#users2").on("click", "#print_payslip", function(event) {
        event.preventDefault(); // prevent default behavior

        var currow = $(this).closest("tr");
        var emp_id = currow.find("td:eq(1)").text().trim(); // get employee ID

        // Open the pay slip in a new tab
        var url = "../plugins/TCPDF/User/pay_slip.php?salary_id=" + emp_id;
        window.open(url, "_blank");
      });



      $("#users2").on("click", "#modal_salary_edit", function(event) {
        event.preventDefault();

        var currow = $(this).closest("tr");

        // Get basic info from the table row
        var emp_id = currow.find("td:eq(2)").text();
        var salary_id = currow.find("td:eq(1)").text();
        var date_joining = currow.find("td:eq(1)").text();



        // Set basic info in modal
        $('#emp_id_edit_salary').val(emp_id);
        $('#emp_date_edit_salary').val(date_joining);

        $('#emp_salary_id_edit').val(salary_id);


        $.ajax({
          url: 'get_emp_salary_edit.php', // correct path
          method: 'POST',
          data: {
            salary_id: salary_id
          },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              $('#emp_fullname_edit_salary').val(response.data.fullname_salary);
              $('#emp_late_deduction_edit').val(response.data.emp_late_deduction);
            } else {
              console.error("Failed to fetch net pay:", response.message);
              $('#emp_fullname_edit_salary').val("N/A");
            }
            // Show modal after success
            $('#modal_salary_edit').modal('show');
            $('#modal_salary').modal('hide');
          },
          error: function(xhr, status, error) {
            console.error("AJAX error:", error);
            $('#netpay').val("N/A");
            $('#modal_salary_edit').modal('show'); // still show modal on error
          }
        });

        console.log("Clicked Emp ID:", emp_id);
      });
    });


    // $("#users tbody").on("click", "#modal", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");

    //   var objid1 = currow.find("td:eq(0)").text();
    //   var entity_no = currow.find("td:eq(1)").text();
    //   var fullname = currow.find("td:eq(2)").text();
    //   var address = currow.find("td:eq(3)").text();
    //   var barangay = currow.find("td:eq(4)").text();
    //   var photo = currow.find("td:eq(5)").text();



    //   console.log("test");
    //   $('#modalupdate').modal('show');
    //   $('#objid1').val(objid1);
    //   $('#entity_no').val(entity_no);
    //   $('#fullname1').val(fullname);
    //   $('#address').val(address);
    //   $('#barangay').val(barangay);

    //   $('#barangay_photo').attr("src", "/sccdrrmo/flutter/images/" + (photo));


    // });




    $(function() {
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var emp_id_new = currow.find("td:eq(0)").text();
        var payslip_id = currow.find("td:eq(1)").text();
        $('#delete_payslip').modal('show');
        $('#emp_id_new').val(emp_id_new);
        $('#payslip_id').val(payslip_id);
      });
    });

    $(function() {
      $(document).on('click', '.delete_emp', function(e) {
        e.preventDefault();

        var currow = $(this).closest("tr");
        var emp_id_new2 = currow.find("td:eq(0)").text();
        var fullname_emp = currow.find("td:eq(3)").text();
        $('#delete_emp').modal('show');
        $('#emp_id_new2').val(emp_id_new2);
        $('#fullname_emp').val(fullname_emp);
      });
    });
  </script>



  <!-- <script>
    const lateInput = document.getElementById('emp_total_late');
    const netpayInput = document.getElementById('netpay');

    // Store the original net pay so deduction always starts from base
    const baseNetPay = parseFloat(netpayInput.value);

    lateInput.addEventListener('input', () => {
      const lateValue = parseFloat(lateInput.value) || 0; // handle empty input
      const newNetPay = baseNetPay - lateValue;
      netpayInput.value = newNetPay >= 0 ? newNetPay : 0; // prevent negative pay
    });
  </script> -->

  <!-- <script>
    let baseNetPay = 0;

    // This observer will detect when AJAX updates the #netpay value
    const netpayInput = document.getElementById('netpay');
    const lateInput = document.getElementById('emp_total_late');

    const observer = new MutationObserver(() => {
      baseNetPay = parseFloat(netpayInput.value) || 0;
    });

    // Watch for any attribute change (like value set by AJAX)
    observer.observe(netpayInput, {
      attributes: true,
      attributeFilter: ['value']
    });

    // When user types in total late, deduct from base net pay
    lateInput.addEventListener('input', () => {
      const lateValue = parseFloat(lateInput.value) || 0;
      const newNetPay = baseNetPay - lateValue;
      netpayInput.value = newNetPay >= 0 ? newNetPay : 0;
    });
  </script> -->


</body>

</html>