<!-- navbar and sidebar -->
<?php

include ('../config/db_config.php');




// include ('../config/db_config.php');
// session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}


$db_fullname = '';

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $db_fullname = $result['fullname'];
  
}


?>
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>

     
    </ul>
   
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../lockscreen.php" class="nav-link">Lock Screen</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Log Out</a>
      </li>
     </ul>
    
   
     
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../dist/img/scdrrmo_logo.png" class="img-circle elevation-2" width="40px">   
      <span class="brand-text font-weight-light"><b>SCCDRRMO</b> | SYSTEM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php echo $db_fullname ?>  </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
               <li class="nav-item">
                <a href="index" class="nav-link active">
                  <i class="nav-icon fa fa-th"></i>
                  <p>
                    Dashboard
                   
                  </p>
                </a>
              </li>
           
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon fa fa-exclamation-circle"></i>
                  <p>
                  Announcement
                   
                  </p>
                </a>
              </li>

          <li class="nav-item has-treeview" style="font-size:16px">
            <a href="addIncident.php" class="nav-link ">
              <i class="nav-icon fa fa-plus"></i>
              <p>
                REPORT INCIDENT
              </p>
            </a>

            <li class="nav-item has-treeview" style="font-size:16px">
            <a href="list_incident.php" class="nav-link ">
              <i class="nav-icon fa fa-exchange"></i>
              <p>
                LIST INCIDENT REPORTED
              </p>
            </a>
       
           
            <li class="nav-item has-treeview" style="font-size:16px">
            <a href="properties" class="nav-link ">
              <i class="nav-icon fa fa-list"></i>
              <p>
                PROPERTIES
                <!-- <i class="right fa fa-angle-left"></i> -->
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
               -->

               <!-- <li class="nav-item">
                <a href="list_position" class="nav-link">
                  <i class="fa fa-minus nav-icon"></i>
                  <p>Position</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="list_section" class="nav-link">
                  <i class="fa fa-minus nav-icon"></i>
                  <p>Section</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="list_employee" class="nav-link">
                  <i class="fa fa-minus nav-icon"></i>
                  <p>Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="list_approvedby" class="nav-link">
                  <i class="fa fa-minus nav-icon"></i>
                  <p>Approved by</p> 
                </a>
              </li>
              <li class="nav-item">
                <a href="list_preparedby" class="nav-link">
                  <i class="fa fa-minus nav-icon"></i>
                  <p>Prepared by</p> 
                </a>
              </li>
              <li class="nav-item">
                <a href="list_requestedby" class="nav-link">
                  <i class="fa fa-minus nav-icon"></i>
                  <p>Requested by</p> 
                </a>
              </li> -->
              
            <!-- </ul> -->
              
            
            <li class="nav-item has-treeview" style="font-size:16px">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-cogs" ></i>
              <p>
                SYSTEM
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>  
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Lock Screen</p>
                </a>
                <li class="nav-item">
                <a href="../index.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Log Out</p>
                </a>
             
            </ul>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>