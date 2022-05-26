<?php
if($getuser['level'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">';
}else{
?>

<?php 
  if (isset($_POST['submit'])) { 
        $giatien = $_POST['vnd']; 
            $limitlike = $_POST['limitlike']; 
        $limitpost = $_POST['limitpost']; 
        $name = $_POST['name']; 
                mysqli_query($vtasystem, "INSERT INTO `package_vip` SET `name` = '".$name."', `giatien`='".$giatien."', `limit_like`='".$limitlike."', `limit_post` = '".$limitpost."'"); 
        echo "<script>alert('Thành công');window.location='/index.php?vip=add_package_like';</script>"; 
     
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
	  <label for="usr">Limit Like:</label>
	  <input type="number" class="form-control" name="limitlike" value="">
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