<?php 
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
if($_GET['id']){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `maso` = '".$_GET['id']."' LIMIT 1")); 
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
                <h5>Người đăng : <?php echo $infouser['name_gui']; ?> - ID : <?php echo $infouser['id_gui']; ?> 
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
              <h3 class="box-title">Công Cụ</h3> 
                <center><b> 
                  <p>Trạng Thái 
                 <?php if ($infouser['trangthai']==0){ ?><span class="badge bg-yellow">Đang chờ.</span> <?php } ?> 
                 <?php if ($infouser['trangthai']==1){ ?><span class="badge bg-green">Đã giải quyết.</span><?php } ?> 
                 <?php if ($infouser['trangthai']==2){ ?><span class="badge bg-red">Bị hủy.</span><?php } ?> 
                </p> 
                <a href="?vip=viewadmin_ticket&id=<?php echo $_GET['id'];?>&warning=<?php echo $_GET['id'];?>"><button type="button" class="btn btn-block btn-warning">Chờ Tiếp</button></a> 
                 
                <a href="?vip=viewadmin_ticket&id=<?php echo $_GET['id'];?>&done=<?php echo $_GET['id'];?>"><button type="button" class="btn btn-block btn-success">Giải Quyết.</button></a> 
                 
                <a href="?vip=viewadmin_ticket&id=<?php echo $_GET['id'];?>&error=<?php echo $_GET['id'];?>"><button type="button" class="btn btn-block btn-danger">Hủy!</button></a> 

              </b></center><br> 
                        </div> 
          <!-- /. box --> 
        </div> 
<?php 
if($_GET['done']){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `maso` = '".$_GET['id']."' LIMIT 1")); 
mysqli_query($vtasystem, "UPDATE `ticket` SET `trangthai`='1' WHERE `maso` = '".$_GET['id']."'"); 
$userxoa = $getuser['username']; 
$idxoa = $infouser['fbid']; 
$soticket = $infouser['maso']; 
$time = time(); //date("H:i:s d/m/Y") 
$content = "<b>$userxoa</b> Giải quyết sticket số <b>$soticket</b>."; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='TICKET',`content`='$content',`time`='".$time."'"); 
      echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=quanly_ticket'>"; 
      die("<script>alert('Thành công'); </script>"); 
exit; 
} 

if($_GET['warning']){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `maso` = '".$_GET['id']."' LIMIT 1")); 
mysqli_query($vtasystem, "UPDATE `ticket`SET `trangthai`='0' WHERE `maso` = '".$_GET['id']."'"); 
$userxoa = $getuser['username']; 
$idxoa = $infouser['fbid']; 
$soticket = $infouser['maso']; 
$time = time(); //date("H:i:s d/m/Y") 
$content = "<b>$userxoa</b> Giải quyết sticket số <b>$soticket</b>."; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='TICKET',`content`='$content',`time`='".$time."'"); 
      echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=quanly_ticket'>"; 
      die("<script>alert('Thành công'); </script>"); 
exit; 
} 

if($_GET['error']){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `maso` = '".$_GET['id']."' LIMIT 1")); 
mysqli_query($vtasystem, "UPDATE `ticket`SET `trangthai`='2' WHERE `maso` = '".$_GET['id']."'"); 
$userxoa = $getuser['username']; 
$idxoa = $infouser['fbid']; 
$soticket = $infouser['maso']; 
$time = time(); //date("H:i:s d/m/Y") 
$content = "<b>$userxoa</b> Giải quyết sticket số <b>$soticket</b>."; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='TICKET',`content`='$content',`time`='".$time."'"); 
      echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=quanly_ticket'>"; 
      die("<script>alert('Thành công'); </script>"); 
exit; 
} 

} 
} 
?> 