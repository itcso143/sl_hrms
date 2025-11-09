<section id="hero" class="d-flex align-items-start" style="min-height: 100vh; background-color: #f0f2f5; padding-top: 0px;">

  <div class="container">
    <div class="row justify-content-center">

      <!-- Login Form Column -->
      <div class="col-lg-5 d-flex flex-column justify-content-start order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">

        <div class="login-box-body mx-auto" style="max-width: 400px; width: 100%; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
          <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
              <?php echo $alert_msg; ?>
            </div>

            <video class="img-fluid mb-3 d-block" autoplay muted loop playsinline
              style="
    display: block;
    background-color: transparent;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    margin: 0 auto;
  ">
              <source src="logo/logo3.mp4" type="video/mp4">
              Your browser does not support the video tag.
            </video>


            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <br>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>

            <div class="text-center mt-3">
              <input type="submit" class="btn btn-primary" name="signin" value="Log In">
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

</section>