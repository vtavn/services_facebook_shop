
<?php 
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 

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
        $thoigian = $_POST['time']; 
        $status = $_POST['status']; 
        $camxuc = $_POST['camxuc']; 
        $time = time(); //date("H:i:s d/m/Y") 
        $nameuser = $getuser['username']; 
        $content = "<b>$nameuser</b> vừa chỉnh sửa VIP Cảm Xúc cho ID <b>$idfb</b>. Loại CX: <b>$camxuc</b>. Tốc độ: <b>$tocdo</b>. Loại CX: <b>$camxuc</b>. Nội dung: <b>$chuthich</b>"; 
        mysqli_query($vtasystem, "UPDATE vip_like SET `fbid` = '$idfb', `name` = '$chuthich', `status` = '$status' , `camxuc` = '$camxuc',`speed`='$tocdo', `limit_time` = `limit_time` + '$thoigian' WHERE `id` = '".$_GET[edit]."'"); 
        mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='LIKE',`content`='$content',`time`='".$time."'"); 
        echo "<meta http-equiv=refresh content='3; URL=index.php?vip=list_id_vip_camxuc'>";         
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
                    <label name="camxuc" id="camxuc" class="radio-inline"><input type="radio" value="LIKE" name="camxuc" id="camxuc" checked><img src="/giaodien/img/like.png" width="30" height="30"></label> 
                    <label name="camxuc" id="camxuc" class="radio-inline"><input type="radio" value="LOVE" name="camxuc" id="camxuc"><img src="/giaodien/img/love.png" width="30" height="30"></label> 
                    <label name="camxuc" id="camxuc" class="radio-inline"><input type="radio" value="HAHA" name="camxuc" id="camxuc"><img src="/giaodien/img/haha.png" width="30" height="30"></label> 
                    <label name="camxuc" id="camxuc" class="radio-inline"><input type="radio" value="WOW" name="camxuc" id="camxuc"><img src="/giaodien/img/wow.png" width="30" height="30"></label> 
                    <label name="camxuc" id="camxuc" class="radio-inline"><input type="radio" value="SAD" name="camxuc" id="camxuc"><img src="/giaodien/img/sad.png" width="30" height="30"></label> 
                    <label name="camxuc" id="camxuc" class="radio-inline"><input type="radio" value="ANGRY" name="camxuc" id="camxuc"><img src="/giaodien/img/angry.png" width="30" height="30"></label> 
                    <label name="camxuc" id="camxuc" class="radio-inline"><input type="radio" value="random" name="camxuc" id="camxuc"><img src="/giaodien/img/ngaunhien.gif" width="30" height="30"></label> 
                    </div> 
                <div class="form-group"> 
                    <label for="usr">Thêm Thời gian:</label> 
                    <select name="time" id="time" class="form-control"> 
                        <option value="0">Không</option> 
                        <option value="1">1 Tháng</option> 
                        <option value="2">2 Tháng</option> 
                    </select> 
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
        <option value="0">Chạy</option> 
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
</div> 

<script> 
    function range(){ 
        $("#show-speed").text($("#speed").val()); 
    } 
</script> 
