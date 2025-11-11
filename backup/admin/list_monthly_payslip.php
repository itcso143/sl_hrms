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

$get_company_sql = "SELECT * FROM tbl_company order by id DESC";
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
  <title>PAYROLL </title>
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
            <h4>LIST MONTHLY PAYSLIP

              <!-- <a id="add_employee"
                type="button"
                class="btn btn-primary bg-gradient-success"
                style="float: right; border-radius: 0px;"
                data-bs-toggle="modal"
                data-bs-target="#addPayrollModal">
                <i>ADD WEEKLY PAYSLIP</i>
              </a> -->

            </h4>

          </div>

          <!-- Add New Payroll Modal -->
          <div class="modal fade" id="addPayrollModal" tabindex="-1" aria-labelledby="v" aria-hidden="true">

            <div class="modal-dialog modal-dialog" style="max-width: 900px; width: 90%;">

              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="addPayrollModalLabel">Add Weekly Payslip</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Your form or content goes here -->
                  <form method="POST" action="insert_payroll_weekly.php">


                    <div class="modal-body">
                      <label>Select Employee:</label>
                      <select class="form-control select2" id="emp_id_data" name="emp_id_name" style="width: 100%;">
                        <option value="">Select Employee</option>
                      </select>
                    </div>

                    <br>
                    <div class="row g-3">
                      <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="mb-3">
                          <label for="emp_id5" class="form-label">Emp_id</label>
                          <input type="text" class="form-control" id="emp_id5" name="emp_id5" placeholder="">
                        </div>
                      </div>

                      <div class="col-lg-8 col-md-4 col-sm-6">
                        <div class="mb-3">
                          <label for="emp_fullname" class="form-label">fullname</label>
                          <input type="text" class="form-control" id="emp_fullname" name="emp_fullname" placeholder="">
                        </div>
                      </div>


                    </div>

                    <div class="row g-3">
                      <div class="col-md-8">
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
                      <div class="col-lg-6">
                        <label for="date_from">Date from:</label>
                        <input type="date" name="date_from" id="date_from" class="form-control" required>
                      </div>

                      <div class="col-lg-6">
                        <label for="date_to">Date to:</label>
                        <input type="date" name="date_to" id="date_to" class="form-control" required>
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
                        <label for="emp_hrmo_total">Total Hmo:</label>
                        <input type="number" name="emp_hrmo_total" id="emp_hrmo_total" class="form-control">
                      </div>

                    </div>

                    <br>

                    <div class="row g-3">
                      <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="mb-3">
                          <label for="daily_hours" class="form-label">Hours Worked</label>
                          <input type="text" class="form-control" id="daily_hours" name="daily_hours" placeholder="Enter amount">
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="mb-3">
                          <label for="payroll_gross" class="form-label">Gross Pay</label>
                          <input type="number" class="form-control" id="payroll_gross" name="payroll_gross" placeholder="Enter amount">
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="mb-3">
                          <label for="total_emp_deduction" class="form-label">Deduction</label>
                          <input type="number" class="form-control" id="total_emp_deduction" name="total_emp_deduction" placeholder="Enter amount">
                        </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="emp_total_netpay" class="form-label">Net Pay</label>
                      <input type="number" class="form-control" id="emp_total_netpay" name="emp_total_netpay" placeholder="Enter amount">
                    </div>
                    <br>



                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <input type="submit" name="insert_payroll_weekly" class="btn btn-primary" value="Save Payroll">
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

            
                      <th> PAYSLIP ID </th>
                      <th> EMP ID </th>
                      <th> DATE </th>
                      <th> DATE COVERED </th>
                      <th> NAME </th>
                      <th> TOTAL </th>
                      <th> GROSS PAY </th>
                      <th> NETPAY </th>



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


  <div class="modal fade" id="delete_payslip" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="delete_payslip_monthly.php">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="salary_id" id="salary_id" class="form-control">
                <input readonly="true" type="text" name="fullname" id="fullname" class="form-control">

              </div>



            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

            <input type="submit" name="delete_payslip_monthly" class="btn btn-danger" value="Yes">
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
        url: "search_monthly_payslip.php",
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
  <a class="dropdown-item d-flex align-items-center" id="print_payroll" href="#" title="Print Payroll">
    <i class="fa fa-print me-2 text-primary"></i> Print
  </a>
