<?php 
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
?> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
<b><i class="fa fa-tint text-green"></i> Tuỳ chọn tuỳ chỉnh</b> 
                        </div> 
<div class="panel-body"> 

<?php 
if (isset($_POST['chinhsua'])) { 
$title = $_POST['title']; 
$logo = $_POST['logo']; 
$theme = $_POST['theme']; 
$status = $_POST['status']; 
$keycron = $_POST['key']; 
$nguyennhan = $_POST['nguyennhan']; 
$khuyenmai = $_POST['khuyenmai']; 
mysqli_query($vtasystem, "UPDATE setting_ht SET title = '$title', logo = '$logo', giaodien = '$theme', trangthai = '0', nguyennhan = '$nguyennhan', keycron = '$keycron' WHERE id = '1'"); 
echo '<div class="alert alert-success">Chỉnh sửa cài đặt thành công!!</div>'; 
} 
?> 
<form action="" method="POST"> 
<div class="form-group"> 
                    <label for="name">Website tên :</label> 
                    <input type="hidden" class="form-control" name="title" id="title" value=""> 
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $getsetting['title'];?>"> 
                </div> 
<div class="form-group"> 
                    <label for="name">Logo :</label> 
                    <input type="hidden" class="form-control" name="logo" id="logo" value=""> 
                    <input type="text" class="form-control" name="logo" id="logo" value="<?php echo $getsetting['logo'];?>"> 
                </div> 
<div class="form-group"> 
                    <label>Chủ đề :</label> 
                    <select class="form-control" name="theme"> 
                        <option value="blue">Blue - Dark</option> 
                        <option value="blue-light" selected="">Blue - Light</option> 
                        <option value="green">Green - Dark</option> 
                        <option value="green-light">Green - Light</option> 
                        <option value="red">Red - Dark</option> 
                        <option value="red-light">Red - Light</option> 
                        <option value="yellow">Yellow - Dark</option> 
                        <option value="yellow-light">Yellow - Light</option> 
                        <option value="purple">Purple - Dark</option> 
                        <option value="purple-light">Purple - Light</option> 
                    </select> 
                </div> 
<div class="form-group"> 
                    <label for="name">Key Cron : </label> (Admin cung cấp.) 
                    <input type="hidden" class="form-control" name="key" id="key" value=""> 
                    <input type="text" class="form-control" name="key" id="key" value="<?php echo $getsetting['keycron'];?>"> 
                </div> 
<div class="form-group"> 
                    <label for="name">Khuyến Mãi :</label> (Tính bằng %.) 
                    <input type="hidden" class="form-control" name="khuyenmai" id="khuyenmai" value=""> 
                    <input type="text" class="form-control" name="khuyenmai" id="khuyenmai" value="<?php echo $getsetting['khuyenmai'];?>"> 
                </div> 
<!--div class="form-group"> 
                    <label for="status">Trạng thái</label> 
                    <input type="radio" name="abc" value="1" checked> Mở Cửa.  <input type="radio" name="abc" value="0">Đóng Cửa!</p> 
                </div--> 
<div class="form-group"> 
                    <label for="name">Thông báo: </label> 
                    <input type="hidden" class="form-control" name="token" id="token" value=""> 
                    <textarea class="form-control" id="nguyennhan" name="nguyennhan" rows="5" placeholder="Nội dung cmt..." required="" autofocus=""><?php echo $getsetting['nguyennhan']; ?></textarea> 
                </div>  
  <button type="submit" name="chinhsua" class="btn btn-danger btn-block">Chỉnh Sửa</button> 
</form> 
<br/> 
        <div class="card-footer small text-muted">Chức năng chỉ dành cho Admin</div> 
      </div> 

      </div> 
       
<?php } ?> 