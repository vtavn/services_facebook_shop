<?php
if($getuser['kichhoat'] <  1) { 
echo'Không được phép hì';
			 } else {
?>
<?php
if(isset($_POST['submit'])){
$times = mysql_real_escape_string($_POST['time']);
$token = mysql_real_escape_string($_POST['token']);
$name = $_POST['name'];
$noidung = $_POST['noidung'];
$linkanh = $_POST['linkanh'];
$gioihan = $_POST['gioihan'];
$idvip = $_POST['user_id'];

if ($vnd < 0){
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_cmt">';
die('<script>alert("Gói Cảm Xúc Không Tồn Tại Trên Hệ Thống!"); </script>');
}
if ($getuser['vnd'] < 0){
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_cmt">';
die('<script>alert("Làm gì Còn Tiền mà Mua Đâu!"); </script>');
}


if ($times == 30){
$vnd = '0';
} elseif ($times < 0) {
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_cmt">';
die('<script>alert("Không bug được đâu nhé! Gian lận không tốt đâu!");</script>');
} else {
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_cmt">';
die('<script>alert("Không bug được đâu nhé! Gian lận không tốt đâu!");</script>');
}
$checkvip = mysql_result(mysql_query("SELECT COUNT(*) FROM `vip_botcmt` WHERE `user_id`= '$idvip' LIMIT 1"), 0);
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `vip_botcmt` WHERE `id_buy`=".$getuser['id'].""), 0);
if($getuser['toida'] < $check) {
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_cmt">';
die('<script>alert("Bạn đã sử dụng tối đa ID! Nâng Cấp Liên Hệ Admin.");</script>');
} elseif($getuser['vnd'] < $vnd){
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_cmt">';
die('<script>alert("Bạn KHông đủ tiền!");</script>');
} elseif (1 > $checkvip) {	
mysql_query("UPDATE `account` SET `vnd`=`vnd`-'".intval($vnd)."' WHERE `id`=".$getuser['id']."");
$timecx = time() + $times * 24 * 3600;
mysql_query("INSERT INTO `vip_botcmt` SET `name`='$name', `id_buy`='".$getuser['id']."', `name_buy`='".$getuser['username']."', `noidung`='$noidung', `linkanh`='$linkanh', `gioihan`='$gioihan',`user_id`='$idvip', `access_token`='$token', `time`='$timecx', `status`='0'");
    //up log
        $timess = time();
        $content = "<b>" .$getuser['username']. "</b> vừa thêm VIP BOT CMT cho ID <b>$idvip</b>. Thời hạn <b>1</b> tháng, tổng thanh toán <b>" . number_format($vnd) . " VNĐ </b>";
        mysql_query("INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='BOTCMT',`content`='$content',`time`='".$timess."'");
    //show

echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipbot_cmt">';
die('<script>alert("Thêm ID VIP CMT Thành công!");</script>');
}else{
echo '<div class="alert alert-danger">Tài Khoản Này Đã Cài Trên Hệ Thống</div>';
}
}

?>
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i> CÀI ĐẶT BOT CMT</b>
                        </div>
                    <div class="panel-body">
        <form action="index.php?vip=add_vipbot_cmt" method="POST">

                <div class="form-group">
                <label>Nhập Token !:</label>
                <input type="txt" class="form-control" name="token" id="token" oninput="update_name()" required="" autofocus="">
                </div>
            
                <div class="form-group">
                <label>Tên Người Dùng:</label>
<input name="name" id="name" required="" value="" type="text" class="form-control" maxlength="30">
                </div>
                <div class="form-group">
                <label>ID Người Dùng:</label>
<input name="user_id" id="user_id" required="" value="" type="text" class="form-control" maxlength="30">
                </div>
				
				<div class="form-group">
                <label>Nội Dung CMT:*</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="5" placeholder="Nội dung cmt..." required="" autofocus=""></textarea>
				<b>* :</b> Update thêm chức năng cmt random icon bằng cách sử dụng <b>{r-i}</b>. VD: <b>{r-i}</b> VTASystem <b>{r-i}</b>. Dùng nhiều icon thì ghi nhiều <b>{r-i}</b><b>{r-i}</b><b>{r-i}</b>!
                </div>
				
				<p><label>Sử dụng cmt ảnh:</label> 
				<input type="radio" name="abc" value="radio1" checked>Sử dụng.  <input type="radio" name="abc" value="radio2">Không!</p>
                <div class="form-group" id="cmtanh">
                <label>Link Ảnh:*</label>
				<input name="linkanh" id="linkanh" type="text" placeholder="Là dạng cmt kèm ảnh - Không dùng thì không cần dán link ảnh vào đây. Định dạng link .jpg - jpge - .png" class="form-control">
				<b>* :</b> Là dạng cmt kèm ảnh - Không dùng thì không cần dán link ảnh vào đây. Định dạng link .jpg - jpge - .png ! 
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
		<label id="dola" for="dola">Số Tiền Cần Thanh Toán Là: <? echo number_format('0');?></label>
                 </div> 
     
               <div class="form-group">
			<button type="submit" name="submit" class="btn btn-danger">Cài BOT</button>
	                       </div>

        </form>

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

   $(document).ready(function(){
      $("input[value='radio1']").click(function(){
         $("#cmtanh").show(    function(){toastr.success('Sử dụng comment hình ảnh!!', 'Thông báo');}    );
      })
      $("input[value='radio2']").click(function(){
         $("#cmtanh").hide(    function(){toastr.error('Không sử dụng comment hình ảnh!!', 'Thông báo');}    );
      })
   })
    </script>
<?php
}
?>