</li>
       
     <li>
          <a class="dropdown-item delete" href="#" title="Delete Record">
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

    $(document).ready(function() {

      // Initialize Select2 when modal is shown
      $('#addPayrollModal').on('shown.bs.modal', function() {
        $('#emp_id_data').select2({
          dropdownParent: $('#addPayrollModal'), // Correct modal ID
          placeholder: 'Select Employee',
          allowClear: true,
          ajax: {
            url: 'search_emp_data.php',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
              return {
                searchTerm: params.term || ''
              };
            },
            processResults: function(data) {
              return {
                results: data
              };
            },
            cache: true
          }
        });

        // Make sure this runs after employee is selected
        $('#emp_id_data').on('change', function() {
          var emp_id = $(this).val();
          if (!emp_id) return; // exit if nothing is selected

          $.ajax({
            url: 'get_employee_gross.php',
            method: 'POST',
            data: {
              emp_id: emp_id
            },
            dataType: 'json',
            success: function(response) {
              if (response && response.success) {
                // Use optional chaining in case response.data is undefined
                $('#payroll_gross').val(response.data?.gross ?? "N/A");
              } else {
                $('#payroll_gross').val("N/A");
                console.warn("Employee gross not found:", response.message || "");
              }

            },
            error: function(xhr, status, error) {
              console.error("AJAX error:", error);
              $('#payroll_gross').val("N/A");
              $('#addPayrollModal').modal('show');
            }
          });
        });
      });

      $(document).ready(function() {

        // --- Initialize Select2 for employee dropdown ---
        $('#emp_id_data').select2({
          dropdownParent: $('#addPayrollModal'), // Correct modal
          placeholder: 'Select Employee',
          allowClear: true,
          ajax: {
            url: 'search_emp_data.php',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
              return {
                searchTerm: params.term || ''
              };
            },
            processResults: function(data) {
              return {
                results: data
              };
            },
            cache: true
          }
        });



        // --- When an employee is selected ---
        $('#emp_id_data').on('change', function() {
          var emp_id = $(this).val();
          console.log('Selected employee ID:', emp_id); // 🔍 Debug
          if (!emp_id) return;

          $.ajax({
            url: 'emp_id_profile_data.php',
            type: 'POST',
            data: {
              emp_id: emp_id
            },
            dataType: 'json',
            success: function(response) {
              if (response.success) {
                // Fill employee fields
                $('#emp_id5').val(response.data || '');
                $('#emp_fullname').val(response.data1 || '');
                var baseNetPay = parseFloat(response.data2.netpay) || 0;
                $('#emp_total_netpay').val(baseNetPay.toFixed(2));

                // --- Recalculate net pay ---
                function recalcNetPay() {
                  var late = parseFloat($('#emp_total_late').val()) || 0;
                  var absences = parseFloat($('#emp_total_absences').val()) || 0;
                  var hrmo = parseFloat($('#emp_hrmo_total').val()) || 0;
                  var totalDeduction = late + absences + hrmo;
                  var newNetPay = baseNetPay - totalDeduction;
                  $('#emp_total_netpay').val(newNetPay >= 0 ? newNetPay.toFixed(2) : '0.00');
                }

                // Bind input events to recalc net pay
                $('#emp_total_late, #emp_total_absences, #emp_hrmo_total')
                  .off('input')
                  .on('input', recalcNetPay);

              } else {
                console.error('Employee data not found');
              }
            },
            error: function(xhr, status, error) {
              console.error('AJAX error:', error);
            }
          });



        });

        // --- Deduction calculation helper ---
        function setupDeductionCalc(qtySelector, rateSelector, totalSelector) {
          $(qtySelector + ', ' + rateSelector).on('input', function() {
            var qty = parseFloat($(qtySelector).val()) || 0;
            var rate = parseFloat($(rateSelector).val()) || 0;
            var total = qty * rate;
            $(totalSelector).val(total.toFixed(2)).trigger('input'); // triggers net pay recalculation
          });
        }

        // --- Initialize deduction calculations ---
        setupDeductionCalc('#emp_quantity_absences', '#emp_rate_absences', '#emp_total_absences');
        setupDeductionCalc('#emp_quantity_late', '#emp_rate_late', '#emp_total_late');
        setupDeductionCalc('#emp_hrmo_quantity', '#emp_hrmo_rate', '#emp_hrmo_total');

      });



      // Deduction calculations for quantity * rate fields
      function setupDeductionCalc(qtySelector, rateSelector, totalSelector) {
        $(qtySelector + ', ' + rateSelector).on('input', function() {
          var qty = parseFloat($(qtySelector).val()) || 0;
          var rate = parseFloat($(rateSelector).val()) || 0;
          var total = qty * rate;
          $(totalSelector).val(total.toFixed(2));

          // Trigger net pay recalculation
          $(totalSelector).trigger('input');
        });
      }

      setupDeductionCalc('#emp_quantity_absences', '#emp_rate_absences', '#emp_total_absences');
      setupDeductionCalc('#emp_quantity_late', '#emp_rate_late', '#emp_total_late');
      setupDeductionCalc('#emp_hrmo_quantity', '#emp_hrmo_rate', '#emp_hrmo_total');

    });





    $("#users tbody").on("click", "#print_payroll", function(event) {
      event.preventDefault(); // prevent default behavior

      var currow = $(this).closest("tr");
      var salary_id = currow.find("td:eq(0)").text().trim(); // get employee ID

      // Open the pay slip in a new tab
      var url = "../plugins/TCPDF/User/pay_slip.php?salary_id=" + salary_id;
      window.open(url, "_blank");
    });

    // $("#users tbody").on("click", "#view_logs", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");

    //   var emp_id = currow.find("td:eq(0)").text();
    //   // $('#viewIndividual').attr("href", "view_individual.php?&id=" + entity, '_parent');
    //   window.open("view_employee_logs.php?emp_id=" + emp_id, '_parent');

    // });

    // $("#users tbody").on("click", "#modal_schedule", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");

    //   var emp_id = currow.find("td:eq(0)").text();
    //   var entity_no = currow.find("td:eq(1)").text();
    //   var fullname = currow.find("td:eq(2)").text();
    //   var address = currow.find("td:eq(3)").text();
    //   var barangay = currow.find("td:eq(4)").text();




    //   console.log("test");
    //   $('#modal_schedule').modal('show');
    //   $('#emp_id').val(emp_id);

    //   $('#fullname1').val(fullname);





    // });

    // $("#users tbody").on("click", "#modal_salary", function(event) {
    //   event.preventDefault();

    //   var currow = $(this).closest("tr");

    //   // Get basic info from the table row
    //   var emp_id = currow.find("td:eq(0)").text();
    //   var date_joining = currow.find("td:eq(1)").text();
    //   var fullname = currow.find("td:eq(3)").text();
    //   var photo = currow.find("td:eq(4) img").attr("src");

    //   // Set basic info in modal
    //   $('#emp_id_salary').val(emp_id);
    //   $('#date_joining').val(date_joining);
    //   $('#fullname_salary').val(fullname);

    //   // Set photo
    //   if (photo && photo.trim() !== "") {
    //     $('#photo_employee').attr("src", photo);
    //   } else {
    //     $('#photo_employee').attr("src", "/sl_hrms/photo/default.jpg");
    //   }

    //   $('#emp_quantity_absences, #emp_rate_absences').on('input', function() {
    //     const qty = parseFloat($('#emp_quantity_absences').val()) || 0;
    //     const rate = parseFloat($('#emp_rate_absences').val()) || 0;
    //     const total = qty * rate;
    //     $('#emp_total_absences').val(total.toFixed(2));

    //     // 👇 Trigger recalculation of Net Pay (from your earlier script)
    //     $('#emp_total_absences').trigger('input');
    //   });

    //   $('#emp_quantity_late, #emp_rate_late').on('input', function() {
    //     const qty = parseFloat($('#emp_quantity_late').val()) || 0;
    //     const rate = parseFloat($('#emp_rate_late').val()) || 0;
    //     const total = qty * rate;
    //     $('#emp_total_late').val(total.toFixed(2));

    //     // 👇 Trigger recalculation of Net Pay (from your earlier script)
    //     $('#emp_total_late').trigger('input');
    //   });

    //   $('#emp_hrmo_quantity, #emp_hrmo_rate').on('input', function() {
    //     const qty = parseFloat($('#emp_hrmo_quantity').val()) || 0;
    //     const rate = parseFloat($('#emp_hrmo_rate').val()) || 0;
    //     const total = qty * rate;

    //     $('#emp_hrmo_total').val(total.toFixed(2));

    //     // 👇 Trigger recalculation of Net Pay (from your earlier script)
    //     $('#emp_hrmo_total').trigger('input');
    //   });

    //   // --- Fetch Net Pay via AJAX ---
    //   $.ajax({
    //     url: 'get_employee_netpay.php',
    //     method: 'POST',
    //     data: {
    //       emp_id: emp_id
    //     },
    //     dataType: 'json',
    //     success: function(response) {
    //       if (response.success) {
    //         var baseNetPay = parseFloat(response.data.netpay) || 0;
    //         $('#netpay').val(baseNetPay);

    //         // --- Automatic deduction for multiple fields ---
    //         function recalcNetPay() {
    //           var late = parseFloat($('#emp_total_late').val()) || 0;
    //           var absences = parseFloat($('#emp_total_absences').val()) || 0;
    //           var hrmo = parseFloat($('#emp_hrmo_total').val()) || 0;

    //           var totalDeduction = late + absences + hrmo;
    //           var newNetPay = baseNetPay - totalDeduction;

    //           $('#netpay').val(newNetPay >= 0 ? newNetPay : 0);
    //         }

    //         // Bind input event to all deduction fields
    //         $('#emp_total_late, #emp_total_absences, #emp_hrmo_total').off('input').on('input', recalcNetPay);

    //       } else {
    //         console.error("Failed to fetch net pay:", response.message);
    //         $('#netpay').val("N/A");
    //       }
    //       // Show modal after success
    //       $('#modal_salary').modal('show');
    //     },
    //     error: function(xhr, status, error) {
    //       console.error("AJAX error:", error);
    //       $('#netpay').val("N/A");
    //       $('#modal_salary').modal('show');
    //     }
    //   });

    //   console.log("Clicked Emp ID:", emp_id);
    // });


    // if ($.fn.DataTable.isDataTable('#users2')) {
    //   $('#users2').DataTable().clear().destroy();
    // }

    // $("#users tbody").on("click", "#modal_payslip", function() {
    //   event.preventDefault();
    //   var currow = $(this).closest("tr");

    //   var emp_id_new = currow.find("td:eq(0)").text();
    //   var emp_id_new2 = currow.find("td:eq(0)").text();

    //   var fullname = currow.find("td:eq(3)").text();





    //   console.log("test");
    //   $('#modal_payslip').modal('show');
    //   $('#emp_id_payslip').val(emp_id_new);

    //   $('#fullname_payslip').val(fullname);


    //   if ($.fn.DataTable.isDataTable('#users2')) {
    //     $('#users2').DataTable().clear().destroy();
    //   }

    //   // $('#users2').DataTable({
    //   //   processing: true,
    //   //   serverSide: true,
    //   //   deferRender: true,
    //   //   scroller: true,
    //   //   searching: false,
    //   //   paging: true,
    //   //   scrollY: false,

    //   //   ajax: {
    //   //     url: "search_payslip.php",
    //   //     type: "POST",
    //   //     data: function(d) {
    //   //       d.emp_id = emp_id_new2; // match PHP variable
    //   //     },
    //   //     error: function(xhr, textStatus, errorThrown) {
    //   //       console.error("AJAX Error:", xhr.responseText);
    //   //     }
    //   //   },

    //   //   columnDefs: [{
    //   //     targets: -1,
    //   //     width: "160px",
    //   //     data: null,
    //   //     defaultContent: '<button class="btn btn-primary btn-sm editIndividual" id="print_payslip"  title="Print">Print</button>'
    //   //     // +
    //   //     //   ' <button class="btn btn-warning btn-sm editIndividual" id="modal_salary_edit"  title="View"><i class="fa fa-edit">Edit</i></button>'
    //   //   }]
    //   // });




    //   // $("#users2").on("click", "#print_payslip", function(event) {
    //   //   event.preventDefault(); // prevent default behavior

    //   //   var currow = $(this).closest("tr");
    //   //   var emp_id = currow.find("td:eq(1)").text().trim(); // get employee ID

    //   //   // Open the pay slip in a new tab
    //   //   var url = "../plugins/TCPDF/User/pay_slip.php?salary_id=" + emp_id;
    //   //   window.open(url, "_blank");
    //   // });



    //   // $("#users2").on("click", "#modal_salary_edit", function(event) {
    //   //   event.preventDefault();

    //   //   var currow = $(this).closest("tr");

    //   //   // Get basic info from the table row
    //   //   var emp_id = currow.find("td:eq(2)").text();
    //   //   var salary_id = currow.find("td:eq(1)").text();
    //   //   var date_joining = currow.find("td:eq(1)").text();



    //   //   // Set basic info in modal
    //   //   $('#emp_id_edit_salary').val(emp_id);
    //   //   $('#emp_date_edit_salary').val(date_joining);

    //   //   $('#emp_salary_id_edit').val(salary_id);


    //   //   $.ajax({
    //   //     url: 'get_emp_salary_edit.php', // correct path
    //   //     method: 'POST',
    //   //     data: {
    //   //       salary_id: salary_id
    //   //     },
    //   //     dataType: 'json',
    //   //     success: function(response) {
    //   //       if (response.success) {
    //   //         $('#emp_fullname_edit_salary').val(response.data.fullname_salary);
    //   //         $('#emp_late_deduction_edit').val(response.data.emp_late_deduction);
    //   //       } else {
    //   //         console.error("Failed to fetch net pay:", response.message);
    //   //         $('#emp_fullname_edit_salary').val("N/A");
    //   //       }
    //   //       // Show modal after success
    //   //       $('#modal_salary_edit').modal('show');
    //   //       $('#modal_salary').modal('hide');
    //   //     },
    //   //     error: function(xhr, status, error) {
    //   //       console.error("AJAX error:", error);
    //   //       $('#netpay').val("N/A");
    //   //       $('#modal_salary_edit').modal('show'); // still show modal on error
    //   //     }
    //   //   });

    //   //   console.log("Clicked Emp ID:", emp_id);
    //   // });
    // });


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
        var salary_id = currow.find("td:eq(0)").text();
        var fullname = currow.find("td:eq(4)").text();
        $('#delete_payslip').modal('show');
        $('#salary_id').val(salary_id);
        $('#fullname').val(fullname);
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


  <script language="JavaScript">
    $('.select2').select2();














    // $('#entity1').change(function() {

    //     var entity_no7 = this.value;
    //     console.log(entity_no7);
    //     $.ajax({
    //         type: "POST",
    //         url: 'profile_entity.php',
    //         data: {
    //             entity_no7: entity_no7
    //         },
    //         error: function(xhr, b, c) {
    //             console.log(
    //                 "xhr=" +
    //                 xhr.responseText +
    //                 " b=" +
    //                 b.responseText +
    //                 " c=" +
    //                 c.responseText
    //             );
    //         },
    //         success: function(response) {
    //             var result = jQuery.parseJSON(response);
    //             console.log('response from server', result);

    //             $('#get_no').val(result.data1);


    //         },
    //     });


    // });
  </script>

  <script>
    $(document).ready(function() {

      // Function to recalc HMO total
      function recalcHmoTotal() {
        var quantity = parseFloat($('#emp_hrmo_quantity').val()) || 0;
        var rate = parseFloat($('#emp_hrmo_rate').val()) || 0;
        var total = quantity * rate;

        $('#emp_hrmo_total').val(total.toFixed(2));

        // Update overall total deduction
        recalcTotalDeduction();
      }

      // Function to sum all deductions
      function recalcTotalDeduction() {
        var hmo = parseFloat($('#emp_hrmo_total').val()) || 0;
        var absences = parseFloat($('#emp_total_absences').val()) || 0;
        var late = parseFloat($('#emp_total_late').val()) || 0;

        var totalDeduction = hmo + absences + late;

        $('#total_emp_deduction').val(totalDeduction.toFixed(2));
      }

      // Bind recalculation to HMO quantity or rate change
      $('#emp_hrmo_quantity, #emp_hrmo_rate').on('input', recalcHmoTotal);

      // Optionally, also recalc if absences or late are changed
      $('#emp_total_absences, #emp_total_late').on('input', recalcTotalDeduction);

    });
  </script>


</body>

</html>