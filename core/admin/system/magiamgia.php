
<?php 
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
?> 

 <?php 
  if (isset($_POST['submit'])) { 
        $magiamgia = $_POST['code']; 
        $giamgia = $_POST['giamgia']; 
        $nguoinhan = $_POST['username']; 
        mysqli_query($vtasystem, "INSERT INTO `coupon_ht` SET `username` = '".$nguoinhan."', `code`='".$magiamgia."', `giam`='".$giamgia."'"); 
    $timess = time(); 
    $content = "<b>" .$getuser['username']. "</b> vừa tạo mã coupon <b>$magiamgia</b> giảm <b>$giamgia %</b> cho <b>$nguoinhan</b>"; 
    mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='COUPON',`content`='$content',`time`='".$timess."'"); 
        echo "<script>alert('Thành công');window.location='/index.php?vip=them_coupon';</script>"; 
     
} 
?> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Thêm Coupon Giảm giá</b> 
                        </div> 
<div class="panel-body"> 
<form action="" method="POST"> 
    <div class="form-group"> 
      <label for="usr">Người Hưởng :</label> (nhập người được dùng) 
      <input type="text" class="form-control" name="username" value=""> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Giảm :</label> (nhập % giảm) 
      <input type="number" class="form-control" name="giamgia" value=""> 
    </div> 
    <div class="form-group"> 
      <label for="usr">Mã Giảm Giá:</label> (mã để khách hàng nhập) 
      <input type="text" class="form-control" name="code"> 
    </div> 
        <button type="submit" name="submit" class="btn btn-info">Thêm</button> 

            </form> 

</div></div>   
</div> 
<div class="col-md-12"> 
          <div class="box box-success"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Danh sách coupon</h3> 
            </div> 
                    <div class="panel-body"> 

<div class="table-responsive"> 
        <table id="example2" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>ID</th> 
              <th>Người Hưởng</th> 
              <th>Code</th> 
              <th>Giảm giá</th> 
              <th>Hành Động</th> 
            </tr> 
          </thead> 
          <tbody> 
            <?php 
            $req = mysqli_query($vtasystem, "SELECT * FROM `coupon_ht`"); 
            while($res = mysqli_fetch_assoc($req)){ 
            ?> 
            <tr> 
              <td> 
                <?php echo $res['id']; ?> 
              </td> 
              <td> 
                <?php echo $res['username']; ?> 
              </td> 
              <td> 
                <?php echo $res['code']; ?></b> 
              </td> 
              <td> 
                <?php echo $res['giam']; ?> % 
              </td> 
              <td> 
                <a title="Xóa" class="btn btn-xs btn-danger" href="/index.php?vip=them_coupon&xoa=<?php echo $res['id']; ?>"><b> Xóa</b></a>    
              </td> 
            </tr> 
            <?php } ?> 
          </tbody> 
        </table>    
      </div> 
   </div> 
     </div> 
   </div> 
<?php  
if($_GET['xoa']){ 
mysqli_query($vtasystem, "DELETE FROM `coupon_ht` WHERE id ='" .$_GET['xoa'] . "'"); 
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=them_coupon'>"; 
            die("<script>alert('Xóa thành công'); </script>"); 
exit; 
} 

} ?> 