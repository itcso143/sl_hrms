<?php
session_start();


$now = new DateTime();

$emp_id_new = $get_user_type = $date_register = $user_name = $get_password = $firstname = $middlename = $lastname = $suffix = $birthdate = $age = $gender = $barangay = $civilstatus = $street = $city = $province = $mobile_no = $telephone_no = $email = '';

$btnSave = $btnEdit = "";
$btnNew = 'hidden';
$btn_enabled = 'enabled';


if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');




$get_all_civilstatus_sql = "SELECT * FROM civil_status";
$get_all_civilstatus_data = $con->prepare($get_all_civilstatus_sql);
$get_all_civilstatus_data->execute();

$get_all_usertype_sql = "SELECT * FROM user_type";
$get_all_usertype_data = $con->prepare($get_all_usertype_sql);
$get_all_usertype_data->execute();

$get_gender_sql = "SELECT * FROM tbl_gender";
$get_gender_data = $con->prepare($get_gender_sql);
$get_gender_data->execute();
// $province = 'NEGROS OCCIDENTAL ';
// $city = 'SAN CARLOS CITY';

$emp_id = $_GET['emp_id'];
$get_user_sql = " SELECT username,emp_id,user_type FROM tbl_users where emp_id = :emp_id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':emp_id' => $emp_id]);
while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $emp_id = $result4['emp_id'];
    $user_name = strtoupper($result4['username']);
    // $get_user_type = $result4['user_type'];
    // $get_password = $result4['pass'];

}

$get_user_sql = " SELECT *  FROM tbl_employee_info where emp_id = :emp_id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':emp_id' => $emp_id]);
while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $emp_id_employee = $result4['emp_id'];
    $firstname = strtoupper($result4['firstname']);
    $middlename = strtoupper($result4['middlename']);
    $lastname = strtoupper($result4['lastname']);
    $suffix = strtoupper($result4['suffix']);
    $firstname = strtoupper($result4['firstname']);
    $birthdate = $result4['birthdate'];
    $gender = $result4['gender'];
    $civilstatus = $result4['civilstatus'];
    $address = strtoupper($result4['address']);
    $barangay = strtoupper($result4['barangay']);
    $city = strtoupper($result4['city']);
    $province = strtoupper($result4['province']);
    $country = strtoupper($result4['country']);
    $nationality = strtoupper($result4['nationality']);
    $email_address = strtoupper($result4['email_address']);
    $mobile_no = strtoupper($result4['mobile_no']);
    $telephone_no = strtoupper($result4['telephone_no']);

    $identification = strtoupper($result4['identification']);
    $identification_no = strtoupper($result4['identification_no']);

    $employee_type = strtoupper($result4['employee_type']);
    $department = strtoupper($result4['department']);
    $designation = strtoupper($result4['designation']);

    $date_joining = $result4['date_joining'];
    $blood_type = strtoupper($result4['blood_type']);

    $get_photo = $result4['photo'];

    $bank_name = strtoupper($result4['bank_name']);
    $bank_no = $result4['bank_no'];
    $ifsc_code = $result4['ifsc_code'];

    $tin_no = $result4['tin_no'];
    $sss = $result4['sss'];
    $philhealth = $result4['philhealth'];
    $pag_ibig = $result4['pag_ibig'];

    $emergency_name = strtoupper($result4['emergency_name']);
    $emergency_relationship = strtoupper($result4['emergency_relationship']);
    $emergency_contact_no = $result4['emergency_contact_no'];
}


