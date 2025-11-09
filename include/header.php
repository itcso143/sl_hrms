<?php
include ('../config/db_config.php');

$user_id = $_SESSION['id'];



//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
    $db_email_ad = $result['email'];
    $db_contact_number = $result['contact_no'];
    $db_user_name = $result['username'];
    $department = $result['department'];

}

// $get_all_document_sql = "SELECT * FROM tbl_ledger";
// $get_all_document_data = $con->prepare($get_all_document_sql);
// $get_all_document_data->execute();  

// //select all outgoing documents
$get_all_document_sql = "SELECT * FROM tbl_documents where destination = '$department' and status in ('CREATED','FORWARDED') order by date LIMIT 5 ";
$get_all_document_data = $con->prepare($get_all_document_sql);
$get_all_document_data->execute();  
  

// count new messages
$get_all_message_sql = "SELECT count(*) as total FROM tbl_message where receiver = $user_id and status = 'PENDING'";
$get_all_message_data = $con->prepare($get_all_message_sql);
$get_all_message_data->execute();  
while ($result1 = $get_all_message_data->fetch(PDO::FETCH_ASSOC)) {
  $message_count =  $result1['total'];
}

// //select all messages for notification
$get_all_messages_sql = "SELECT * FROM tbl_message where receiver = $user_id or receiver = '0' and status = 'PENDING' ";
$get_all_messages_data = $con->prepare($get_all_messages_sql);
$get_all_messages_data->execute();  

// //select all messages for email
$get_all_messages1_sql = "SELECT * FROM tbl_message where receiver = $user_id or receiver = '0' ";
$get_all_messages1_data = $con->prepare($get_all_messages1_sql);
$get_all_messages1_data->execute();  
 

?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="send_email" class="nav-link">Contact</a>
      </li>
   
    <li class="nav-item d-none d-sm-inline-block">
        <a href="it_support" class="nav-link">IT Support</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <?php if ($message_count != 0) { ?>
          <span class="badge badge-danger navbar-badge"><?php echo $message_count ?> </span>
          <?php } ?>
                    </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php while($messages_data = $get_all_messages_data->fetch(PDO::FETCH_ASSOC)){ ?>
        <a href="read-mail.php?objid=<?php echo $messages_data['objid'];?>" class="dropdown-item">
            <!-- Message Start -->

          

            <div class="media">
              <img src="../dist/img/logo.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo $messages_data['sender']; ?>
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">  <?php echo $messages_data['subject']; ?></p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>   <?php echo $messages_data['date']; ?></p>
              </div>
            </div>
            <!-- Message End -->
          </a>

          <?php } ?>

         
            <!-- Message End -->
          </a>
          
          <div class="dropdown-divider"></div>
          <a href="mailbox.php" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"></span>
          <div class="dropdown-divider"></div>
          
          <?php while($notification_data = $get_all_document_data->fetch(PDO::FETCH_ASSOC)){ ?>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> <p style="font-size:12px"> <?php echo $notification_data['creator'] ?> <?php echo $notification_data['status'] ?> <?php echo $notification_data['docno'] ?> </p>
          
          </a>

          <?php } ?>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
         
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
            
      </li>
    </ul>
  </nav>