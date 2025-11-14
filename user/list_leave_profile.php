<?php

include('../config/db_config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

    $get_emp_info_sql = "SELECT emp_id,fullname FROM tbl_employee_info where id = :id ";
    $get_emo_data = $con->prepare($get_emp_info_sql);
    $get_emo_data->execute([':id' => $user_id]);
    while ($result = $get_emo_data->fetch(PDO::FETCH_ASSOC)) {


        $emp_id_ = $result['emp_id'];
        $emp_fullname = $result['fullname'];
    }
}

$get_leave_sql = "SELECT * FROM tbl_types_leave";
$get_leave_data = $con->prepare($get_leave_sql);
$get_leave_data->execute();

$get_view_sql = "SELECT * FROM tbl_types_leave";
$get_view_data = $con->prepare($get_view_sql);
$get_view_data->execute();

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LIST LEAVE </title>
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

            <!-- Add New LEAVE Modal -->
            <div class="modal fade" id="add_leaveModal" tabindex="-1" aria-labelledby="v" aria-hidden="true">

                <div class="modal-dialog modal-dialog" style="max-width: 900px; width: 90%;">

                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="addPayrollModalLabel">Create Leave</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form or content goes here -->
                            <form method="post" enctype="multipart/form-data" action="insert_employee_leave.php">




                                <br>
                                <div class="row g-3">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="emp_id_leave" class="form-label">Emp ID:</label>
                                            <input readonly type="text" class="form-control" id="emp_id_leave" name="emp_id_leave" value="<?php echo $emp_id_; ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="emp_leave_balance" class="form-label">Sick Leave Credits</label>
                                            <input readonly type="text" class="form-control" id="emp_leave_balance" name="emp_leave_balance" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="vacation_credits" class="form-label">Vacation Leave Credits</label>
                                            <input readonly type="text" class="form-control" id="vacation_credits" name="vacation_credits" placeholder="">
                                        </div>
                                    </div>


                                </div>

                                <div class="row g-3">
                                    <div class="col-lg-12 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Name:</label>
                                            <input readonly type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $emp_fullname; ?>">
                                        </div>
                                    </div>




                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="get_leave">Select Type of Leave</label>
                                        <select class="form-control select2" id="get_leave" name="get_leave">
                                            <?php while ($get_leave = $get_leave_data->fetch(PDO::FETCH_ASSOC)) {
                                                $selected = ($get_user_leave == $get_leave['leave_code']) ? 'selected' : '';
                                            ?>
                                                <option <?= $selected; ?> value="<?= $get_leave['leave_code']; ?>">
                                                    <?= $get_leave['leave_code']; ?> -
                                                    <?= $get_leave['leave']; ?>
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
                                <div class="col-lg-12 col-md-4 col-sm-6">
                                    <div class="mb-3">
                                        <label for="leave_reason" class="form-label">Reason for Leave:</label>
                                        <input type="text" class="form-control" id="leave_reason" name="leave_reason" placeholder="">
                                    </div>
                                </div>

                                <label for="file">Choose a file or image:</label>
                                <input type="file" name="file" id="file" required>

                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" name="insert_employee_leave" class="btn btn-primary" value="Submit">
                        </div>


                    </div>

                    </form>
                </div>
            </div>
            <section class="content">
                <div class="card card-info">
                    <div class="card-header  text-white bg-dark">

                        <input hidden type="text" class="form-control" id="emp_id_balance" name="emp_id_balance" value="<?php echo $emp_id_; ?>">

                        <div class="card-header  text-white bg-dark">
                            <h4> List Leave

                                <a id="add_leaveModal_btn"
                                    type="button"
                                    class="btn btn-primary bg-gradient-success"
                                    style="float: right; border-radius: 0px;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#add_leaveModal">
                                    <i>Create Leave</i>
                                </a>

                            </h4>

                        </div>
                        </h4>

                    </div>



                    <!-- Add View Leave Modal -->
                    <div class="modal fade" id="modal_leave" tabindex="-1" aria-labelledby="v" aria-hidden="true">

                        <div class="modal-dialog modal-dialog" style="max-width: 900px; width: 90%;">

                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="addPayrollModalLabel">View Leave</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Your form or content goes here -->
                                    <form method="post" enctype="multipart/form-data" action="insert_employee_leave.php">




                                        <br>
                                        <div class="row g-3">
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="emp_id_view" class="form-label">Emp ID:</label>
                                                    <input readonly type="text" class="form-control" id="emp_id_view" name="emp_id_view" value="<?php echo $emp_id_; ?>">
                                                </div>
                                            </div>



                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="leave_creadits_view" class="form-label">Leave Credits</label>
                                                    <input readonly type="text" class="form-control" id="leave_creadits_view" name="leave_creadits_view" placeholder="">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row g-3">
                                            <div class="col-lg-12 col-md-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="fullname_view" class="form-label">Name:</label>
                                                    <input readonly type="text" class="form-control" id="fullname_view" name="fullname_view" value="<?php echo $emp_fullname; ?>">
                                                </div>
                                            </div>




                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="leave_code_view">Select Type of Leave</label>
                                                <select class="form-control select2 leave_code_view"
                                                    id="leave_code_view"
                                                    name="leave_code_view">
                                                    <?php
                                                    while ($get_leave = $get_view_data->fetch(PDO::FETCH_ASSOC)) {
                                                        $selected = ($get_user_leave == $get_leave['leave_code']) ? 'selected' : '';
                                                    ?>
                                                        <option value="Vacation Leave">VL - Vacation Leave</option>
                                                        <option value="Sick Leave">SL - Sick Leave</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="date_from_view">Date from:</label>
                                                <input type="date" name="date_from_view" id="date_from_view" class="form-control" required>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="date_to_view">Date to:</label>
                                                <input type="date" name="date_to_view" id="date_to_view" class="form-control" required>
                                            </div>
                                        </div>


                                        <br>
                                        <div class="col-lg-12 col-md-4 col-sm-6">
                                            <div class="mb-3">
                                                <label for="leave_reason" class="form-label">Reason for Leave:</label>
                                                <input type="text" class="form-control" id="leave_reason" name="leave_reason" placeholder="">
                                            </div>
                                        </div>

                                        <label for="file">Choose a file or image:</label>
                                        <input type="file" name="file" id="file" required>

                                </div>

                                <!-- Modal Footer -->
                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <input type="submit" name="insert_employee_leave" class="btn btn-primary" value="Submit">
                                </div> -->


                            </div>

                            </form>
                        </div>
                    </div>



                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="get" action="">
                                <div class="box-body">

                                    <div class="table-responsive">

                                        <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                                            <thead align="center">
                                                <th> ID </th>
                                                <th> EMP_ID </th>
                                                <th> DATE CREATE </th>
                                                <th> FULLNAME </th>
                                                <th> LEAVE </th>
                                                <th> DATE FROM </th>
                                                <th> DATE TO </th>
                                                <th> LEAVE REASON </th>
                                                <th> ATTACHED </th>
                                                <th> STATUS </th>

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
                url: "search_emp_leave.php",
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
    `
            }]

    //   <div class="dropdown">
    //     <button 
    //       class="btn btn-sm btn-primary dropdown-toggle" 
    //       type="button" 
    //       data-bs-toggle="dropdown" 
    //       aria-expanded="false">
    //       Actions
    //     </button>
    //     <ul class="dropdown-menu">
      
    //         <li>
    //     <a class="dropdown-item" id="modal_leave" href="#" title="View Leave" data-bs-toggle="modal" data-bs-target="#addSalaryModal">
    //        <i class="fa fa-folder"></i> View Leave
    //       </a>
    //       </li>
    //     </ul>
    //   </div>
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


        $("#users tbody").on("click", "#modal_leave", function() {
            event.preventDefault();
            var currow = $(this).closest("tr");

            var emp_id = currow.find("td:eq(1)").text();
            var date_create = currow.find("td:eq(2)").text();
            var fullname = currow.find("td:eq(3)").text();
            var leave_code = currow.find("td:eq(4)").text();
            var date_from = currow.find("td:eq(5)").text();
            var date_to = currow.find("td:eq(6)").text();



            console.log("test");
            $('#modal_leave').modal('show');
            $('#emp_id_view').val(emp_id);
            $('#date_create_view').val(date_create);
            $('#fullname_view').val(fullname);
            $('#leave_code_view').val(leave_code).trigger('change.select2');
            $('#date_from_view').val(date_from);
            $('#date_to_view').val(date_to);



            $.ajax({
                url: 'get_emp_leavecredits.php', // your PHP script
                type: 'POST',
                dataType: 'json',
                data: {
                    emp_id_leave: emp_id
                },
                success: function(response) {
                    if (response.success) {
                        // Use leave_balance from response.data
                        var leaveBalance = response.data.leave_balance;
                        $('#emp_leave_balance').val(leaveBalance);
                    } else {
                        alert(response.message);
                        $('#emp_leave_balance').val('0');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    $('#emp_leave_balance').val('0'); // set 0 on error
                }
            });

        });



        $(document).ready(function() {

            // Use a proper click handler
            $(document).on("click", "#add_leaveModal_btn", function(event) {
                event.preventDefault();

                var currow = $(this).closest("tr");
                var emp_id = $('#emp_id_balance').val();

                console.log("test");

                // Show modal
                $('#add_leaveModal').modal('show');
                $('#emp_id_leave').val(emp_id);

                // AJAX request
                $.ajax({
                    url: 'get_emp_leavecredits.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        emp_id_leave: emp_id
                    },
                    success: function(response) {
                        if (response.success) {
                            var leaveBalance = response.data.leave_balance;
                            $('#emp_leave_balance').val(leaveBalance);
                        } else {
                            alert(response.message);
                            $('#emp_leave_balance').val('0');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $('#emp_leave_balance').val('0');
                    }
                });


                    $.ajax({
                    url: 'get_emp_vacationcredits.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        emp_id_leave: emp_id
                    },
                    success: function(response) {
                        if (response.success) {
                            var vacationBalance = response.data.vacation_balance;
                            $('#vacation_credits').val(vacationBalance);
                        } else {
                            alert(response.message);
                            $('#vacation_credits').val('0');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $('#vacation_credits').val('0');
                    }
                });
            });

        });
    </script>
</body>

</html>