
<?php  
session_start(); 
if(!$_SESSION['user']){ 
?> 
<meta http-equiv=refresh content="0; URL=/index.php"> 
<script>alert("ĐĂNG NHẬP ĐI CHÁU :D"); </script> 

<?php 
}else{ 
?> 

<?php if(!$_GET[edit]){  ?> 
<meta http-equiv=refresh content="0; URL=/index.php"> 
<?php } ?> 

<?php if($_GET[edit]){  ?> 

<?php 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `vip_bot` WHERE `id` = '".$_GET[edit]."' LIMIT 1")); 
if($infouser['id_buy'] != $_SESSION['id']){ ?> 
<meta http-equiv=refresh content="0; URL=/index.php?vip=manager_vipbot"> 
<script>alert("Không phải ID Của bạn"); </script> 
<?php } ?> 


        <?php 
             
            $req = mysqli_query($vtasystem, "SELECT * FROM `vip_bot` WHERE `id` = '".$_GET[edit]."'"); 
            while($vtadz = mysqli_fetch_assoc($req)){ 
        ?> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b>Chỉnh Sửa Thông Tin ID VIP</b> 
                        </div> 
                   <div class="panel-body"> 
<form action="" method="POST"> 
                <div class="form-group"> 
                <label>Nhập Token:</label> 
                <input type="txt" class="form-control" name="token" id="token" oninput="update_name()" value="<?php echo strip_tags($vtadz['token']); ?>" required="" autofocus=""> 
                </div> 
             
                <div class="form-group"> 
                <label>Tên Người Dùng:</label>  
<input name="name" id="name" required="" type="text" class="form-control" value="<?php echo strip_tags($vtadz['name']); ?>" maxlength="30"> 
                </div> 
                <div class="form-group"> 
                <label>ID Người Dùng:</label> 
<input name="user_id" id="user_id" required="" type="text" value="<?php echo strip_tags($vtadz['idfb']); ?>"class="form-control" maxlength="30"> 
                </div> 
    <div class="form-group"> 
     <label for="usr">Loại Cảm Xúc:</label> 
        <select name="camxuc" id="camxuc" class="form-control"> 
            <option value="LIKE">LIKE</option> 
            <option value="LOVE"> LOVE - Yêu Thích</option> 
            <option value="WOW">  WOW - Ấn Tượng</option> 
            <option value="HAHA"> HAHA - Cười Lớn</option> 
            <option value="SAD">  SAD - Buồn Bã</option> 
            <option value="ANGRY"> ANGRY - Giận Dữ</option> 
            <option value="random"> RANDOM - Ngẫu Nhiên</option>      
        </select> 
    </div> 
    <div class="form-group"> 
     <label for="usr">Số Cảm Xúc/Phút:</label> 
        <select name="gioihan" id="gioihan" class="form-control"> 
              <option value="1">1 Cảm xúc</option> 
                        <option value="2">2 Cảm xúc</option> 
                        <option value="3">3 Cảm xúc</option> 
                        <option value="4">4 Cảm xúc</option> 
                        <option value="5">5 Cảm xúc</option> 
            </select> 
    </div> 
    <div class="form-group"> 
     <label for="usr">Status:</label> 
        <select name="status" id="status" class="form-control"> 
              <option value="0">Chạy</option> 
              <option value="1">Dừng</option> 
            </select> 
    </div> 
    <button type="submit" name="edit" class="btn btn-danger">Done!</button> 
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Thông Tin</button> 

</form> 

<?php if (isset($_POST['edit'])) { 
$times = $_POST['time']; 
$token = $_POST['token']; 
$name = $_POST['name']; 
$camxuc = $_POST['camxuc']; 
$gioihan = $_POST['gioihan']; 
$idfb = $_POST['user_id']; 
$namebuy = $getuser['username']; 
$idbuy = $getuser['id']; 
$status = $_POST['status']; 
$app = json_decode(file_get_contents("https://graph.facebook.com/app?access_token=".$token),true);   
    if(empty($app['id'])) 
        { 
            die('<script>alert("Lấy Lại Token"); </script>'); 
        } 
    $cookie = json_decode(file_get_contents("https://api.facebook.com/method/auth.getSessionforApp?access_token=".$token."&format=json&generate_session_cookies=1&new_app_id=".$app['id']),true); 
    $cookie = $cookie['session_cookies'][0]['name'].'='.$cookie['session_cookies'][0]['value'].' ; '.$cookie['session_cookies'][1]['name'].'='.$cookie['session_cookies'][1]['value'].' ;'; 
    $info = json_decode(file_get_contents("https://graph.facebook.com/me?fields=id,name&access_token=".$token),true); 
    $_SESSION['cookie'] = $cookie; 

mysqli_query($vtasystem, "UPDATE vip_bot SET  
    `idfb`='$idfb', 
    `name`='$name', 
    `token`='$token', 
    `camxuc`='$camxuc', 
    `gioihan`='$gioihan', 
    `status`='$status', 
    `cookie`='".$_SESSION['cookie']."' 
    WHERE `id` = '" . $_GET['edit'] . "'"); 

    //up log 
        $timess = time(); 
        $content = "<b>" .$getuser['username']. "</b> vừa cập nhập VIP BOT cho ID <b>$idfb</b>. Loại CX: <b>$camxuc</b>."; 
        mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='BOT',`content`='$content',`time`='".$timess."'"); 
    //show 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=manager_vipbot">'; 
die('<script>alert("Chỉnh Sửa Cập Nhật Tài Khoản Thành Công!"); </script>'); 
} ?> 
</div></div>   
<?php } ?> 
<?php } ?> 

</div> 
<?php } ?> 
    <script type="text/javascript"> 
        var VTA; 
        function update_name(){ 
            var TOKEN = $("#token").val(); 
            $.ajax({ 
                url: 'https://graph.facebook.com/me', 
                type: 'GET', 
                dataType: 'JSON', 
                data: { 
                    access_token: TOKEN 
                }, 
                success: (data) => { 
                    VTA = data; 
                    $("#name").fadeOut('slow', function(){ 
                        $("#name").val(data.name).fadeIn('slow'); 
                        $("#user_id").val(data.id).fadeIn('slow'); 

                    }); 
                    toastr.success('Lấy Thành Công!', 'Thông báo'); 
                    return; 
                }, 
                error: (data)=>{ 
                    toastr.error('Mã Access Token Không Hợp Lệ Hoặc Đã Chết!', 'Thông báo lỗi'); 
                    return; 
                } 
            }) 
        } 
    </script> 

