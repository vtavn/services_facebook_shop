
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i>  Quản Lý BOT</b> 
                        </div> 
       <div class="panel-body"> 
<div class="table-responsive"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
               
              <th>Tên</th> 
              <th>Loại Cảm xúc</th> 
              <th>Live Token</th> 
              <th>Số Lần Chạy</th> 
              <th>Hạn Sử Dụng</th> 
              <th>Tình Trạng</th> 
              <th>Hành động</th> 
            </tr> 
          </thead> 
          <tbody> 
            <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `vip_bot` WHERE `id_buy`=".$getuser['id'].""); 
while($res = mysqli_fetch_assoc($req)){ 
?> 

            <tr> 
               
              <td> 
                <a href="http://facebook.com/<?php echo $res['idfb']; ?>" target="_blank" data-toggle="tooltip" title="" style="color:black" data-original-title="Xem Thông Tin"> 
                  <img class="img-circle" src="https://graph.facebook.com/<?php echo $res['idfb']; ?>/picture?width=15&amp;height=15"> <b><?php echo $res['name']; ?></b> (<?php echo $res['idfb']; ?>)</a> 
              </td> 
              <td> 
                <?php echo $res['camxuc']; ?> 
              </td> 
               <td> 
                <?php if($res['status'] == 3){ 
                  echo "<button class='btn btn-rounded btn-xs btn-danger'><i class='fa fa-times'></i> <b>Token Die</b></button>"; 
                }else{ 
                  echo "<button class='btn btn-rounded btn-xs btn-success'><i class='fa fa-check'></i> <b>Live</b></button>"; 
                } ?> 
              </td> 
              <td> 
                <?php echo "<button class='btn btn-rounded btn-xs btn-info'><b>".$res['solanchay']." lần</b></buton>"; ?> 
              </td> 
              <td> 
                <?php echo "<button class='btn btn-rounded btn-xs btn-info'><b>".date("d-m-20y", $res['time'])."</b></buton>"; ?> 
              </td> 
              <td> 
                <?php  
                if($res['status'] == 0){ 
                    echo "<button class='btn btn-rounded btn-xs btn-success'><i class='fa fa-check'></i> <b>Đang Chạy</b></button>"; 
                }elseif($res['status'] == 1){ 
                    echo "<button class='btn btn-rounded btn-xs btn-danger'><i class='fa fa-times'></i> <b>Tạm Dừng</b></button>"; 
                }else if($res['status'] == 3){ 
                  echo "<button class='btn btn-rounded btn-xs btn-danger'><i class='fa fa-times'></i> <b>Token Die</b></button>"; 
                }else{ 
                  echo "<button class='btn btn-rounded btn-xs btn-danger'><i class='fa fa-times'></i> <b>Hết Hạn</b></button>"; 
                } ?> 
              </td> 
              <td> 
<a href="/index.php?vip=update_vipbot&edit=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Chỉnh Sửa" class="btn btn-success btn-simple btn-xs">Chỉnh Sửa</a> 
<!--a href="/index.php?vip=log-vip-bot&id=<?php //echo $res['idfb']; ?>" data-toggle="tooltip" title="Xem LOG" class="btn btn-success btn-simple btn-xs">Xem Log</a--> 
<a href="/index.php?vip=manager_vipbot&xoa=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Xóa ID" class="btn btn-danger btn-simple btn-xs">Xóa ID</a> 

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
$infongdung = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `vip_bot` WHERE `id` = '".$_GET['xoa']."' LIMIT 1")); 
if($infongdung['id_buy'] != $_SESSION['id']){ 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=manager_vipbot">'; 
die('<script>alert("Không thể xóa Tài Khoản của người khác!", "Thông báo");</script>'); 
} else { 
mysqli_query($vtasystem, "DELETE FROM `vip_bot` WHERE id ='" . $_GET['xoa'] . "'"); 
    $time = time(); //date("H:i:s d/m/Y") 
    $idbot = $infongdung['idfb']; 
    $name = $infongdung['name']; 
    $nameuser = $getuser['username']; 
    $content = "<b>$nameuser</b> vừa xóa id vip bot cảm xúc <b>$idbot</b>($name)"; 
    mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='BOT',`content`='$content',`time`='".$time."'"); 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=manager_vipbot">'; 
die('<script>alert("Xóa Thành Công!", "Thông báo");</script>'); 

exit; 
} 
} 
?> 
