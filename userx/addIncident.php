<?php include('session.php');?>
<?php include('add_post.php');?>
<?php include('sidebar.php');?>
<?php include('header.php');?>    
  
  <!-- Left side column. contains the logo and sidebar -->
     <div class="content-wrapper">
      <div class="content-header"></div>     
      
      <section class="content">
     <div class="row">
        <div class="col-md-1"></div>
         <div class="col-md-10">
          <div class="card card-info">
            <div class="card-header">
              <h4 style="float:left;" >REPORT INCIDENT</h4>
                    
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
          
            <div class="card-body">

              <div class="box box-primary">
            <form role="form" enctype="multipart/form-data" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
           <div class="card-body">
   <div>
                 <?php echo $alert_msg; ?>
                 <?php echo $alert_msg2; ?>
             </div></form>
                  <div class="box-body">

  <input type="hidden" id="inputId" name="objid" class="form-control" value="<?php echo $objid;?>">

  <input type="hidden" id="inputLatitude" name="latitude" class="form-control" value="<?php echo $latitude;?>">

  <input type="hidden" id="inputLongitude" name="longitude" class="form-control" value="<?php echo $longitude;?>">

   <input type="hidden" id="inputRemarks" name="Remarks" class="form-control" rows="4" value="<?php echo $remarks;?>">
              </div>
      
              <div class="form-group">
                <label for="inputCreate">CREATED</label>
               <input type="text" id="inputReported" readonly="true"name="topicDateAndTimePosted" class="form-control" value="<?php echo $date=date('F d, Y');?> | <?php echo $time=date('h:i:sa')?>"> 
              </div>
                   
                <div class="form-group">
                <label for="inputType">TYPE</label>
                <select class="form-control custom-select2" name="type" value="<?php echo $type;?>" >
                  <option selected disabled>Please Select</option>
                  <option>Accident</option>
                  <option>Crime</option>
                  <option>Fire</option>
                </select>
              </div>

               <div class="form-group">
                <label for="inputSeverity">SEVERITY</label>
                <select class="form-control custom-select2" name="topicSeverity" value="<?php echo $severity;?>" >
                  <option selected disabled>Please Select</option>
                  <option>Major</option>
                  <option>Moderate</option>
                  <option>Minor</option>
                </select>
              </div>

               <div class="form-group">
                <label for="inputTopic">TOPIC</label>
                <textarea id="inputTopic" name="topicTitle" class="form-control" rows="4" value="<?php echo $title;?>"></textarea>
              </div>

              <div class="form-group">
                <label for="inputLocation">LOCATION</label>
               <input type="text" id="inputLocation" name="topicLocationAddress" class="form-control" value="<?php echo $locationAddress;?>">
              </div>

               <div class="form-group">
                <label for="inputMobile">MOBILE NO.</label>
               <input type="text" id="inputMobile" name="mobileNo" class="form-control" value="<?php echo $contact;?>">
              </div>


               <div class="form-group">
                <label for="inputReported" style="color:white;">REPORTED BY</label>
               <input type="hidden" id="inputReported" readonly="true"name="topicPostedBy" class="form-control" value="<?php echo $fullname;?>"> 
              </div>
             
             
              <div class="widget-user-image">
                <img class="img" id="image" src="../dist/img/boxed-bg.jpg" width="250" height="200" vspace="10" alt="User Avatar">
             <br>

             <label>UPLOAD PHOTOS</label>
            <div class="col-md-12">
             <input class="text-lg" type ="file" name="myFiles" id="fileToUpload"  onchange = "loadImage()">
            </div>
              
              
        </div>
         <div class="card-footer">
        <input type="submit"  <?php echo $btnNew; ?> name="add" class="btn btn-primary float-right" value="New">
        <input type="submit"  <?php echo $btnStatus; ?> name="addPost" class="btn btn-primary" value="Save">
        <a href="index">
        <input type="button" name="cancel" class="btn btn-secondary" value="Cancel">       
                        </a>
       </div>
             </div>  
             </div>
                 <!-- /.card-body -->
          </div>
          <!-- /.card -->     
      </div>
      
      </section>
       
  



    </div>

  <!-- footer here -->
    <?php include('footer.php');?>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery/jquery.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../plugins/pace/pace.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- JQVMap -->
<script src="plugins/jquery/jquery.slim.min.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- loadImage -->
<script>
function loadImage(){
    var input = document.getElementById("fileToUpload");
var fReader = new FileReader();
fReader.readAsDataURL(input.files[0]);
fReader.onloadend = function(event){
    var img = document.getElementById("image");
    img.src = event.target.result;
}
}
</script> 

</body>
</html>