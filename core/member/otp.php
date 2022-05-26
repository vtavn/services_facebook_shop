<div class="col-lg-6"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Nhập mã bảo mật</h3> 
            </div> 
<div class="panel-body"> 
<?php 
if(isset($_POST['xacnhan'])){ 
$otp = trim($_POST['otp']); 
$check = mysqli_result(mysqli_query($vtasystem, "SELECT COUNT(*) FROM `account` WHERE `otp`='$otp'"),  0); 
if($otp != $getuser['otp']){ 
echo '<div class="alert alert-warning">Bạn nhập sai mã!</div>'; 
}else{                                        //up log 
           $timess = time(); 
           $timesss = date('d/m/Y - H:i:s', $timess); 
           $content = "<b>" .$getuser['username']. "</b> Đã đăng nhập hệ thống lúc ".$timesss.""; 
           $update_log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='OTP',`content`='$content',`time`='".$timess."'"); 

echo '<div class="alert alert-success">Xác Minh Thành Công</div>'; 
echo '<meta http-equiv=refresh content="1; URL=/index.php">'; 
} 
} 
?> 
<form action="" method="POST"> 
  <p>Chúng tôi đã gửi 1 mã đăng nhập vào gmail của bạn! Vui lòng check gmail hòm thư Spam để nhận mã đăng nhập</p> 
<div class="form-group"> 
  <label for="pwd">Nhập mã:</label> 
  <input type="text" class="form-control" name="otp" id="otp" placeholder="Nhập mã kích hoạt"> 
</div> 
  <button type="submit" name="xacnhan" class="btn btn-danger">OK</button> 

        </form>  
      </div> 
    </div> 
  </div> 

  <div class="col-lg-6"> 
          <div class="box box-success"> 
            <div class="box-header with-border"> 
              <h3 class="box-title"> Hướng Dẫn</h3> 
            </div> 
<div class="panel-body"> 
<strong>Phương thức bảo mật an toàn nhất hệ thống!</strong> 
</div> 
</div> 
</div> 