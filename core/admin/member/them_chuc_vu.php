
<?php 
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
?> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Thêm Cộng Tác Viên - Đại Lý</b> 
                        </div> 
<div class="panel-body"> 
<?php  
if (isset($_POST['themchucvu'])) { 
$taikhoan = $_POST['username']; 
$sotien = intval($_POST['sotien']); 
$level = intval($_POST['level']); 
$users = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE username = '".$taikhoan."'")); 

    $sql = "SELECT * FROM account WHERE username = '".$taikhoan."' LIMIT 1";
    $result=mysqli_query($vtasystem, $sql);
    $checkuser = mysqli_num_rows($result);

    if ($checkuser == 0) { 
echo '<div class="alert alert-warning">Tài khoản <strong>'.$taikhoan.'</strong> không có trên hệ thống !</div>'; 
}else if($getuser['vnd'] < $sotien){ 
echo '<div class="alert alert-warning">Bạn KHông đủ tiền!</div>'; 
}else if($getuser['nguoitao'] == $getuser['id']){ 
echo '<div class="alert alert-danger">Tài Khoản Này Đã Là Cộng Tác Viên Của Bạn!</div>'; 

}else{ 
mysqli_query($vtasystem, "UPDATE account SET `vnd` = `vnd` + '".$sotien."' , `nguoitao` = '".$getuser['id']."', `level` = '".$level."' WHERE username = '".$taikhoan."'"); 
mysqli_query($vtasystem, "UPDATE account SET `vnd` = `vnd` - '".$sotien."', `ctv` = `ctv` + '1'  WHERE id = '".$_SESSION['id']."'"); 
$chucvu = array('Null', 'Admin', 'Đại Lý', 'Cộng Tác Viên', 'Member'); 
$getchuc =array_rand($chucvu,3); 
//up log 
$timess = time(); 
$content = "<b>" .$getuser['username']. "</b> vừa thêm USER <b>$taikhoan</b>. Làm <b>".$chucvu[$level]."</b> với số tiền <b>" . number_format($sotien) . " VNĐ </b>"; 

$update_log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='CHUCVU',`content`='$content',`time`='".$timess."'"); 
echo '<div class="alert alert-success">Đã thêm <strong>'.$taikhoan.'</strong> làm '.$chucvu[$level].'. Số Tiền <strong>'.$sotien.'</strong> !</div>'; 
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
                 <option selected="selected" value="2">Đại Lý</option> 
                 <option selected="selected" value="1">Admin</option> 
                 <option selected="selected" value="0">Member VIP</option> 

                </select> 
        </div> 
    <button type="submit" name="themchucvu" class="btn btn-danger">Thêm CTV</button> 
</form> 
      </div> 

    </div> 
  </div> 
<?php 
} 
include "../hethong/foot.php"; 
?>