
<?php  
session_start(); 
$thongtin = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id` = '" . $_SESSION['id'] . "' LIMIT 1")); 
if(!$_SESSION['id']) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
die('<script>alert("Vui Lòng Đăng Nhập!"); </script>'); 
} 
if(isset($_POST['submit'])) 
{ 
$loi = array(); 
    if(md5($_POST['passwd']) != $getuser['password']){ 
        $loi['pass'] = '<div class="alert alert-warning">Mật Khẩu Cũ Không Đúng</div>'; 
    } 
if($_POST['pass1'] != $_POST['pass2']){ 
        $loi['pass'] = '<div class="alert alert-warning">Mật khẩu mới không Trùng Nhau.</div>'; 
    } 
if(empty($loi)){ 
       $pass1 = $_POST['pass1']; 
        $pass2 = $_POST['pass2']; 
        $pass = md5($pass1); 
mysqli_query($vtasystem, "UPDATE account SET `password` = '".$pass."' WHERE `id` = '".$_SESSION['user']."'"); 
//up log 
$timess = time(); 
$content = "<b>".$_SESSION['username']."</b> vừa đổi mật khẩu cho mình!"; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='EDIT',`content`='$content',`time`='".$timess."'"); 
$loi['pass'] = '<div class="alert alert-success">Đổi Mật Khẩu Thành Công Vui Lòng Đăng Nhập Lại Bằng Mật Khẩu Vừa Đổi !!</div>'; 

}     
  }  
?> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Đổi Mật Khẩu Mới</b> 
                        </div> 
<div class="panel-body"> 
<form action="" method="POST"> 
<center> 
<?php echo isset($loi['pass']) ? $loi['pass'] : ''; ?></center> 
                                <div class="form-group"> 
            <label for="pwd">Mật Khẩu Cũ: 
            </label> 
            <input type="password" class="form-control" name="passwd" required> 
          </div> 
<div class="form-group"> 
            <label for="pwd">Password Mới: 
            </label> 
            <input type="password" class="form-control" name="pass1" required> 
          </div> 

         <div class="form-group"> 
            <label for="pwd">Nhập Lại Password Mới: 
            </label> 
            <input type="password" class="form-control" name="pass2" required> 
          </div> 

          
          
<input type="submit" class="btn btn-info pull-right wow bounceIn" name="submit" value="Đổi mật khẩu"> 
              </div> 
              <!-- /.box-footer --> 
            </form> 
          </div> 
</div> 