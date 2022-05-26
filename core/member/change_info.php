
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
if(empty($loi)){ 
             $name = $_POST['name']; 
        $sdt = $_POST['sdt']; 
        $idfb =  $_POST['idfb']; 
mysqli_query($vtasystem, "UPDATE account SET `fullname` = '".$name."', `sdt` = '".$sdt."', `idfb` = '".$idfb."' WHERE `id` = '".$_SESSION['user']."'"); 
                                       //up log 
                   $times = time(); 
                   $content = "<b>".$getuser['username']."</b> vừa cập nhật thông tin tài khoản cho mình!"; 
                                $update_log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='LIKE',`content`='$content',`time`='".$times."'"); 
$loi['pass'] = '<div class="alert alert-success">Cập nhật thông tin.</div>'; 

}     
  }  
?> 
<div class="col-lg-7"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Cập nhật thông tin</b> 
                        </div> 
<div class="panel-body"> 
<form action="" method="POST"> 
<center> 
<?php echo isset($loi['pass']) ? $loi['pass'] : ''; ?></center> 
                                <div class="form-group"> 
            <label for="pwd">Tài khoản: 
            </label> 
            <input type="text" minlength="4" class="form-control" value="<?php echo $getuser[username];?>" disabled="">           
            </div> 
<div class="form-group"> 
            <label for="pwd">Email: 
            </label> 
            <input type="text" minlength="4" class="form-control" value="<?php echo $getuser[mail];?>" disabled="">           
          </div> 

         <div class="form-group"> 
            <label for="pwd">Họ tên: 
            </label> 
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $getuser[fullname];?>" placeholder="Họ và tên" required> 
          </div> 
         <div class="form-group"> 
            <label for="pwd">SDT: 
            </label> 
            <input type="number" class="form-control" name="sdt" id="sdt" value="<?php echo $getuser[sdt];?>" placeholder="Số điện thoại của bạn" required> 
          </div> 
         <div class="form-group"> 
            <label for="pwd">ID FACEBOOK: 
            </label> 
            <input type="number" class="form-control" name="idfb" id="idfb" value="<?php echo $getuser[idfb];?>" placeholder="ID facebook của bạn" required> 
          </div> 
         
<input type="submit" class="btn btn-info pull-right wow bounceIn" name="submit" value="Đổi thông tin"> 
              </div> 
              <!-- /.box-footer --> 
            </form> 
          </div> 
</div> 
<div class="col-lg-5"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Chú Thích</b> 
                        </div> 
<div class="panel-body"> 
<div class="alert alert-warning alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                <h4><i class="icon fa fa-warning"></i> Alert!</h4> 
                Vui lòng cập nhập đúng info của mình đặc biệt là thông tin facebook. Hệ thống sẽ auto xóa những tài khoản không cập nhập info. 
              </div> 
    </div> 
  </div> 