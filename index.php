<?php

$state = "addnew";
$button = "add";
include('config/db_config.php');


$alert_msg = '';

if (isset($_POST['signin'])) {

  // Get POST data safely
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  // Prepare SQL (fetch only one user)
  $check_username_sql = "SELECT * FROM tbl_users WHERE username = :uname AND status = :status LIMIT 1";
  $stmt = $con->prepare($check_username_sql);
  $stmt->execute([
    ':uname' => $username,
    ':status' => 'ACTIVE'
  ]);


  if ($stmt->rowCount() === 1) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify hashed password
    if (password_verify($password, $result['password'])) {
      session_start();

      $_SESSION['id'] = $result['id'];
      $_SESSION['username'] = $result['username'];
      $_SESSION['user_type'] = $result['user_type'];
      $_SESSION['account_role'] = $result['account_role'];

      // Redirect based on user type
      if ($result['user_type'] === 'ADMIN') {
        header('Location: admin/list_employee.php');
        exit;
      } elseif ($result['user_type'] === 'USER') {
        header('Location: user/list_dailylogs.php');
        exit;
      } else {
        // If user_type is something else
        $alert_msg = '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-warning"></i>
                        Unknown user type!
                    </div>';
      }
    } else {
      // Wrong password
      $alert_msg = '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-warning"></i>
                    Password did not match!
                </div>';
    }
  } else {
    // No such username
    $alert_msg = '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i>
                Username does not exist or is inactive!
            </div>';
  }

 
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SL HRMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include('includes/pluginscript.php'); ?>



</head>

<body>

  <!-- ======= Header ======= -->


  <!-- ======= Hero Section ======= -->

  <?php include('includes/top-bar.php'); ?>
  <main id="main">




  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php include('includes/scripts.php') ?>




  <!-- <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="50">
      <img src="logo/logo.png" class="img-fluid animated" alt="">
    </div> -->



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