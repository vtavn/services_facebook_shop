<?php
if($getuser['level'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">';
}else{
?>

 <?php 
  if (isset($_POST['submit'])) { 
        $giatien = $_POST['vnd']; 
            $limitcmt = $_POST['limitcmt']; 
        $limitpost = $_POST['limitpost']; 
        $name = $_POST['name']; 
            mysqli_query($vtasystem, "INSERT INTO `package_vipcmt` SET `name` = '".$name."', `giatien`='".$giatien."', `limit_cmt`='".$limitcmt."', `limit_post` = '".$limitpost."'"); 
            echo "<script>alert('Thành công');window.location='/index.php?vip=add_package_cmt';</script>"; 
     
} 
?> 
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i> Thêm Package VIP LIKE</b>
                        </div>
<div class="panel-body">
<form action="" method="POST">
	<div class="form-group">
	  <label for="usr">Tên: </label>
	  <input type="text" class="form-control" name="name" value="">
	</div>
	<div class="form-group">
	  <label for="usr">Limit Cmt:</label>
	  <input type="number" class="form-control" name="limitcmt" value="">
	</div>
	<div class="form-group">
	  <label for="usr">Limit Post:</label>
	  <input type="number" class="form-control" name="limitpost">
	</div>
	<div class="form-group">
	  <label for="usr">Giá Tiền/Tháng:</label>
	  <input type="number" class="form-control" name="vnd">
	</div>
        <button type="submit" name="submit" class="btn btn-info">Thêm</button>

            </form>

</div></div>  

<?php } ?>

</div>