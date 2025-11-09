<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="../dist/css/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  // $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
<!-- <script src="../plugins/morris/morris.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="../plugins/sparkline/jquery.sparkline.min.js"></script> -->
<!-- jvectormap -->
<!-- <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
<!-- <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="../plugins/knob/jquery.knob.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
<!-- <script src="../plugins/daterangepicker/daterangepicker.js"></script> -->
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
<!-- <script src="../dist/js/demo.js"></script> -->
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
    // $(document).on('click', 'button[data-role=routing_slip]', function(event){
    //   event.preventDefault();

    //   // var user_id = ($(this).data('id'));

    //   // $('#user_id').val(user_id);
    //   $('#routing-slip_Modal').modal('toggle');

    // })

  
    $('#scan_track').on('change',function(){
  
  // function receive(){
             var docno = document.getElementById("scan_track").value;
           
            //  alert (docno);
         
            $.ajax({
              type:'POST',
              data:{docno:docno},
              url:'scan_track.php',
               success:function(data){
                var result = $.parseJSON(data);
                // alert(result.type)
                 document.getElementById('lblDate').innerHTML = result.date;
                 document.getElementById('lblTime').innerHTML = result.time;
                 document.getElementById('lblType').innerHTML = result.type;
                 document.getElementById('lblParticulars').innerHTML = result.particulars;
                 document.getElementById('lblOrigin').innerHTML = result.origin;
                 document.getElementById('lblDestination').innerHTML = result.destination;
                 document.getElementById('lblRemarks').innerHTML = result.remarks;
                 document.getElementById('lblMessage').innerHTML = result.message;

               }
            
                });   
              
                document.getElementById('scan_track').focus();
                document.getElementById('scan_track').select();
               
                //
              
              
    });
          
              
  

        
                     
 </script>

</body>
</html>