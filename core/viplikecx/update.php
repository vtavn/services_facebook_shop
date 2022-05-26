
<script src="giaodien/iCheck/icheck.min.js"></script> 
<link rel="stylesheet" href="giaodien/iCheck/all.css"> 
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
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `vip_like` WHERE `id` = '".$_GET[edit]."' LIMIT 1")); 
if($infouser[id_buy] != $_SESSION['id']){  
?> 
<meta http-equiv=refresh content="0; URL=/index.php"> 
<script>alert("Không phải ID Của bạn"); </script> 
<?php } 
        $req = mysqli_query($vtasystem, "SELECT * FROM `vip_like` WHERE `id` = '".$_GET[edit]."'"); 
        while($vtadz = mysqli_fetch_assoc($req)){ 
  if (isset($_POST['submit'])) { 
    $loi = array(); 
    if(!isset($_POST['camxuc'])){ 
        $loi['type'] = '<font color=red>Vui lòng chọn ít nhất 1 loại cảm xúc!</font>'; 
    } 
    if(empty($loi)){ 
                $loi = array(); 
        $camxuc = $_POST['camxuc']; 
            $id = $_POST['id']; 
        $idfb = $_POST['idfb']; 
        $chuthich  = $_POST['chuthich']; 
        $tocdo = $_POST['speed']; 
        $status = $_POST['status']; 
        $camxuc = ''; 
            if (isset($_POST['camxuc'])) { 
                foreach ($_POST['camxuc'] as $value) { 
                    $camxuc .= $value.'|'; 
                } 
                $camxuc = rtrim($camxuc, '|'); 
            }  
        $time = time(); //date("H:i:s d/m/Y") 
        $nameuser = $getuser['username']; 
        $content = "<b>$nameuser</b> vừa chỉnh sửa VIP Cảm Xúc cho ID <b>$idfb</b>. Loại CX: <b>$camxuc</b>. Tốc độ: <b>$tocdo</b>. Loại CX: <b>$camxuc</b>. Nội dung: <b>$chuthich</b>"; 
        mysqli_query($vtasystem, "UPDATE vip_like SET `fbid` = '$idfb', `name` = '$chuthich', `status` = '$status' , `camxuc` = '$camxuc',`speed`='$tocdo' WHERE `id` = '".$_GET[edit]."'"); 
        mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='LIKE',`content`='$content',`time`='".$time."'"); 
        echo "<meta http-equiv=refresh content='3; URL=index.php?vip=manager_viplikecx'>";         
        $loi["thanhcong"] = '<div class="alert alert-success alert-dismissible disabled" role="alert"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                    Success!Chỉnh sửa thành công. Hệ thống xử lý trong 3 Giây!. 
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
      <label for="usr">Số Thứ Tự Like</label> 
      <input type="number" class="form-control" id="id" name="id" value="<?php echo strip_tags($vtadz['id']); ?>" disabled> 
    </div> 
    <div class="form-group has-success"> 
      <label for="usr">ID Facebook:</label> 
      <input type="number" class="form-control" id="idfb" name="idfb" value="<?php echo strip_tags($vtadz['fbid']); ?>"> 
    </div> 
     
                     <div class="form-group has-success"> 
                    <label for="usr">Loại Cảm Xúc:</label><br> 
                    <label style="padding-right: 10px"><input type="checkbox" value="LIKE" name="camxuc[]" id="camxuc" checked class="flat-red"><img src="/giaodien/img/like.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="LOVE" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/love.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="HAHA" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/haha.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="WOW" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/wow.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="SAD" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/sad.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="ANGRY" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/angry.png" width="25" height="25"></label> 
                    </div> 

                <div class="form-group has-success"> 
                <label>Số Like Tăng Theo Phút</label> 
                    <label for="usr">Tốc Độ Lên Like: <b class="btn btn-success btn-simple btn-xs" id="show-speed">10</b></label> 
                    <input class="slider" data-slider-orientation="horizontal" 
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red" type="range" name="speed" id="speed" value="10" min="10" max="100" step="1" onchange="range()" oninput="update()"> 
                </div> 
    <div class="form-group has-success"> 
     <label for="usr">Quyền thực thi:</label> 
        <select id="status" name="status" class="form-control"> 
        <option value="checked">Chạy</option> 
        <option value="1">Dừng</option> 
        </select> 
    </div> 
    <div class="form-group has-success"> 
      <label for="usr">Chú Thích</label> 
        <textarea class="form-control" rows="3" id="chuthich" name="chuthich" placeholder="Khi chú để nhận biết"><?php echo htmlspecialchars($vtadz['name'], ENT_QUOTES, 'UTF-8'); ?></textarea> 
    </div> 
        <button type="submit" name="submit" class="btn btn-info ">Cập nhật</button> 
    <button class="btn btn-success pull-right"><a href="/index.php?vip=manager_viplikecx" style="color:white">Quay lại</a></button> 
     
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
     
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({ 
      checkboxClass: 'icheckbox_minimal-blue', 
      radioClass: 'iradio_minimal-blue' 
    }); 
    //Red color scheme for iCheck 
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({ 
      checkboxClass: 'icheckbox_minimal-red', 
      radioClass: 'iradio_minimal-red' 
    }); 
    //Flat red color scheme for iCheck 
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({ 
      checkboxClass: 'icheckbox_flat-green', 
      radioClass: 'iradio_flat-green' 
    }); 

    //Colorpicker 
    $(".my-colorpicker1").colorpicker(); 
    //color picker with addon 
    $(".my-colorpicker2").colorpicker(); 

    //Timepicker 
    $(".timepicker").timepicker({ 
      showInputs: false 
    }); 
</script> 
