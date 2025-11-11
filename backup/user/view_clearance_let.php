<?php


include('../config/db_config.php');
include('../config/db_vamos.php');
// include('insert_vaccine.php');
include('../config/db_let.php');
session_start();

include('update_violation.php');
// date_default_timezone_set('Asia/Manila');
// 
// date_default_timezone_set("America/New_York");
// echo "The time is " . date("h:i:sa");
$now = new DateTime();
// $time = date('H:i');

// $time = date("h:i:sa");


$get_control_no = $get_entity_no = $get_firstname =  $get_middlename =   $get_lastname  = $get_suffix = ' ';



$btnSave = $btnEdit = '';
$btnNew = 'hidden';
$btn_enabled = 'enabled';
$img = '';
$entity_no = ' ';
$etracs_id = ' ';

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
$user_id = $_SESSION['id'];





if (isset($_GET['entity_no'])) {

    $entity_no = $_GET['entity_no'];
    $get_barangaydata_sql = "SELECT * FROM print_clearance

    WHERE person_entityno = :entity_no";
    $barangay_data = $con->prepare($get_barangaydata_sql);
    $barangay_data->execute([':entity_no' => $entity_no]);
    while ($result = $barangay_data->fetch(PDO::FETCH_ASSOC)) {

        $get_entity_no   = $result['person_entityno'];
        $get_ctcdate   = $result['ctcissuedon'];
        $get_ctcno   = $result['ctcno'];
        $get_ctcamountpaid   = $result['ctcamountpaid'];
        $get_ctcissuedat   = $result['ctcissuedat'];
        $get_ordate   = $result['orissuedon'];
        $get_orno   = $result['orno'];
        $get_ormountpaid   = $result['oramountpaid'];
        $get_orissuedat   = $result['orissuedat'];
        $get_purpose   = $result['purpose'];
    }
}



if (isset($_GET['entity_no'])) {

    $person_entityno = $_GET['entity_no'];
    $get_barangaydata_sql = "SELECT * FROM get_individual

    WHERE entity_no = :entity_no";
    $barangay_data = $con->prepare($get_barangaydata_sql);
    $barangay_data->execute([':entity_no' => $person_entityno]);
    while ($result = $barangay_data->fetch(PDO::FETCH_ASSOC)) {

        $get_firstname   = $result['firstname'];
        $get_middlename   = $result['middlename'];
        $get_lastname   = $result['lastname'];
        $get_suffix   = $result['suffix1'];
        $get_photo   = $result['photo'];
    }
}

if (isset($_GET['etracs_id'])) {

    $etracs_id = $_GET['etracs_id'];
    $get_let_violation = "SELECT * FROM let_violatorsetracs 

    WHERE person_id = :etracs_id";
    $let_data = $con_let->prepare($get_let_violation);
    $let_data->execute([':etracs_id' => $etracs_id]);
    while ($result = $let_data->fetch(PDO::FETCH_ASSOC)) {

        $etracs_id   = $result['person_id'];
        $person_name   = $result['person_name'];
    }
}

if (isset($_GET['entity_no'])) {

    $person_entityno = $_GET['entity_no'];
    $get_status_sql = "SELECT * FROM tbl_entity

    WHERE entity_no = :entity_no";
    $status_data = $con2->prepare($get_status_sql);
    $status_data->execute([':entity_no' => $person_entityno]);
    while ($result = $status_data->fetch(PDO::FETCH_ASSOC)) {
        $get_status   = $result['status'];
    }
}




if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $get_barangaydata_sql = "SELECT * FROM scc_barangay.barangay_clearance r inner join
                             sccdrrmo.tbl_individual t on t.entity_no = r.person_entityno inner join
                             sccdrrmo.tbl_entity h on h.entity_no = t.entity_no

    WHERE id = :entity_no";
    $barangay_data = $con->prepare($get_barangaydata_sql);
    $barangay_data->execute([':entity_no' => $id]);
    while ($result = $barangay_data->fetch(PDO::FETCH_ASSOC)) {

        $get_entity_no   = $result['person_entityno'];
        $get_ctcdate   = $result['ctcissuedon'];
        $get_ctcno   = $result['ctcno'];
        $get_ctcamountpaid   = $result['ctcamountpaid'];
        $get_ctcissuedat   = $result['ctcissuedat'];
        $get_ordate   = $result['orissuedon'];
        $get_orno   = $result['orno'];
        $get_ormountpaid   = $result['oramountpaid'];
        $get_orissuedat   = $result['orissuedat'];
        $get_purpose   = $result['purpose'];


        $get_firstname   = $result['firstname'];
        $get_middlename   = $result['middlename'];
        $get_lastname   = $result['lastname'];
        $get_photo   = $result['photo'];

        $get_status   = $result['status'];
    }
}


