<?php

session_start();
include ('../config/db_config.php');
include('header.php');
if (!isset($_SESSION['id'])) {
    header('location:../index');
}

$user_id = $_SESSION['id'];

//querry to select current user's information
$get_user_sql = "SELECT * FROM tbl_users WHERE id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $user_name   = $result['username'];
  $fullname  = $result['fullname'];

}

if (isset($_GET['id'])) {
    //select filename
$new = $_GET['id'];
$get_incident_sql = "SELECT * FROM tbl_incident WHERE objid = :id";
$get_incident_data = $con->prepare($get_incident_sql);
$get_incident_data->execute([':id'=>$new]); 
while ($result = $get_incident_data ->fetch(PDO::FETCH_ASSOC)) {
  $creator   = $result['reported_by'];
}

}
$get_all_incident_sql = "SELECT * FROM tbl_incident";
$get_all_incident_data = $con->prepare($get_all_incident_sql);
$get_all_incident_data->execute(); 
?>

<!DOCTYPE html> 
<html >



<body class="hold-transition sidebar-mini">

<div class="wrapper">
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php');?>

 
    <div class="content-wrapper">
      <div class="content-header"></div>

      
      
      <section class="content">
    
          <div class="card card-info">
            <div class="card-header">
              <h4 style="float:left;" >INCIDENT LIST</h4>
              
            </div>
          
            <div class="card-body">

              <div class="box box-primary">
                <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">

                  <div class="box-body">
                  
                   <table id="user" class="table table-bordered table-striped">
                      <thead>
                      
                        <tr style="font-size: 1.10rem">
                            <th> ID </th>
                            <th> Date</th>
                            <th> Time</th>      
                            <th> Type</th>                                                                 
                            <th> Severity</th>
                            <th> Topic </th>
                            <th> Person Reported </th>
                            <th> Remarks</th>
                            <th> Option</th>
                    
                          </tr>
                          
                      </thead>

                      <tbody>
                         <tr style="font-size: 1rem">
                        <?php while($incident_data = $get_all_incident_data->fetch(PDO::FETCH_ASSOC)){  
                          ?>

                           <?php if ($incident_data['reported_by']==$fullname) {?>
                            <td><?php echo $incident_data['objid'];?> </td>
                            <td><?php echo $incident_data['date'];?> </td>
                            <td><?php echo $incident_data['time'];?> </td>
                            <td><?php echo $incident_data['type'];?> </td>
                            <td><?php echo $incident_data['severity'];?> </td>
                            <td><?php echo $incident_data['topic'];?> </td>
                            <td><?php echo $incident_data['reported_by'];?></td>
                            <td><p class="text-success" style="text-align:center;"><strong>SEND</p></strong></td>
                            
                          
                          <td>
                             <a class="btn btn-danger btn-xs" href="updateForm_incident.php?objid=1">
                         <i class="fa fa-folder-open-o"></i> Open
                         </a>  

                      <?php }elseif($incident_data['reported_by']!=$fullname) {?>

                              <?php } ?>                    
                            
                          </td>


                          </tr>
                        <?php   } ?>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>       
         
          </div>
      </section>
      
      <div class = "modal fade " id="approved">
    <div class ="modal-dialog ">
    <div class ="modal-content ">
    <div class="modal-header card-outline card-primary" >
    <h4 class ="modal-title">Do you want to approve this data?</h4>
    </div>
    <form class =form-horizontal method ="POST" action = "update_incident.php"  enctype="multipart/form-data">
         <div class = "modal-body ">

         <label class = col-sm-2 col-form-label"> User ID:</label>
         <input type = "text" name = "userId" readonly class="form-control" id="userId">
         <label class = col-sm-3 col-form-label"> Full Name:</label>
         <input type = "text" name = "fullname" readonly class="form-control" id="fullname">
         <div class="modal-footer">            
        
        
         <button type="submit" class="btn btn-primary btn-sm " name = "approved" ><i class="fa fa-save"></i> YES</button>

         <button type="button" class="btn  btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>CLOSE</button>
         </div>
       
         </div>                 

    </form>
    </div>
    </div>
     </div>



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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
     $('#user').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "scrollX"     : true
    })
    $('.approved').click(function(e){
    e.preventDefault();
    $('#approved').modal('show');
    var id = $(this).data('id');
    var name = $(this).data('name');
      $('#userId').val(id);
      $.post("getUserdetail.php",
      {id:id},
      function(response){
        $("#fullname").html(response);
      }
      );
    
  //  getDetails(id);
    // alert(id);
    // alert(name);
  //   $.ajax({
  //   type: 'POST',
  //   url: 'updatecredentials.php',
  //   data: {id:id},
  //   dataType: 'json'
   
  // });


  });

  function getDetails(id){
    alert(id);
    $.ajax({
    type: 'POST',
    url: 'getUserdetail.php',
    data: {id2:id},
    dataType: 'json',
    success:   function(response){
      $('#fullname').val(response.fullname);
      console.log(response.fullname);
    }
    
    });
 
  }

  
</script> 
</body>
</html>
