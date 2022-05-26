<?php 
if($getuser['level'] > 2) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
?> 
<div class="col-lg-7"> 

<?php  
if($_GET['xoactv']){ 
?> 

 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Xác nhận xóa tài khoản ctv</b> 
                        </div> 
<div class="panel-body"> 
<form action="" method="POST"> 
    <div class="form-group"> 
      <label for="usr" style="color:red">Bạn Có Chắc Chắn Muốn Khóa ID: <b><font color="blue"><?php echo $_GET['xoactv']; ?></font></b></label> 
    </div> 
    <button type="submit" name="xoactv" class="btn btn-danger">Xóa Người Dùng</button> 
</form> 
</div></div> 
<?php 
if (isset($_POST['xoactv'])) { 
mysqli_query($vtasystem, "UPDATE account SET nguoitao = 0, level = 4 WHERE id ='" .$_GET['xoactv']. "' "); 
                                       //up log 
                    $timess = time(); 
                   $content = "<b>" .$getuser['username']. "</b> vừa xóa tài khoản cộng tác viên của ".$_GET['xoactv']."<b></b>"; 
                                $update_log = mysqli_query($vtasystem, "INSERT INTO `LOG_HT` SET `id_user`='".$getuser['id']."', `type`='EDIT',`content`='$content',`time`='".$timess."'"); 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=quan_ly_ctv_cuaminh">'; 
die('<script>alert("Khóa Tài Khoản Thành Công!"); </script>'); 
exit; 
} 
} 
?>   

<?php  
if($_GET['themid']){ 
?> 

 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Thêm ID VIP Cho CTV</b> 
                        </div> 
<div class="panel-body"> 
<form action="" method="POST"> 
    <div class="form-group"> 
      <label for="usr">Số ID muốn cộng:</label> 
      <input type="number" class="form-control" name="toida"> 
    </div> 
    <button type="submit" name="themid" class="btn btn-danger">Thêm ID</button> 
</form> 
</div></div> 

<?php 
if (isset($_POST['themid'])) { 
mysqli_query($vtasystem "UPDATE account SET `toida` = `toida` + '".intval($_POST['toida'])."' WHERE id = '" . $_GET['themid'] . "'"); 
mysqli_query($vtasystem, "UPDATE account SET `toida` = `toida` - '".intval($_POST['toida'])."' WHERE id = '".$_SESSION['id']."'"); 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=quan_ly_ctv_cuaminh">'; 
die('<script>alert("Thêm id vào Tài Khoản Thành Công!"); </script>'); 
exit; 
} 
} 
?>   

<?php  
if($_GET[congtien]){ 
?> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Cộng Thêm Tiền Cho CTV</b> 
                        </div> 
<div class="panel-body"> 
<form action="" method="POST"> 
    <div class="form-group"> 
      <label for="usr">Số tiền muốn cộng:</label> 
      <input type="number" class="form-control" name="vnd"> 
    </div> 
    <button type="submit" name="congtien" class="btn btn-danger">Cộng tiền</button> 
</form> 
</div></div> 
<?php 
if (isset($_POST['congtien'])) { 
mysqli_query($vtasystem, "UPDATE account SET `vnd` = `vnd` + '".intval($_POST['vnd'])."' WHERE id = '" . $_GET['congtien'] . "'"); 
mysqli_query($vtasystem, "UPDATE account SET `vnd` = `vnd` - '".intval($_POST['vnd'])."' WHERE id = '".$_SESSION['id']."'"); 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=quan_ly_ctv_cuaminh">'; 
die('<script>alert("Cộng tiền Tài Khoản Thành Công!"); </script>'); 
exit; 
} 
} 
?>   
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Tài Khoản CTV Của Bạn</b> 
                        </div> 
<div class="panel-body"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>ID</th> 
              <th>Tài Khoản</th> 
              <th>Tên Hiển Thị</th> 
              <th>Số Lượng ID</th> 
              <th>Tiền</th> 
              <th>Kích hoạt</th> 
              <th>Hành Động</th> 
            </tr> 
          </thead> 
          <tbody> 
            <?php 
$i=1; 
$req = mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `nguoitao`='".$getuser['id']."' ORDER BY id DESC"); 
while($res = mysqli_fetch_assoc($req)){ 
?> 
            <tr> 
              <td> 
                <?php echo $res['id']; ?> 
              </td> 
              <td> 
                <?php echo htmlspecialchars($res['username']); ?> 
              </td> 
              <td> 
                <?php echo $res['fullname']; ?> 
              </td> 
              <td> 
                <?php echo number_format($res['toida']); ?> ID 
              </td> 
              <td> 
                <?php echo number_format($res['vnd']); ?> VNĐ 
              </td> 
              <td> 
                 <?php if ($res['kichhoat']==0){ ?><span class="label label-danger">Block</span><?php } ?> 
                 <?php if ($res['kichhoat']==1){ ?><span class="label label-success">Hoạt Động</span><?php } ?> 
              </td> 
              <td> 
                <a data-toggle="tooltip" title="Cộng Tiền" class="btn btn-xs btn-danger" href="index.php?vip=quan_ly_ctv_cuaminh&congtien=<?php echo $res['id']; ?>">+<i class="fa fa-usd" aria-hidden="true"></i></a> 
                <a data-toggle="tooltip" title="Thêm ID GIỚI HẠN" class="btn btn-xs btn-danger" href="index.php?vip=quan_ly_ctv_cuaminh&themid=<?php echo $res['id']; ?>"><b> <i class="fa fa-plus-square-o" aria-hidden="true"></i></b></a> 
                 <a data-toggle="tooltip" title="Xóa khỏi cộng tác viên" class="btn btn-xs btn-success" href="index.php?vip=quan_ly_ctv_cuaminh&xoactv=<?php echo $res['id']; ?>">Xóa CTV</a> 
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

<div class="col-lg-5"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Chú Thích</b> 
                        </div> 
<div class="panel-body"> 
<p>Đây là bảng quản lý cộng tác viên của bạn</p> 
<p>Số Tiền, Số ID tại đây khi bạn chuyển cho CTV của bạn sẽ bị trừ vào tài khoản của bạn nhé.</p> 
  </div> 
<?php 
} 
?> 
