
<?php 
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
?> 

<?php 
        $req = mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id` = '".$_GET[edit]."'"); 
        while($vtadz = mysqli_fetch_assoc($req)){ 
        ?> 
   
  <?php 
  if (isset($_POST['submit'])) { 
        $tien = $_POST['tien']; 
            $toida = $_POST['toida']; 
        $kichhoat = $_POST['kichhoat']; 
        $level = $_POST['level']; 
        $name = $_POST['name']; 
        $username = $_POST['username']; 
        mysqli_query($vtasystem, "UPDATE account SET `toida` = `toida` + '$toida', `vnd` = `vnd` + '$tien', `kichhoat`= '$kichhoat', `level`= '$level', `fullname`= '$name', `username`= '$username' WHERE `id` = '".$_GET[edit]."'"); 
                //up log 
        $timess = time(); 
        $content = "<b>" .$getuser['username']. "</b> vừa chỉnh sửa tài khoản <b>$username</b>. Thêm số tiền <b>" . number_format($tien) . " VNĐ </b>"; 
        mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='EDIT',`content`='$content',`time`='".$timess."'"); 

        echo "<script>alert('Thành công');window.location='/index.php?vip=tai_khoan_hethong';</script>"; 
     
} 
?> 
 <div class="col-md-12"> 
          <div class="box box-success"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Chỉnh sửa tài khoản thành viên</h3> 
            </div><div class="panel-body"> 
<form action="" method="POST"> 
    <div class="form-group"> 
      <label for="usr">Tên Hiển Thị: </label> 
      <input type="text" class="form-control" name="name" value="<?php echo $vtadz['fullname']; ?>"> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Username: </label> 
      <input type="text" class="form-control" name="username" value="<?php echo $vtadz['username']; ?>"> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Số Tiền Muốn Cộng: <code>Đang có : <?php echo number_format($vtadz['vnd']); ?> VNĐ</code></label> 
      <input type="number" class="form-control" name="tien" value=""> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Số ID muốn cộng: <code>Đang có : <?php echo number_format($vtadz['toida']); ?> ID</code></label> 
      <input type="number" class="form-control" name="toida"> 
    </div> 
                <div class="form-group has-success"> 
                <label>Chức Vụ</label> 
                <select name="level" id="level" class="form-control"> 
                                        <option value="3">Cộng Tác Viên</option> 
                                        <option value="2">Đại lý</option> 
                    <option value="1">Admin</option> 
                    <option value="0">Khách</option> 
                </select> 
                </div> 
                <div class="form-group has-success"> 
                <label>Kích Hoạt</label> 
                <select name="kichhoat" id="kichhoat" class="form-control"> 
                    <option value="1">Kích Hoạt</option> 
                    <option value="0">Khóa Tài Khoản</option> 
                </select> 
                </div> 

        <button type="submit" name="submit" class="btn btn-info ">Cập nhật</button> 
     
    <button class="btn btn-success pull-right"><a href="/index.php?vip=tai_khoan_hethong" style="color:white">Quay lại</a></button> 
     
            </form> 

</div></div>   
<?php } ?> 
<?php } ?> 

</div> 
