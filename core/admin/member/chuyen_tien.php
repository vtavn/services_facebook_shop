
<?php 
session_start(); 
if(!$_SESSION['id']) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
die('<script>alert("Vui Lòng Đăng Nhập!"); </script>'); 
}else{ 
?> 
<div class="col-lg-7"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Chuyển tiền</b> (tối đa chuyển 20.000vnđ.) 
                        </div> 
<div class="panel-body"> 
<?php  
if (isset($_POST['chuyentien'])) { 
$taikhoan = $_POST['username']; 
$sotien = intval($_POST['sotien']); 
$noidung = $_POST['noidung']; 
    $sql = "SELECT * FROM account WHERE username = '".$taikhoan."' LIMIT 1";
    $result=mysqli_query($vtasystem, $sql);
    $checkuser = mysqli_num_rows($result);

$idnhan = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE username = '".$taikhoan."'")); 
if($getuser['block'] == '1'){ 
    echo '<div class="alert alert-warning">Tài khoản <strong>'.$getuser['username'].'</strong> bị lỗi giao dịch!</div>'; 
}elseif($getuser['vnd'] < $sotien){ 
echo '<div class="alert alert-warning">Bạn KHông đủ tiền!</div>'; 
}else if($sotien < 10000){ 
echo '<div class="alert alert-warning">Giới Hạn Chuyển Tiền > 10000 VND</div>'; 
}elseif(md5($_POST['mk2']) != $getuser['mk2']){ 
echo '<div class="alert alert-warning">Mật khẩu cấp 2 sai rồi bạn ơi!</div>'; 
}elseif ($checkuser == 1) { 
mysqli_query($vtasystem, "UPDATE account SET `vnd` = `vnd` + '".$sotien."' WHERE username = '".$taikhoan."'"); 
mysqli_query($vtasystem, "UPDATE account SET `vnd` = `vnd` - '".$sotien."' WHERE id = '".$_SESSION['id']."'"); 
//up log người chuyển 
$timess = time(); 
$content1 = "<b>".$getuser['username']."</b> vừa chuyển tiền cho <b>$taikhoan</b>. Số tiền <b>" . number_format($sotien) . " VNĐ.</b> Nội dung : <b>".$noidung."!</b>"; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='GIAODICH',`content`='$content1',`time`='".$timess."'"); 

//up log người nhận 
$content2 = "<b>$taikhoan</b> vừa nhận tiền từ <b>".$getuser['username']."</b>. Số tiền <b>" . number_format($sotien) . " VNĐ.</b> Nội dung : <b>".$noidung."!</b>"; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$idnhan['id']."', `type`='GIAODICH',`content`='$content2',`time`='".$timess."'"); 


echo '<div class="alert alert-success">Chuyển tiền vào tài khoản <strong>'.$taikhoan.'</strong> thành công với số tiền <strong>'.$sotien.'</strong> !</div>'; 
}else{ 
echo '<div class="alert alert-warning">Tài khoản <strong>'.$taikhoan.'</strong> không có trên hệ thống !</div>'; 

} 
} 
?> 
<form action="" method="POST"> 
    <div class="form-group"> 
      <label for="usr">Tài khoản nhận tiền:</label> 
      <input type="text" class="form-control" name="username" placeholder="Tài khoản nhận tiền"> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Số tiền:</label> 
      <input type="number" class="form-control" name="sotien" placeholder="Số tiền muốn chuyển"> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Nội dung chuyển tiền:</label> 
        <textarea class="form-control" rows="3" name="noidung" id="noidung" placeholder="Nhập nội dung để gửi..."></textarea>     
    </div> 
    <div class="form-group"> 
      <label for="usr">Mật Khẩu Cấp 2:</label> 
      <input type="password" class="form-control" name="mk2" placeholder="Mật Khẩu Cấp 2"> 
    </div> 
    <button type="submit" name="chuyentien" class="btn btn-danger">Chuyển tiền</button> 
</form> 
      </div> 

    </div> 
  </div> 
<div class="col-lg-5"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Chú Thích</b> 
                        </div> 
<div class="panel-body"> 
<p>Giới hạn chuyển từ 20.000 trở lên.</p> 
<p>Khi chuyển tiền số tiền chuyển cho người khác sẽ bị trừ thẳng vào tài khoản của người chuyển</p> 
    </div> 
  </div> 
<?php 
} 
?> 