$get_all_civilstatus_sql = "SELECT * FROM barangay_civilstatus";
$get_all_civilstatus_data = $con->prepare($get_all_civilstatus_sql);
$get_all_civilstatus_data->execute();

$get_all_purpose_sql = "SELECT * FROM barangay_purpose";
$get_all_purpose_data = $con->prepare($get_all_purpose_sql);
$get_all_purpose_data->execute();



$get_all_punongbarangay_sql = "SELECT * FROM barangay_punongbarangay";
$get_all_punongbarangay_data = $con->prepare($get_all_punongbarangay_sql);
$get_all_punongbarangay_data->execute();
while ($get_punong = $get_all_punongbarangay_data->fetch(PDO::FETCH_ASSOC)) {
    $get_name = $get_punong['name'];
    $get_position = $get_punong['position'];
}


$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';
$nationality = ' FILIPINO';
$region = 'WESTERN VISAYAS';
$lgu = 'SAN CARLOS CITY';


$title = 'BARANGAY CLEARANCE | CLEARANCE Form';


?>


<!DOCTYPE html>
<html>

<head>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
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
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <script src="https://kit.fontawesome.com/629c6e6cbc.js" crossorigin="anonymous"></script>

    <?php include('style.php'); ?>

</head>
<style>
    label {

        font-size: 16px;
        color: black;

    }

    .fas,
    .icons,
    #icons {
        color: black;
    }




    p {
        color: black;
    }

    .sidebar-link:hover,
    #lightgreen:hover {

        background-color: lightgreen;
    }


    /* .top-link{

  } */
    .top-link:hover {
        background-color: green;
        color: black;
    }

    #label1::after {
        content: '';
        display: block;
        position: absolute;

        background-color: black;
        width: 200px;
        height: 1px;


        /* bottom: -3px; */
    }

    #label2::after {
        content: '';
        display: block;
        position: absolute;

        background-color: black;
        width: 200px;
        height: 1px;


        /* bottom: -3px; */
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">




            <!-- Main content -->
            <section class="content">

                <!-- <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="insert_vaccine.php"> -->
                <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="update_violation.php">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-white bg-dark">
                                    <h5>LET Profile</h5>
                                </div>
                                <div class="card-body">



                                    <div class="card">

                                        <div class="card-body">
                                            <div class="row">


                                                <div class="col-sm-5">
                                                    <label>Etracs ID : &nbsp;&nbsp; <span id="required">*</span></label>
                                                    <input type="text" readonly class="form-control ent_no" id="etracs_id" name="etracs_id" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="Entity Number" value="<?php echo $etracs_id; ?>">
                                                </div>

                                            </div><br>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label>Violators Name: &nbsp;&nbsp; <span id="required">*</span> </label>
                                                    <input readonly type="text" class="form-control" id="firstname" name="firstname" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" placeholder="First name" value="<?php echo $person_name; ?>">
                                                </div>



                                            </div><br>


                                        </div>

                                        <div class="card-body">
                                            <div class="box box-primary">
                                                <form role="form" method="get" action="">
                                                    <div class="box-body">
                                                    <h4>List of Violations</h4>
                                                        <div class="table-responsive">
                 


                                                            <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                                                                <thead align="center">

                                                                    <th> Date Citation </th>

                                                                    <th> Citation Number </th>
                                                                    <th> Enforcer Name </th>


                                                                    <th> Description</th>
                                                                    <th> Cleared</th>
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

                                    <!-- Modal -->

                                    <div id="myModal" class="modal fade" role="dialog">

                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                                                    <div class="modal-header">

                                                        <h4 class="modal-title">Let Violation</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">


                                                        <br>
                                                        <div class="col-sm-12">

                                                            <label>CITATION NO. : </label>
                                                            <input readonly type="text" class="form-control " id="citation_number1" onkeyup="this.value = this.value.toUpperCase();" style=" text-transform: uppercase;" name="let_violation" p value="">

                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" name="update_violation">Clear</button>
                                                    </div>
                                                    <!-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div> -->
                                                </form>
                                            </div>

                                        </div>
                                    </div>






                                </div>






                            </div>

                        </div>



                        <!-- 
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header text-white bg-dark">
                                    <h5>Photo</h5>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-1"></div>

                                        <div>

                                            <video id="webcam" autoplay playsinline width="250" height="250" align="center" hidden class="photo  img-thumbnail"></video>
                                            <canvas id="canvas" class="d-none" hidden width="250" height="250" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>
                                            <audio id="snapSound" src="audio/snap.wav" preload="auto"></audio>

                                            <img src="/sccdrrmo/flutter/images/<?php echo $get_photo ?>" style="height: 300px; width:300px;margin:auto;" class="photo img-thumbnail">

                                        </div>
                                    </div><br>









                                    <hr>



                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div>
                                            <strong><i class="fa fa-id-card mr-1"></i> Account Status <span id="required">*</span></strong>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div>
                                            <input id="status" style="font-size:15px; width:90%;" class="form-control" readonly placeholder="Account Status" value="<?php echo $get_status; ?>">
                                            <br>
                                            <a href="javascript:;" onclick="this.href='/barangay/admin/view_individual.php?entity_no=' + document.getElementById('entity_no7').value">
                                                <input type="button" name="view_individual" class="btn btn-primary" value="OPEN PROFILE">
                                            </a>
                                            &nbsp;
                                            <a href="../admin/new_map.php?entity_no=<?php echo $entity_no; ?>" target="blank">
                                                <input type="button" name="new_map" class="btn btn-primary" value="VIEW MAP">
                                            </a>

                                        </div>




                                    </div>


                                </div>
                            </div>
                        </div> -->




                    </div>
                </form>









            </section>
            <br><br>
        </div>
        <?php include('footer.php'); ?>
    </div>

    <?php include('pluginscript.php') ?>


  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- datepicker -->
  <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <!-- DataTables Bootstrap -->
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>

  <script src="../plugins/sweetalert/sweetalert.min.js"></script>


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
        var dataTable = $('#users').DataTable({

            page: true,
            stateSave: true,
            processing: true,
            serverSide: true,
            scrollX: false,
            ajax: {
                url: "search_violations.php",
                type: "post",
                data:{
                    etracs_id : '<?php echo $_GET['etracs_id']; ?>'
                },
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
                    width: "159px",
                    targets: -1,
                    data: null,

                    defaultContent: ''
                },
                //   defaultContent: '<button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "viewIndividual" data-placement="top" title="Edit Individual"> <i class="fa fa-edit"></i></button>' +
                //     '<a class="btn btn-outline-success btn-sm printlink"  style = "margin-right:10px;" id="printlink" href ="../plugins/jasperreport/entity_id.php?entity_no=" data-placement="top" target="_blank" title="Print ID">  <i class="nav-icon fa fa-print"></i></a> ' + checkViewHistory() + checkDelete() +

                //     '<button class="btn btn-outline-success btn-sm editIndividual" style = "margin-right:10px;"  id = "modal" data-placement="top" title="ADD"> <i class="fa fa-edit"></i></button>',
                // },

            ],
        });
    </script>

    <script>
        function getAge() {
            var dob = document.getElementById('birthdate').value;
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('age').value = age;
            // alert('hello');
        };
    </script>

    <script>
        $('#myModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes

            var citation = button.data('id')
            // Update the modal's content
            // modal.find('.modal-title').text('Modal Title ' + id)
            // modal.find('.modal-body p').text('Modal body text for ' + id + ' goes here.')

            console.log("test");
            // $('#modalupdate').modal('show');
            $('#citation_number1').val(citation);
            // $('#fullname1').val(fullname);
        })
    </script>

    <!-- <script>
        $(document).ready(function() {
            $("#modal-button").on("click", function() {
                var fieldData = $("#fullname1").val();
                $("#fullname1").text(fieldData);
            });
        });
    </script> -->

    <!-- <script>
     $('#birthdate').change(function getAge() {
            var dob = document.getElementById('birthdate').value;
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('age').value = age;
            // alert('hello');
        });
    </script> -->

    <!-- <script>
    function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