$title = 'Add Employee';


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


    <style>
        #webcam {
            width: 350px;
            height: 350px;
            border: 1px solid black;
        }

        #photo {
            display: block;
            position: relative;
            margin-top: 40px;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">



            <section class="content">
                <div class="card">
                    <div class="card-header text-white bg-dark">
                        <h4>Profile</h4>
                    </div>


                    <div class="card-body">

                        <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="update_employee_user.php">

                            <div class="box-body">
                                <div class="row">

                                    <div class="m-1 pb-1"> </div>
                                    <div class="card col-md-6">

                                        <div class=" card-header">
                                            <h6><strong>GENERAL INFORMATION</strong></h6>
                                        </div>

                                        <div class="box-body">
                                            <br>

                                            <div class="row">

                                                <div class="col-md-1"></div>
                                                <div class="col-lg-4">
                                                    <label>Date Registered: </label>
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-1"></div>
                                                <div class="col-sm-5">
                                                    <label>Employee ID: </label>
                                                    <input type="text" class="form-control" name="emp_id_new" id="emp_id_new" placeholder="EMP ID" value="<?php echo $emp_id_employee; ?>">
                                                </div>


                                            </div></br>
                                        
                                            <br>


                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>First Name:</label> -->
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="<?php echo $user_name; ?>">
                                                    <span>Username</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>First Name:</label> -->
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
                                                    <span>Password</span>
                                                </div>
                                            </div></br>



                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>First Name:</label> -->
                                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>">
                                                <span>Firstname</span>
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Middle Name:</label> -->
                                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" value="<?php echo $middlename; ?>">
                                                 <span>Middlename</span>
                                                </div>
                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label> Last Name:</label> -->
                                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>">
                                                <span>Lastname</span>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label> Last Name:</label> -->
                                                    <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Suffix" value="<?php echo $suffix; ?>">
                                                <span>Suffix</span>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-4">
                                                    <label>Birthdate:</label>
                                                    <input
                                                        type="date"
                                                        id="birthdate"
                                                        name="birthdate"
                                                        class="form-control pull-right"
                                                        value="<?php echo $birthdate; ?>" />
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Gender</label>
                                                    <select class="form-control select2" id="gender" name="gender">
                                                        <?php while ($get_gender = $get_gender_data->fetch(PDO::FETCH_ASSOC)) {
                                                            $selected = ($gender == $get_gender['gender']) ? 'selected' : '';
                                                        ?>
                                                            <option <?= $selected; ?> value="<?php echo $get_gender['gender']; ?>">
                                                                <?php echo $get_gender['gender']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>



                                                <div class="col-md-4">
                                                    <label for="civilstatus">Civil Status:</label>
                                                    <select class="form-control select2" id="civilstatus" name="civilstatus" style="width: 100%;">
                                                        <option value="" disabled <?= empty($civilstatus) ? 'selected' : ''; ?>>Select Civil Status</option>
                                                        <?php while ($get_civilstatus = $get_all_civilstatus_data->fetch(PDO::FETCH_ASSOC)) {
                                                            $selected = ($civilstatus == $get_civilstatus['civilstatus']) ? 'selected' : '';
                                                        ?>
                                                            <option <?= $selected; ?> value="<?php echo $get_civilstatus['civilstatus']; ?>">
                                                                <?php echo $get_civilstatus['civilstatus']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <br>


                                            <!-- <div class="row">

                                                <div class="col-md-1"></div>
                                                <div class="col-md-3">
                                                    Put birthdate:
                                                    Your age:

                                                </div>

                                            </div><br> -->

                                            <br>


                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="address" placeholder="Street / Lot # / Block #" value="<?php echo $address; ?>">
                                                 <span>Address</span>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="barangay" placeholder="Barangay" value="<?php echo $barangay; ?>">
                                               <span>Barangay</span>
                                                </div>
                                            </div><br>



                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo $city; ?>">
                                               <span>City</span>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="province" placeholder="Province" value="<?php echo $province; ?>">
                                               <span>Province</span>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="country" placeholder="Country" value="<?php echo $country; ?>">
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="nationality" placeholder="Nationality" value="<?php echo $nationality; ?>">
                                                <span>Nationality</span>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="email_address" placeholder="Email Address" value="<?php echo $email_address; ?>">
                                                <span>Email Address</span>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="mobile_no" placeholder="Mobile_no" value="<?php echo $mobile_no; ?>">
                                               <span>Mobile no.</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="telephone_no" placeholder="Telephone_no" value="<?php echo $telephone_no; ?>">
                                                <span>Tel No.</span>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="identification" placeholder="Identification Card" value="<?php echo $identification; ?>">
                                               <span>Identification Card</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="identification_no" placeholder="Identification Number" value="<?php echo $identification_no; ?>">
                                               <span>Identification No.</span>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="employee_type" placeholder="Employee Type" value="<?php echo $employee_type; ?>">
                                                <span>Employee Type</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="department" placeholder="Department" value="<?php echo $department; ?>">
                                                <span>Department</span>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="designation" placeholder="Designation" value="<?php echo $designation; ?>">
                                                 <span>Designation</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input
                                                        type="date"
                                                        id="date_joining"
                                                        name="date_joining"
                                                        class="form-control pull-right"
                                                        value="<?php echo $date_joining; ?>">
                                                    <span>Date Joining</span>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="blood_type" placeholder="Blood Type" value="<?php echo $blood_type; ?>">
                                                <span>Blood Type</span>
                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="<?php echo $bank_name; ?>">
                                               <span>Bank Name</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="bank_no" placeholder="Bank Number" value="<?php echo $bank_no; ?>">
                                               <span>Bank No.</span>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="ifsc_code" placeholder="IFSC CODE" value="<?php echo $ifsc_code; ?>">
                                                <span>Ifsc Code</span>
                                                </div>

                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="tin_no" placeholder="TIN Number" value="<?php echo $tin_no; ?>">
                                                <span>TIN No.</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="sss" placeholder="SSS Number" value="<?php echo $sss; ?>">
                                                <span>SSS No.</span>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="philhealth" placeholder="Philhealth Number" value="<?php echo $philhealth; ?>">
                                                <span>Philhealth No.</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="pag_ibig" placeholder="Pag-ibig Number" value="<?php echo $pag_ibig; ?>">
                                                 <span>Pag-ibig No.</span>
                                                </div>
                                            </div><br>
                                            <br>
                                            <div>

                                                <h5 class="text-center">EMERGENCY CONTACT</h5>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="emergency_name" placeholder="Name" value="<?php echo $emergency_name; ?>">
                                                <span>Emergency Name</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="emergency_relationship" placeholder="Relationship" value="<?php echo $emergency_relationship; ?>">
                                                <span>Emergency Relation</span>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" class="form-control" name="emergency_contact_no" placeholder="Contact Number" value="<?php echo $emergency_contact_no; ?>">
                                               <span>Emergency Contact No.</span>
                                                </div>

                                            </div><br>

                                        </div>


                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <div class="card col-md-5">
                                        <div class="card-header">
                                            <h6><strong> ID PHOTO </strong></h6>
                                        </div>

                                        <div class="box-body">
                                            <br>
                                            <div class="row col-12">

                                                <!-- <div class="col-12" style="vertical-align: middle; height: 280px; width:300px;border: 1px solid black ;" id="my_camera" align="center" onClick="setup()">
                                                <img src="" id = "photo" style="margin:auto;height: 200px; width:280;"onClick="setup()">
                                                        Click me to Open Camera
                                                
                                                  
                                                </div> -->
                                                <div style="margin:auto">

                                                    <video id="webcam" autoplay playsinline width="450 " height="450" align="center" hidden class="photo  img-thumbnail"></video>
                                                    <canvas id="canvas" class="d-none" hidden width="450" height="450" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>
                                                    <audio id="snapSound" src="audio/snap.wav" preload="auto"></audio>

                                                    <img src="/sl_hrms/photo/<?php echo $get_photo ?>" id="photo" name="photo" value = "<?php $get_photo;?>"style="height: 250px; width:250px; margin:auto;" class="photo img-thumbnail">
                                                    <input type="hidden" class="form-control" name="deletephoto" placeholder="Email Address" value="<?php echo $get_photo; ?>">
                                                    
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row col-12" align="center">
                                            <!-- <form method="POST" action="storeImage.php"> -->
                                            <div style="margin:auto">
                                                <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                    <span class="align-baseline">
                                                        <input hidden name="image" class="image-tag">
                                                        <!-- <input type="button" class="btn btn-primary" value="&#9654" onClick="setup()">  -->
                                                        <!-- <button type="button" id="opencamera" class="btn btn-warning " value="CAPTURE"><i class="fa fa-camera"></i></button>
                                                        <button type="button" id="capture" class="btn btn-primary toastsDefaultSuccess" value="CAPTURE" onClick="take_snapshot()"><i class="fa fa-check"></i></button> -->

                                                        <style>
                                                            input[type="file"] {
                                                                display: none;
                                                            }

                                                            .custom-file-upload {
                                                                border: 1px solid #ccc;
                                                                border-radius: 5px;
                                                                display: inline-block;
                                                                padding: 7px 12px;
                                                                cursor: pointer;
                                                            }
                                                        </style>
                                                        <label for="fileToUpload" class="custom-file-upload">
                                                            <i class="fa fa-cloud-upload"></i> Import Image
                                                        </label>
                                                        <input type="file" id="fileToUpload" name="myFile" class="btn btn-danger custom-file-upload ">

                                                    </span>
                                                </div>
                                            </div><br>
                                            <!-- </form> -->

                                        </div>





                                        <div class="box-footer" align="center">


                                            <button type="submit" <?php echo $btnSave; ?> name="update_employee_user" id="btnSubmit" class="btn btn-success">
                                                <i>Update </i> </button>

                                            <a href="list_individual.php">
                                                <button type="button" name="cancel" class="btn btn-danger">
                                                    <i> Cancel</i> </button>
                                            </a>

                                            <!-- <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $emp_id; ?>">
                                                <button type="button" name="print" class="btn btn-primary">
                                                    <i class="nav-icon fa fa-print"> </i> </button>
                                            </a> -->


                                        </div><br>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </section>
            <br>

        </div>




    </div>


    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- CK Editor -->
    <script src="../plugins/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <!-- <script src="../plugins/fastclick/fastclick.js"></script> -->
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="../dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- DataTables -->
    <!-- <script src="../plugins/datatables/jquery.dataTables.js"></script> -->
    <script src="../plugins/pixelarity/pixelarity-face.js"></script>
    <!-- <script src="../plugins/pixelarity/pixelarity-faceless.js"></script>
    <script src="../plugins/pixelarity/script-faceless.js"></script> -->
    <!-- <script src="../plugins/pixelarity/jquery.3.4.1.min.js"></script> -->
    <!-- <script src="../plugins/datatables/dataTables.bootstrap4.js"></script> -->
    <!-- Toastr -->
    <!-- <script src="../plugins/toastr/toastr.min.js"></script> -->
    <!-- Select2 -->
    <!-- <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script> -->
    <script src="../plugins/cameracapture/webcam-easy.min.js"></script>
    <!-- <script src="../plugins/webcamjs/webcam.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
    <!-- textarea wysihtml style -->
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
    <!-- <script src="jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     -->

    <!-- <script src="jpeg_camera/dist/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->

    <script src="../plugins/select2/select2.full.min.js"></script>

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

    <script language="JavaScript">
        $('.select2').select2();

        function getAge() {
            var dob = document.getElementById('date').value;
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('age').value = age;
        };

        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);

        function take_snapshot() {
            // // take snapshot and get image data

            let picture = webcam.snap();
            document.querySelector('#photo').src = picture;
            $(".image-tag").val(picture);
            $("#canvas").attr("hidden", true);
            webcam.stop();
            $("#canvas").hide();
            $("#webcam").hide();
            $("#photo").show();

        }


        function checkUsername() {
            var username = $('#username').val();
            if (username.length >= 3) {
                $("#status").html('<img src="loader.gif" /> Checking availability...');
                $.ajax({
                    type: 'POST',
                    data: {
                        username: username
                    },
                    url: 'check_username.php',
                    success: function(data) {
                        $("#status").html(data);

                    }
                });
            }
        }


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
                        $('#entity_no').val(result.data);
                        $('#fullname').val(result.data1);
                        $('#firstname').val(result.data2);
                        $('#middlename').val(result.data3);
                        $('#lastname').val(result.data4);
                        $('#birthdate').val(result.data5);
                        $('#street').val(result.data7);
                        $('#barangay').val(result.data8);
                        var brgy = result.data8.toUpperCase();




                        $('#ages').val(result.data9);
                        $('#email-add').val(result.data14);
                        $('#acct-stat').val(result.data15);


                        var gender = result.data10;

                        if (gender == 'Female') {
                            $("#gender").select2("val", "01_Female");
                            $('#preg_status').select2("val", "Select pregnancy status...")
                        } else if (gender == 'Male') {
                            $("#gender").select2("val", "02_Male");
                            $('#preg_status').select2("val", "02_Not_Pregnant")
                        }

                        $('#contact_no').val(result.data12);
                        $('#tphoto').attr("src", "../flutter/images/" + result.data13);
                    },
                });

            });


        });

        $(document).ready(function() {

            // $('#entity_no').val(sessionStorage.getItem("entity_number"));

            //execute the image cropper when the image is imported
            $("#fileToUpload").change(function(e) {

                var img = e.target.files[0];

                if (!pixelarity.open(img, false, function(res) {

                        $("#photo").attr("src", res);
                        $(".image-tag").attr("value", res);
                    }, "jpg", 0.7)) {

                    alert("Whoops! That is not an image!");
                }

                $("#photo").show();
                $("#canvas").hide();
                $("#webcam").hide();

            });
            //open the webcam
            $("#opencamera").click(function() {
                $("#canvas").show();
                $("#webcam").show();
                $('#canvas').removeAttr('hidden');
                $('#webcam').removeAttr('hidden');
                $("#photo").hide();
                webcam.start()
                    .then(result => {
                        console.log("webcam started");
                    })
                    .catch(err => {
                        console.log(err);
                    })
            });

            $('#username').change(function() {
                if ($('#objid').val() == '') {
                    $.ajax({
                        type: 'POST',
                        data: {},
                        url: 'generate_id.php',
                        success: function(data) {
                            //$('#entity_no').val(data);
                            document.getElementById("objid").value = data;
                            console.log(data);
                        }
                    });
                }
            });

        });
    </script>
</body>

</html>