<div class="col-lg-6"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Kích Hoạt Tài Khoản</h3> 
            </div> 
<div class="panel-body"> 
<?php 
if(isset($_POST['xacnhan'])){ 
$macode = $_POST['macode']; 
if($macode != $getuser['macode']){ 
echo '<div class="alert alert-warning">Bạn nhập sai mã!</div>'; 
}else{ 
  mysqli_query($vtasystem, "UPDATE account SET kichhoat='1' WHERE macode='$macode'"); 
    //up log 
  $timess = time(); 
  $content = "<b>" .$getuser['username']. "</b> Đã kích hoạt hệ thống và được tặng 1000VNĐ trong tài khoản."; 
  $update_log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='REG',`content`='$content',`time`='".$timess."'"); 

echo '<div class="alert alert-success">Kích Hoạt Thành Công. Hệ thống sử lý 2 giây...</div>'; 
echo '<meta http-equiv=refresh content="2; URL=/index.php">'; 
} 
} 
?>  
<form action="" method="POST"> 
<div class="form-group"> 
<p>Nếu bạn không thấy mã vui lòng vào email đã đăng kí để lấy mã.</p> 
  <label for="pwd">MÃ XÁC NHẬN:</label> 
  <textarea class="form-control" rows="1" placeholder="Enter ..."><?php echo $getuser['macode'];?></textarea>
</div> 
<div class="form-group"> 
  <label for="pwd">Nhập mã phía trên vào:</label> 
  <input type="text" class="form-control" name="macode" id="macode" placeholder="Nhập mã kích hoạt"> 
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
<strong>Các bước thực hiện :</strong> 
<ol> 
<li>Coppy dòng mã trong khung MÃ XÁC NHẬN.</li> 
<li>Dán dòng mã vừa coppy trên vào khung nhập mã.</li> 
<li>Click OK. Vậy là đã kích hoạt thành công</li> 
</ol> 
<strong>Tài khoản lập sau 1 tiếng mà không kích hoạt hệ thống tự động xóa tài khoản!</strong> 
</div> 
</div> 
</div> 