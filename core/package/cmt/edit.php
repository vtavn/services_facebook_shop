<?php
if($getuser['level'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">';
}else{
?>


<?php 
        $req = mysqli_query($vtasystem, "SELECT * FROM `package_vipcmt` WHERE `id` = '".$_GET[edit]."'"); 
        while($vtadz = mysqli_fetch_assoc($req)){ 
        ?> 
   
  <?php 
  if (isset($_POST['submit'])) { 
        $giatien = $_POST['giatien']; 
            $limitpost = $_POST['limitpost']; 
        $limitcmt = $_POST['limitcmt']; 
        $name = $_POST['name']; 
        mysqli_query($vtasystem, "UPDATE package_vipcmt SET `name` = '$name', `giatien` = '$giatien', `limit_post`= '$limitpost', `limit_cmt`= '$limitcmt' WHERE `id` = '".$_GET[edit]."'"); 
        echo "<script>alert('Thành công');window.location='/index.php?vip=list_package_cmt';</script>"; 
     
} 
?> 
 <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Chỉnh sửa packeage vip like</h3>
            </div><div class="panel-body">
<form action="" method="POST">
	<div class="form-group">
	  <label for="usr">Tên Hiển Thị: </label>
	  <input type="text" class="form-control" name="name" value="<?php echo $vtadz['name']; ?>">
	</div>
	<div class="form-group">
	  <label for="usr">Giá Tiền:</label>
	  <input type="number" class="form-control" name="giatien" value="<?php echo $vtadz['giatien']; ?>">
	</div>
	<div class="form-group">
	  <label for="usr">Limit Comments:</label>
	  <input type="number" class="form-control" name="limitcmt" value="<?php echo $vtadz['limit_cmt']; ?>">
	</div>
 	<div class="form-group">
	  <label for="usr">Limit Post: </label>
	  <input type="number" class="form-control" name="limitpost" value="<?php echo $vtadz['limit_post']; ?>">
	</div>

        <button type="submit" name="submit" class="btn btn-info ">Cập nhật</button>
	
	<button class="btn btn-success pull-right"><a href="/index.php?vip=list_package_cmt" style="color:white">Quay lại</a></button>
	
            </form>

</div></div>  
<?php } ?>
<?php } ?>

</div>