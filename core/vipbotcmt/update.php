<?php
if(!$_SESSION['user']){
?>
<meta http-equiv=refresh content="0; URL=/index.php">
<script>alert("ĐĂNG NHẬP ĐI CHÁU :D"); </script>

<?php
}else{
?>

<?php if(!$_GET['edit']){  ?>
<meta http-equiv=refresh content="0; URL=/index.php">
<?php } ?>

<?php if($_GET['edit']){  ?>

<?php
$infouser = mysql_fetch_array(mysql_query("SELECT * FROM `vip_botcmt` WHERE `id` = '".$_GET[edit]."' LIMIT 1"));
if($infouser['id_buy'] != $_SESSION['id']){ ?>
<meta http-equiv=refresh content="0; URL=/index.php?vip=manager_vipbot_cmt">
<script>alert("Không phải ID Của bạn"); </script>
<?php } ?>


		<?php
			
			$req = mysql_query("SELECT * FROM `vip_botcmt` WHERE `id` = '".$_GET[edit]."'");
			while($vtaddzz = mysql_fetch_assoc($req)){
		?>
  
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b>Chỉnh Sửa Thông Tin ID VIP CMT</b>
                        </div>
                   <div class="panel-body">
<form action="" method="POST">
                <div class="form-group">
                <label>Nhập Token:</label>
                <input type="txt" class="form-control" name="token" id="token" oninput="update_name()" value="<?php echo strip_tags($vtaddzz['access_token']); ?>" required="" autofocus="">
                </div>
            
                <div class="form-group">
                <label>Tên Người Dùng:</label>
<input name="name" id="name" required="" type="text" class="form-control" value="<?php echo strip_tags($vtaddzz['name']); ?>" maxlength="30">
                </div>
				
                <div class="form-group">
                <label>ID Người Dùng:</label>
<input name="user_id" id="user_id" required="" type="text" value="<?php echo strip_tags($vtaddzz['user_id']); ?>"class="form-control" maxlength="30">
                </div>
				
				<div class="form-group">
                <label>Nội Dung CMT:</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="5" placeholder="Nội dung cmt..." required="" autofocus=""><?php echo strip_tags($vtaddzz['noidung']); ?></textarea>
                </div>
				
                <div class="form-group">
                <label>Link Ảnh:</label>(Là dạng cmt kèm ảnh - Không dùng thì không cần dán link ảnh vào đây. Định dạng link .jpg - jpge - .png)
				<input name="linkanh" id="linkanh" type="text" value="<?php echo strip_tags($vtaddzz['linkanh']); ?>" placeholder="Là dạng cmt kèm ảnh - Không dùng thì không cần dán link ảnh vào đây. Định dạng link .jpg - jpge - .png" class="form-control">
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
                <label>TRạng Thái:</label>
        <select name="trangthai" class="form-control">
              <option value="0">Chạy BOT</option>
                        <option value="1">Dừng BOT</option>
            </select>
                </div>
	<button type="submit" name="edit" class="btn btn-danger">Done!</button>
	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Thông Tin</button>

</form>

<?php if (isset($_POST['edit'])) {
$token = $_POST['token'];
$name = $_POST['name'];
$noidung = $_POST['noidung'];
$linkanh = $_POST['linkanh'];
$gioihan = $_POST['gioihan'];
$status = $_POST['trangthai'];
$idvip = $_POST['user_id'];
mysql_query("UPDATE vip_botcmt SET `noidung`='$noidung', `linkanh`='$linkanh', `gioihan`='$gioihan' ,`user_id`='$idvip',`status`='$status', `access_token`='$token', `name` = '$name' WHERE `id` = '".$_GET['edit']."'");
    //up log
        $timess = time();
        $content = "<b>" .$getuser['username']. "</b> Chỉnh VIP BOT CMT cho ID <b>$idvip</b>.";
        mysql_query("INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='BOTCMT',`content`='$content',`time`='".$timess."'");
    //show
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=manager_vipbot_cmt">';
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
