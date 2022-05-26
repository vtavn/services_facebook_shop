<?php 
if($getuser['kichhoat'] <  1) {  
echo'Không được phép hì'; 
             } else { 
?> 
<?php 
$vndbot = '0'; 
if(isset($_POST['submit'])){ 
$times = $_POST['time']; 
$token = $_POST['token']; 
$name = $_POST['name']; 
$noidung = $_POST['noidung']; 
$gioihan = $_POST['gioihan']; 
$idfb = $_POST['user_id']; 
$idsticker = $_POST['idsticker']; 
$app = json_decode(file_get_contents("https://graph.facebook.com/app?access_token=".$token),true);   
    if(empty($app['id'])) 
        { 
            echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_sticker">'; 
            die('<script>alert("Lấy Lại Token"); </script>'); 
        } 
    $cookie = json_decode(file_get_contents("https://api.facebook.com/method/auth.getSessionforApp?access_token=".$token."&format=json&generate_session_cookies=1&new_app_id=".$app['id']),true); 
    $cookie = $cookie['session_cookies'][0]['name'].'='.$cookie['session_cookies'][0]['value'].' ; '.$cookie['session_cookies'][1]['name'].'='.$cookie['session_cookies'][1]['value'].' ;'; 
    $info = json_decode(file_get_contents("https://graph.facebook.com/me?fields=id,name&access_token=".$token),true); 
    $_SESSION['cookie'] = $cookie; 

if ($vnd < 0){ 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_sticker">'; 
die('<script>alert("HẾT XIỀN"); </script>'); 
} 
if ($user['vnd'] < 0){ 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_sticker">'; 
die('<script>alert("Làm gì Còn Tiền mà Mua Đâu!"); </script>'); 
} 
if ($times == 30){ 
$vnd = '30000'; 
} elseif ($times < 0) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_sticker">'; 
die('<script>alert("Không bug được đâu nhé! Gian lận không tốt đâu!");</script>'); 
} else { 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_sticker">'; 
die('<script>alert("Không bug được đâu nhé! Gian lận không tốt đâu!");</script>'); 
} 
        $checkvips = "SELECT * FROM `vip_bot_sticker` WHERE `idfb`= '$idfb' LIMIT 1";
        $result=mysqli_query($vtasystem, $checkvips);
        $checkvip = mysqli_num_rows($result);
        
if($getuser['vnd'] < $vnd){ 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vtasystem=Add_VIP_Reaction">'; 
die('<script>alert("Bạn không đủ tiền!");</script>'); 
} elseif ($checkvip == 0) {     
mysqli_query($vtasystem, "UPDATE `account` SET `vnd`=`vnd`-'".intval($vnd)."' WHERE `id`=".$getuser['id'].""); 
$timecx = time() + $times * 24 * 3600; 
mysqli_query($vtasystem, "INSERT INTO `vip_bot_sticker` SET `idfb`='$idfb', `name`='$name', `token`='$token', `noidung`='$noidung', `name_buy`='".$getuser['username']."', `id_buy`='".$getuser['id']."', `time`='$timecx',`gioihan`='$gioihan', `status`='0', `idsticker`='$idsticker', `cookie`='".$_SESSION['cookie']."', `solanchay`='0'");

    //up log 
        $timess = time(); 
        $content = "<b>" .$getuser['username']. "</b> vừa thêm VIP BOT STICKER cho ID <b>$idfb</b>. Thời hạn <b>1</b> tháng, Loại CX: <b>$camxuc</b>, tổng thanh toán <b>" . number_format($vndbot) . " VNĐ </b>"; 
        mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='BOT',`content`='$content',`time`='".$timess."'"); 
    //show 
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_sticker">'; 
die('<script>alert("Thêm ID VIP BOT Cảm Xúc Thành công!");</script>'); 
}else{ 
echo '<div class="alert alert-danger">Tài Khoản Này Đã Cài Trên Hệ Thống</div>'; 
} 
} 

