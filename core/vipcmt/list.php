
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Quản Lý ID Của Bạn</b> 
                        </div> 
<div class="panel-body"> 
<div class="table-responsive"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>ID VIP</th> 
              <th>Gói CMT</th> 
                <th>Tốc Độ</th> 
              <th>Chú Thích</th>  
              <th>Hạn Sử Dụng</th> 
              <th>Tình Trạng</th>                 
              <th>Hành động</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `vip_cmt` WHERE `id_buy`=".$getuser['id'].""); 
while($res = mysqli_fetch_assoc($req)){ 
?> 
            <tr> 
              <td> 
                <a href="http://facebook.com/<?php echo $res['fbid']; ?>" target="_blank" data-toggle="tooltip" title="Xem Thông Tin" style="color:black"><img class="img-circle" src="https://graph.facebook.com/<?php echo $res['fbid']; ?>/picture?width=15&amp;height=15"> <b><?php echo $res['fbid']; ?></b></a> 
              </td> 
              <td> 
                 <?php 
                   $get_package = mysqli_query($vtasystem, "SELECT * FROM package_vipcmt WHERE id = '".$res['name_package']."' LIMIT 1"); 
        if ($get_package) { 
            $package = mysqli_fetch_assoc($get_package); 
                        $maxlike = $package['limit_cmt']; 
                } echo $maxlike; ?> CMT 
              </td> 
                    <td> 
                <?php echo $res['speed']; ?> CMT/Phút 
              </td> 
              <td> 
                <?php echo $res['name']; ?> 
              </td> 
              <td> 
                <?php echo date('H:i d/m/Y', $res['time_buy']+($res['limit_time']*30*86400)); ?> 
              </td> 
              <td>               
                 <?php if ($res['status']==0){ ?><span class="label label-success">Đang chạy</span> <?php } ?> 
                 <?php if ($res['status']==1){ ?><span class="label label-primary">Đang dừng</span><?php } ?> 
                 <?php if ($res['status']==2){ ?><span class="label label-primary">Hết hạn</span><?php } ?> 
              </td> 
              <td> 
<a href="/index.php?vip=update_vipcmt&edit=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Chỉnh Sửa" class="btn btn-success btn-simple btn-xs"><i style="font-size:15px;" class="fa fa-edit"></i></a> 
<a href="/index.php?vip=manager_vipcmt&xoa=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Xóa ID" class="btn btn-danger btn-simple btn-xs"><i style="font-size:15px;" class="fa fa-times"></i></a> 
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
if($_GET[xoa]){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `vip_cmt` WHERE `id` = '".$_GET[xoa]."' LIMIT 1")); 
if($infouser[id_buy] != $_SESSION['id']){  
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=manager_viplikecx'>"; 
            die("<script>alert('Không thể xóa Tài Khoản của người khác'); </script>"); 
} else { 
mysqli_query($vtasystem, "DELETE FROM `vip_cmt` WHERE id ='" . mysqli_real_escape_string($vtasystem, $_GET[xoa]) . "'"); 
$idvip = 1; 
mysqli_query($vtasystem, "UPDATE account SET `idvip` = `idvip`-'".intval($idvip)."' WHERE id = '".$_SESSION['id']."'"); 

$userxoa = $getuser['username']; 
$idxoa = $infouser['fbid']; 
$time = time(); //date("H:i:s d/m/Y") 
$content = "<b>$userxoa</b> Vừa xóa VIP CMT của ID <b>$idxoa</b>."; 
mysqli_query($vtasystem, "INSERT INTO `LOG_HT` SET `id_user`='".$getuser['id']."', `type`='CMT',`content`='$content',`time`='".$time."'"); 
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=manager_vipcmt'>"; 
            die("<script>alert('xóa thành công'); </script>"); 
exit; 
} 
} 
?> 

