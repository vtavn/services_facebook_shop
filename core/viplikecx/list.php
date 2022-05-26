
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
              <th>Gói Like</th> 
          <th>Loại CX</th> 
          <th>Tốc Độ</th> 
              <th>Chú Thích</th>  
              <th>Hạn Sử Dụng</th> 
              <th>Tình Trạng</th>                 
              <th>Hành động</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `vip_like` WHERE `id_buy`=".$getuser['id']." AND `status`='checked'"); 
while($res = mysqli_fetch_assoc($req)){ 

?> 
            <tr> 
              <td> 
                <a href="http://facebook.com/<?php echo $res['fbid']; ?>" target="_blank" data-toggle="tooltip" title="Xem Thông Tin" style="color:black"><img class="img-circle" src="https://graph.facebook.com/<?php echo $res['fbid']; ?>/picture?width=15&amp;height=15"> <b><?php echo $res['fbid']; ?></b></a> 
              </td> 
              <td> 
                 <?php 
                   $get_package = mysqli_query($vtasystem, "SELECT * FROM package_vip WHERE id = '".$res['name_package']."' LIMIT 1"); 
        if ($get_package) { 
            $package = mysqli_fetch_assoc($get_package); 
                        $maxlike = $package['limit_like']; 
                } echo $maxlike; ?> Like 
              </td> 
              <td> 
                <?php echo $res['camxuc']; ?> 
              </td> 
              <td> 
                <?php echo $res['speed']; ?> Like/s 
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
<a href="/index.php?vip=update_viplikecx&edit=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Chỉnh Sửa" class="btn btn-success btn-simple btn-xs"><i style="font-size:15px;" class="fa fa-edit"></i></a> 
<a href="/index.php?vip=manager_viplikecx&xoa=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Xóa ID" class="btn btn-success btn-simple btn-xs">Xóa ID</a> 
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

<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Quản Lý ID Đang Dừng</b> 
                        </div> 
<div class="panel-body"> 
<div class="table-responsive"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>ID VIP</th> 
              <th>Gói Like</th> 
              <th>Loại CX</th> 
              <th>Tốc Độ</th> 
              <th>Chú Thích</th>  
              <th>Hạn Sử Dụng</th> 
              <th>Tình Trạng</th>          
              <th>Hành động</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `vip_like` WHERE `id_buy`=".$getuser['id']." AND `status`='1'"); 
while($res = mysqli_fetch_assoc($req)){ 

?> 
            <tr> 
              <td> 
                <a href="http://facebook.com/<?php echo $res['fbid']; ?>" target="_blank" data-toggle="tooltip" title="Xem Thông Tin" style="color:black"><img class="img-circle" src="https://graph.facebook.com/<?php echo $res['fbid']; ?>/picture?width=15&amp;height=15"> <b><?php echo $res['fbid']; ?></b></a> 
              </td> 
              <td> 
                 <?php 
                $get_package = mysqli_query($vtasystem, "SELECT * FROM package_vip WHERE id = '".$res['name_package']."' LIMIT 1"); 
    if ($get_package) { 
      $package = mysqli_fetch_assoc($get_package); 
                        $maxlike = $package['limit_like']; 
                } echo $maxlike; ?> Like 
              </td> 
        <td> 
                <?php echo $res['camxuc']; ?> 
              </td> 
        <td> 
                <?php echo $res['speed']; ?> Like/s 
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
<a href="/index.php?vip=update_viplikecx&edit=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Chỉnh Sửa" class="btn btn-success btn-simple btn-xs"><i style="font-size:15px;" class="fa fa-edit"></i></a> 
<?php if($getuser['level'] == 1){ ?>  
<a href="/index.php?vip=manager_viplikecx&xoa=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Xóa ID" class="btn btn-success btn-simple btn-xs">Xóa ID</a> 
<?php } ?> 
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

<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Quản Lý ID HẾT HẠN</b> 
                        </div> 
<div class="panel-body"> 
<div class="table-responsive"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>ID VIP</th> 
              <th>Gói Like</th> 
              <th>Loại CX</th> 
              <th>Tốc Độ</th> 
              <th>Chú Thích</th>  
              <th>Hạn Sử Dụng</th> 
              <th>Tình Trạng</th>          
              <th>Hành động</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `vip_like` WHERE `id_buy`=".$getuser['id']." AND `status`='2'"); 
while($res = mysqli_fetch_assoc($req)){ 

?> 
            <tr> 
              <td> 
                <a href="http://facebook.com/<?php echo $res['fbid']; ?>" target="_blank" data-toggle="tooltip" title="Xem Thông Tin" style="color:black"><img class="img-circle" src="https://graph.facebook.com/<?php echo $res['fbid']; ?>/picture?width=15&amp;height=15"> <b><?php echo $res['fbid']; ?></b></a> 
              </td> 
              <td> 
                 <?php 
                $get_package = mysqli_query($vtasystem, "SELECT * FROM package_vip WHERE id = '".$res['name_package']."' LIMIT 1"); 
    if ($get_package) { 
      $package = mysqli_fetch_assoc($get_package); 
                        $maxlike = $package['limit_like']; 
                } echo $maxlike; ?> Like 
              </td> 
        <td> 
                <?php echo $res['camxuc']; ?> 
              </td> 
        <td> 
                <?php echo $res['speed']; ?> Like/s 
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
<a href="/index.php?vip=manager_viplikecx&xoa=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Xóa ID" class="btn btn-success btn-simple btn-xs">Xóa ID</a> 
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
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `vip_like` WHERE `id` = '".$_GET[xoa]."' LIMIT 1")); 
if($infouser['id_buy'] != $getuser['id']){  
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=manager_viplikecx'>"; 
            die("<script>alert('Không thể xóa Tài Khoản của người khác'); </script>"); 
} else { 
mysqli_query($vtasystem, "DELETE FROM `vip_like` WHERE id ='" .  $_GET[xoa]. "'"); 
$idvip = 1; 
mysqli_query($vtasystem, "UPDATE account SET `idvip` = `idvip`-'".intval($idvip)."' WHERE id = '".$getuser['id']."'"); 

$userxoa = $getuser['username']; 
$idxoa = $infouser['fbid']; 
$time = time(); //date("H:i:s d/m/Y") 
$content = "<b>$userxoa</b> Vừa xóa VIP Cảm Xúc của ID <b>$idxoa</b>."; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='LIKE',`content`='$content',`time`='".$time."'"); 
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=manager_viplikecx'>"; 
            die("<script>alert('xóa thành công'); </script>"); 
exit; 
} 
} 
?> 

