
<?php  
session_start(); 
if(!$_SESSION['user']){ 
?> 
<meta http-equiv=refresh content="0; URL=/index.php"> 
<script>alert("ĐĂNG NHẬP ĐI CHÁU :D"); </script> 
<?php 
}else{ 
if(!$_GET[edit]){  ?> 
<meta http-equiv=refresh content="0; URL=/index.php"> 
<?php }  
 if($_GET[edit]){   
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `vip_cmt` WHERE `id` = '".$_GET[edit]."' LIMIT 1")); 
if($infouser[id_buy] != $_SESSION['id']){  
?> 
<meta http-equiv=refresh content="0; URL=/index.php"> 
<script>alert("Không phải ID Của bạn"); </script> 
<?php } 
        $req = mysqli_query($vtasystem, "SELECT * FROM `vip_cmt` WHERE `id` = '".$_GET[edit]."'"); 
        while($vtadz = mysqli_fetch_assoc($req)){ 
  if (isset($_POST['submit'])) { 
    if(empty($loi)){ 
        $loi = array(); 
        $camxuc = $_POST['camxuc']; 
        $id = $_POST['id']; 
        $idfb = $_POST['idfb']; 
        $chuthich  = $_POST['chuthich']; 
        $tocdo = $_POST['speed']; 
        $status = $_POST['status']; 
        $noidung = $_POST['noidung']; 
        $time = time(); //date("H:i:s d/m/Y") 
        $nameuser = $getuser['username']; 
        $content = "<b>$nameuser</b> vừa chỉnh sửa VIP CMT cho ID <b>$idfb</b>. Thay đổi nội dung. Tốc độ: <b>$tocdo</b> CMT/Phút. Chú thích : <b>$chuthich</b>"; 
        mysqli_query($vtasystem, "UPDATE vip_cmt SET `fbid` = '$idfb', `name` = '$chuthich', `status` = '$status' , `noidung` = '$noidung',`speed`='$tocdo' WHERE `id` = '".$_GET[edit]."'"); 
        mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='CMT',`content`='$content',`time`='".$time."'"); 
        echo "<meta http-equiv=refresh content='2; URL=index.php?vip=manager_vipcmt'>";         
        $loi["thanhcong"] = '<div class="alert alert-success alert-dismissible disabled" role="alert"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                    Success!Chỉnh sửa thành công. Hệ thống xử lý trong 2 Giây!. 
                  </div>'; 
    } 
} 
?> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b>Chỉnh Sửa Thông Tin ID VIP</b> 
                        </div> 
<div class="panel-body"> 
                            <?php echo isset($loi['thanhcong']) ? $loi['thanhcong'] : ''; ?> 
        <form action="" method="POST"> 
         
    <div class="form-group has-error"> 
      <label for="usr">Số Thứ Tự Cmt</label> 
      <input type="number" class="form-control" id="id" name="id" value="<?php echo strip_tags($vtadz['id']); ?>" disabled> 
    </div> 
    <div class="form-group has-success"> 
      <label for="usr">ID Facebook:</label> 
      <input type="number" class="form-control" id="idfb" name="idfb" value="<?php echo strip_tags($vtadz['fbid']); ?>"> 
    </div> 
     
                     <div class="form-group has-success"> 
                    <label for="usr">Nội Dung CMT:</label> 
                    <textarea class="form-control" id="noidung" name="noidung" rows="5" placeholder="Mỗi nội dung trên 1 dòng số cmt nên gấp 3 lần số cmt của gói để tránh trùng lặp. VD: #vtasystem {r-i}. Hệ Thống Vip {r-i}" required="" autofocus="" onchange="update()"><?php echo htmlspecialchars($vtadz['noidung'], ENT_QUOTES, 'UTF-8'); ?></textarea> 
                    </div>     

                <div class="form-group has-success"> 
                    <label for="usr">Tốc Độ Lên CMT: (Càng nhỏ càng thật) <b class="btn btn-success btn-simple btn-xs" id="show-speed">1</b></label> 
                    <input data-slider-orientation="horizontal" 
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red" type="range" name="speed" id="speed" value="1" min="1" max="20" step="1" onchange="range()" oninput="update()"> 
                </div> 
    <div class="form-group has-success"> 
     <label for="usr">Quyền thực thi:</label> 
        <select id="status" name="status" class="form-control"> 
        <option value="0">Chạy</option> 
        <option value="1">Dừng</option> 
        </select> 
    </div> 
    <div class="form-group has-success"> 
      <label for="usr">Chú Thích</label> 
        <textarea class="form-control" rows="3" id="chuthich" name="chuthich" placeholder="Khi chú để nhận biết"><?php echo htmlspecialchars($vtadz['name'], ENT_QUOTES, 'UTF-8'); ?></textarea> 
    </div> 
        <button type="submit" name="submit" class="btn btn-info ">Cập nhật</button> 
    <button class="btn btn-success pull-right"><a href="/index.php?vip=manager_vipcmt" style="color:white">Quay lại</a></button> 
     
            </form> 

</div></div>   
<?php } ?> 
<?php } ?> 
<?php } ?> 
</div> 

<script> 
    function range(){ 
        $("#show-speed").text($("#speed").val()); 
    } 
</script> 
