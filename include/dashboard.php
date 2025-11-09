 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
         
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
     <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">

          <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box bg-info-gradient">
        
          <span class="info-box-icon bg-info elevation-1">   <a href="list_incoming.php"> <i class="fa fa-arrow-circle-down"></i></a></span>
          
              <div class="info-box-content">
              
                <span class="info-box-text">Incoming</span>
                <span class="info-box-number">
                <?php echo $incoming_count ?>
             
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box bg-danger-gradient">
              <span class="info-box-icon bg-danger elevation-1"> <a href="list_received.php">  <i class="fa fa-folder-open"></i></a></span>

              <div class="info-box-content">
                <span class="info-box-text">Received</span>
                <span class="info-box-number">
                <?php echo $received_count ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box bg-success-gradient">
              <span class="info-box-icon bg-success elevation-1"><a href="list_outgoing.php"> <i class="fa fa-arrow-circle-up"></i></a></span>

              <div class="info-box-content">
                <span class="info-box-text">Outgoing</span>
                <?php echo $outgoing_count ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box bg-warning-gradient">
              <span class="info-box-icon bg-warning elevation-1"> <a href="list_archived.php"> <i class="fa fa-archive"></i></a></span>

              <div class="info-box-content">
                <span class="info-box-text">Archive</span>
                 <?php echo $received_count ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <!-- Main row -->
       
          <!-- /.box -->
        </div>
      <!-- TO DO List -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
      
         
            <!-- /.card-body -->
          </div>
          <!-- /. box -->
        
            <!-- /.card-body -->
        
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-20">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fa fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                
                <!-- /.btn-group -->
                
                <div class="float-right">
                
                  <div class="btn-group">
                    
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php while($messages_data = $get_all_messages1_data->fetch(PDO::FETCH_ASSOC)){ ?>
                  <tr>
                    <td><input type="checkbox"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-warning"></i></a></td>
                    <td class="mailbox-name"><a href="read-mail.php?objid=<?php echo $messages_data['objid'];?>"><?php echo $messages_data['sender'];?></a></td>
                    <td class="mailbox-subject"><?php echo $messages_data['subject'];?>
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo $messages_data['date'];?></td>
                  </tr>
                 
                  <?php } ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
           
  
        