</script> -->

    <script language="JavaScript">
        $('.select2').select2();

        $(function() {


            $("#entity1").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "vamos_id", // json datasource
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },

                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
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
                }
            });

            $('#entity1').on('change', function() {
                var entity_no = this.value;
                console.log(entity_no);
                $.ajax({
                    type: "POST",
                    url: 'profile_member.php',
                    data: {
                        entity_no: entity_no
                    },
                    error: function(xhr, b, c) {
                        console.log(
                            "xhr=" +
                            xhr.responseText +
                            " b=" +
                            b.responseText +
                            " c=" +
                            c.responseText
                        );
                    },
                    success: function(response) {
                        var result = jQuery.parseJSON(response);
                        console.log('response from server', result);
                        $('#entity_no7').val(result.data);
                        console.log($('#entity_no7').val(result.data));
                        $('#fullname').val(result.data1);
                        $('#firstname').val(result.data2);
                        $('#middlename').val(result.data3);
                        $('#lastname').val(result.data4);
                        $('#birthdate').val(result.data5);
                        $('#province').val(result.data6);
                        $('#street1').val(result.data7);
                        $('#barangay1').val(result.data8);


                        $('#ages').val(result.data9);
                        $('#gender').val(result.data10);
                        $('#city').val(result.data11);
                        $('#mobile_no').val(result.data12);

                        $('#tphoto1').attr("src", "/barangay/photo/" + result.data13);

                        $('#status').val(result.data15);




                    },


                });


            });



        });


    </script>




</body>

</html>