?> 
<div class="col-lg-6"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Cài Đặt Bot CMT Sticker Pro</b> 
                        </div> 
                    <div class="panel-body"> 
        <form action="" method="POST"> 

                <div class="form-group"> 
                <label>Nhập Token:</label> 
                <input type="txt" class="form-control" name="token" id="token" oninput="update_name()" required="" autofocus=""> 
                </div> 
             
                <div class="form-group"> 
                <label>Tên Người Dùng:</label> 
                <input name="name" id="name" required="" value="" type="text" class="form-control"> 
                *Không Thay Đổi Nội Dung 
                </div> 
                <div class="form-group"> 
                <label>ID Người Dùng:</label> 
                <input name="user_id" id="user_id" required="" value="" type="text" class="form-control"> 
                *Không Thay Đổi Nội Dung 
                </div> 
                <div class="form-group"> 
                <label>Nội Dung Comments:</label> 
                <textarea class="form-control" id="noidung" name="noidung" rows="5" placeholder="Mỗi nội dung trên 1 dòng số cmt nên gấp 3 lần số cmt của gói để tránh trùng lặp." required="" autofocus="" onchange="update()"></textarea>
                </div> 

                <div class="form-group"> 
                <label>ID STICKER:</label> 
                <select name="idsticker" class="form-control"> 
                    <option value="1435018730122417">Mát Xa</option> 
                        <option value="213723112110247">Nhắm Mắt</option> 
                        <option value="1775288509378520">Hôn Gió</option> 
                </select> 
                </div> 
                                <div class="form-group"> 
                <label>Số Cmt/5Phút:</label> 
                <select name="gioihan" class="form-control"> 
                    <option value="1">1 Cmt</option> 
                        <option value="2">2 Cmt</option> 
                        <option value="3">3 Cmt</option> 
                        <option value="4">4 Cmt</option> 
                        <option value="5">5 Cmt</option> 
                </select> 
                </div> 
                <div class="form-group"> 
                <label>Thời Hạn:</label> 
                    <select name="time" id="time" class="form-control"> 
                        <option value="30">1 Tháng</option> 
                    </select> 
                </div> 

                <div class="form-group"> 
        <label>Số Tiền Cần Thanh Toán Là: <?php echo number_format($vndbot);?> VNĐ</label> 
                 </div>  
      
               <div class="form-group"> 
            <button type="submit" name="submit" class="btn btn-danger">Cài BOT</button> 
                           </div> 

        </form> 
  
      </div> 
    </div> 
  </div> 

  <div class="col-lg-6"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> GET TOKEN</b> 
                        </div> 
                    <div class="panel-body"> 
                        <center><b>HƯỚNG DẪN GET TOKEN BẰNG ĐIỆN THOẠI HOẶC MÁY TÍNH</b><br> 
                            <a href="/index.php?vip=Get_Token" target="_blank" class="btn btn-block btn-success">GET TOKEN NHANH</a> 
                        </center><br> 
                        <center><b>HƯỚNG DẪN GET TOKEN BẰNG MÁY TÍNH CÁCH 2</b></center> 
<p><b>Bước 1 : Coppy dòng phía dưới dán vào trình duyệt</b></p> 
<input type="text" value="view-source:https://www.facebook.com/profile"/> 
<p><b>Bước 2 : Sau đó ấn nút : <code>Ctrl</code> và nút <code>F</code> ở bàn phím. 
<p><b>Bước 3 : Sau đó nhận EAAAA .</b></p> 
    <a href="../giaodien/img/gettoken.PNG" target="_blank"><img src="../giaodien/img/gettoken2.PNG" class="media-object img-responsive"/></a> 
<p><b>Bước 4 : Coppy toàn bộ code như ảnh rồi quay lại cài đặt bot tại đây!</b> 
    <a href="../giaodien/img/gettoken2.PNG" target="_blank"><img src="../giaodien/img/gettoken2.PNG" class="media-object img-responsive"/></a> 
    <p><b>Chúc thành công!</b></p> 
      </div> 
    </div> 
  </div> 
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
<?php 
} 
?> 
