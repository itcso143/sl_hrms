
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}


//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_fullname = $result['fullname'];

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
 <!-- Date Picker -->
  <link rel="stylesheet" href=".s./plugins/datepicker/datepicker3.css">
  <!-- DataTables -->
   <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header"></div>

    <div class="container-fluid">      
     <div class="row">
        <div class="col-lg-3">
          <div class="card shadow h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <i class="fa fa-th-list fa-fw"></i> 
                </div>
                <div class="panel-heading"> SAN CARLOS -CDRRMO</div>


                <div class="row no-gutters align-items-center mt-1">
                  <div class="col-auto">
                    <div class="h6 mb-0 mr-0 text-gray-800">
                      <div class="panel-body">
                        <div class="list-group">
                          <?php 
                                // $query = "SELECT NAME, PRODUCT_CODE FROM product order by PRODUCT_ID DESC LIMIT 10";
                                // $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                // while ($row = mysqli_fetch_array($result)) {

                                //     echo "<a href='#' class='list-group-item text-gray-800'>
                                //           <i class='fa fa-tasks fa-fw'></i> $row[0]
                                //           </a>";
                                //   }
                          ?>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>   
          </div>
        
        </div>
      </div>
    </div>
    <!-- end row -->

  </div>
  <!-- /.content-wrapper -->
 <?php include('footer.php')?>

</div>

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
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
$('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'autoHeight'  : true
    })
  </script>
</body>
</html>
