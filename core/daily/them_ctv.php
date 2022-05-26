
<?php 
if($getuser['level'] > 2) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
?> 
<div class="col-lg-7"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Thêm Cộng Tác Viên</b> 
                        </div> 
<div class="panel-body"> 
<?php  
if (isset($_POST[chuyentien])) { 
$taikhoan = $_POST[username]; 
$sotien = intval($_POST[sotien]); 
$level = intval($_POST[level]); 
$users = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE username = '".$taikhoan."'")); 

$checkuser = mysqli_result(mysqli_query($vtasystem, "SELECT COUNT(*) FROM account WHERE username = '".$taikhoan."' LIMIT 1"),  0); 
if (1 > $checkuser) { 
echo '<div class="alert alert-warning">Tài khoản <strong>'.$taikhoan.'</strong> không có trên hệ thống !</div>'; 
}else if($getuser['vnd'] < $sotien){ 
echo '<div class="alert alert-warning">Bạn KHông đủ tiền!</div>'; 
}else if(($level < 3) || ($level > 3)){ 
echo '<div class="alert alert-danger">Định Bug À! Đã báo cho admin. Chờ ăn block tài khoản đi nhé!</div>'; 

}else if($getuser['nguoitao'] == $getuser['id']){ 
echo '<div class="alert alert-danger">Tài Khoản Này Đã Là Cộng Tác Viên Của Bạn!</div>'; 

}else{ 
mysqli_query($vtasystem, "UPDATE account SET `vnd` = `vnd` + '".$sotien."' , `nguoitao` = '".$getuser['id']."', `level` = '".$level."' WHERE username = '".$taikhoan."'"); 
mysqli_query($vtasystem, "UPDATE account SET `vnd` = `vnd` - '".$sotien."' WHERE id = '".$_SESSION['id']."'"); 

//up log 
$timess = time(); 
$content = "<b>" .$getuser['username']. "</b> vừa thêm USER <b>$taikhoan</b>. Làm <b>Cộng Tác Viên</b> với số tiền <b>" . number_format($sotien) . " VNĐ </b>"; 

$update_log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='CHUCVU',`content`='$content',`time`='".$timess."'"); 
echo '<div class="alert alert-success">Đã thêm <strong>'.$taikhoan.'</strong> làm Cộng Tác Viên. Số Tiền <strong>'.$sotien.'</strong> !</div>'; 
} 
} 
?> 
<form action="" method="POST"> 
    <div class="form-group"> 
      <label for="usr">Tài khoản:</label> 
      <input type="text" class="form-control" name="username" placeholder="Tài khoản nhận tiền"> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Số tiền:</label> 
      <input type="number" class="form-control" name="sotien" placeholder="Số tiền muốn chuyển"> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Chức vụ:</label> 
        <select id="level" name="level" class="form-control"> 
                 <option selected="selected" value="3">Cộng Tác Viên</option> 
                </select> 
        </div> 
    <button type="submit" name="chuyentien" class="btn btn-danger">Thêm CTV</button> 
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
<p>Đây là chức năng thêm cộng tác viên của đại lý.</p> 
<p>Khi đại lý thêm cộng tác viên số tiền chuyển cho ctv sẽ bị trừ thẳng vào tài khoản của đại lý và đại lý có quyền kiểm soát tài khoản cộng tác viên đó</p> 
    </div> 
  </div> 
<?php 
} 
?> 