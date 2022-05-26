
<?php 
if($_GET['id']){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `maso` = '".$_GET['id']."' LIMIT 1")); 
if($infouser['id_gui'] != $getuser['id']){  
      echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=ticket'>"; 
      die("<script>alert('Không thể xem ticket của người khác'); </script>"); 
} else { 
?> 

<div class="col-md-12"> 
          <div class="box box-primary"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Read Mail</h3> 

              <div class="box-tools pull-right"> 
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a> 
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a> 
              </div> 
            </div> 
            <!-- /.box-header --> 
            <div class="box-body no-padding"> 
              <div class="mailbox-read-info"> 
                <h3><?php echo $infouser['tenchude']; ?></h3> 
                <h5>From: hotrokhachhang 
                  <span class="mailbox-read-time pull-right"><?php echo date('H:i d/m/Y', $infouser['time']); ?></span></h5> 
              </div> 
              <!-- /.mailbox-read-info --> 
              <div class="mailbox-controls with-border text-center"> 
                <div class="btn-group"> 
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Delete"> 
                    <i class="fa fa-trash-o"></i></button> 
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Reply"> 
                    <i class="fa fa-reply"></i></button> 
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Forward"> 
                    <i class="fa fa-share"></i></button> 
                </div> 
                <!-- /.btn-group --> 
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="" data-original-title="Print"> 
                  <i class="fa fa-print"></i></button> 
              </div> 
              <!-- /.mailbox-controls --> 
              <div class="mailbox-read-message"> 
                <p><?php echo $infouser['noidung']; ?></p> 
                <br/> 

              </div> 
              <!-- /.mailbox-read-message --> 
            </div> 
            <!-- /.box-body --> 
            <div class="box-footer"> 
              <div class="pull-right"> 
                <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button> 
                <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button> 
              </div> 
              <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button> 
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button> 
            </div> 
            <!-- /.box-footer --> 
          </div> 
          <!-- /. box --> 
        </div> 

<div class="col-md-12"> 
          <div class="box box-primary"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Read Mail</h3> 

              <div class="box-tools pull-right"> 
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a> 
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a> 
              </div> 
            </div> 
            <div class="box-body no-padding"> 
              <div class="mailbox-read-info"> 
                <h3>CHĂM SÓC KHÁCH HÀNG</h3> 
                <h5>From: <?php echo $infouser['name_gui'];?> 
                  <span class="mailbox-read-time pull-right"><?php echo date('H:i d/m/Y', time()); ?></span></h5> 
              </div> 
                <center><b> 
                <?php if ($infouser['trangthai']==0){ ?> 
                <p>Yêu cầu của bạn đã được gửi đi. Chúng tôi đang xử lý vui lòng chờ đợi.</p> 
                <p>Thanks,<br>VTA!</p> 
                <button type="button" class="btn btn-block btn-warning">Đang chờ giải quyết.</button>  
                <?php } ?> 
                <?php if ($infouser['trangthai']==1){ ?> 
                <p>Yêu cầu của bạn đã được giải quyết. Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p> 
                <p>Thanks,<br>VTA!</p> 
                <button type="button" class="btn btn-block btn-success">Đã giải quyết.</button> 
                <?php } ?> 
                <?php if ($infouser['trangthai']==2){ ?> 
                <p>Yêu cầu của bạn đã bị hủy.</p> 
                <p>Thanks,<br>VTA!</p> 
                <button type="button" class="btn btn-block btn-danger">Bị hủy.</button> 
                <?php } ?> 
              </b></center><br> 
                        </div> 
          <!-- /. box --> 
        </div> 
         
<?php 
} 
} 
?> 
