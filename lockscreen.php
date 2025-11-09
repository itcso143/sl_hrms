<?php
 
include ('config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

$get_user_sql = "SELECT * FROM tbl_users WHERE id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_first_name = $result['firstname'];
    $db_middle_name = $result['middlename'];
    $db_last_name = $result['lastname'];


    $username = $result['username'];
    $department= $result['department'];
}

if (isset($_POST['signin'])){
  //to check if data are passed
  // echo "<pre>";
  //     print_r($_POST);
  // echo "</pre>";

  //$username = $_SESSION['username'];
  $password = $_POST['password'];

  $check_username_sql = "SELECT * FROM tbl_users where username = :uname";
  
  $username_data = $con->prepare($check_username_sql);
  $username_data ->execute([
    ':uname' => $username
  ]);
    if ($username_data->rowCount() > 0){
      while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {
    
        //from database already hash
        $hash_password = $result['password'];

        //hash the $u_pass and compared to $hashed_password
        if (password_verify($password, $hash_password)) {
         session_start();
         $_SESSION['id'] = $result['id'];

          if ($result['account_type'] == 1) {
            


            header('location: barangay/list_clearance'); //location is folder
          }
          else {
            header('location: user');
          }
        }
        else{
          echo "Password does not match!";
          $alert_msg .= ' 
          <div class="new-alert new-alert-warning alert-dismissible">
          <i class="icon fa fa-warning"></i>
          Username does not exist!
      </div>   
      ';
        }

          
      }
 
  }

  

  

}

//variable declaration


  
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BARANGAY CLEARANCE SYSTEM | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>
      <body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">

  <div class="lockscreen-logo">

  <img src="dist/img/lgu.png" >
  
  </div>
  <div class="lockscreen-logo">
  <a>BARANGAY CLEARANCE SYSTEM </a>
  </div>

  <!-- /.lockscreen-item -->
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
  
  <div class="form-group has-feedback" align="center">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
     
        Enter your password to retrieve your session
      </div>


  
 
  <div align="center">
          <input type="submit" class="btn btn-success pull-right" name="signin" value="Log In">
        </div>

        <div class="help-block text-center">
  
  </div>
 
 
  </div>
  </div>


</form>
<!-- /.center -->

<!-- jQuery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
