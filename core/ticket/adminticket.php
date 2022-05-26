<?php 
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
?><!--Thống kê ticket--> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> DANH SÁCH TICKET HỆ THỐNG</b> 
                        </div> 
<div class="panel-body"> 
<div class="table-responsive"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>Mã Số</th> 
              <th>Chủ Đề</th> 
              <th>Tình trạng</th> 
              <th>Ngày gửi</th> 
              <th>Người gửi</th> 
              <th>Hành động</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `ticket`"); 
while($res = mysqli_fetch_assoc($req)){ 
?> 
            <tr> 
              <td> 
                <a href="/index.php?vip=viewadmin_ticket&id=<?php echo $res['maso']; ?>" target="_blank" data-toggle="tooltip" title="Xem Ticket" style="color:black"> 
                    <b><?php echo $res['maso']; ?></b></a> 
              </td> 
              <td> 
                    <?php echo $res['tenchude']; ?> 
              </td> 
              <td>               
                 <?php if ($res['trangthai']==0){ ?><span class="badge bg-yellow">Đang chờ.</span> <?php } ?> 
                 <?php if ($res['trangthai']==1){ ?><span class="badge bg-green">Đã giải quyết.</span><?php } ?> 
                 <?php if ($res['trangthai']==2){ ?><span class="badge bg-red">Bị hủy.</span><?php } ?> 
              </td> 
              <td> 
                <?php echo date('H:i d/m/Y', $res['time']); ?> 
              </td> 
              <td> 
                <?php echo $res['name_gui']; ?>(<?php echo $res['id_gui']; ?>) 
              </td> 
              <td> 
<a href="/index.php?vip=quanly_ticket&xoa=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Xóa ID" class="btn btn-success btn-simple btn-xs">Xóa</a> 
              </td> 
            </tr> 
            <?php 
} 
?> 
          </tbody> 
        </table> 
       </div> 
            </div> 
      </div> 

    </div> 
<?php 
if($_GET['xoa']){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `id` = '".$_GET['xoa']."' LIMIT 1")); 
mysqli_query($vtasystem, "DELETE FROM `ticket` WHERE id ='" . $_GET['xoa'] . "'"); 
$userxoa = $getuser['username']; 
$idxoa = $infouser['fbid']; 
$soticket = $infouser['maso']; 
$time = time(); //date("H:i:s d/m/Y") 
$content = "<b>$userxoa</b> Vừa xóa Ticket Số <b>$soticket</b>."; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='TICKET',`content`='$content',`time`='".$time."'"); 
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=quanly_ticket'>"; 
            die("<script>alert('xóa thành công'); </script>"); 
exit; 
} 
} 
?> 