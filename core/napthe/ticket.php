
<div class="col-lg-12"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">TẠO TICKET - YÊU CẦU HỖ TRỢ KHÁCH HÀNG</h3><br> Vui lòng không lạm dụng - spam. Trái quy định sẽ bị khóa tài khoản! 
            </div> 
            <div class="panel-body"> 
                <?php 
if(isset($_POST['submit'])){ 
   $name; 
   $captcha; 
   if(isset($_POST['name'])){ 
      $name = $_POST['name']; 
   } 
   if(isset($_POST['g-recaptcha-response'])){ 
      $captcha = $_POST['g-recaptcha-response']; 
   } 
   if(!$captcha){ 
echo '<div class="alert alert-danger">Hãy Nhập Capcha</div>'; 
   }else{ 
      $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdBSSoUAAAAAMNA5dr40HUZct7xl_3NXmD2tJX9&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']); 
      if($response.success == false){ 
echo '<div class="alert alert-danger">Spam À :3</div>'; 
      }else{ 
$tieude = $_POST['tieude']; 
$noidung = $_POST['noidung']; 
$number = rand(1000,99999); 
$maticket = 'vta_'.$number.''; 
$iduser = $getuser['id']; 
$nameuser = $getuser['username']; 
$time = time(); 
if(strlen($tieude) > 100 || strlen($tieude) < 10){ 
echo '<div class="alert alert-danger">Tên tài khoản phải nhỏ hơn 100 và lớn hơn 10 ký tự!</div>'; 
}else{ 
// lưu vào data 
mysqli_query($vtasystem, "INSERT INTO ticket(tenchude, noidung, id_gui, name_gui, trangthai, maso, time)  
            VALUES ('$tieude', '$noidung', '$iduser', '$nameuser', '0', '$maticket', '$time');"); 
echo '<div class="alert alert-success">Gửi hỗ trợ thành công. Chúng tôi sẽ giải quyết trong vòng 30 phút đến 1 tiếng. Cảm ơn! </div>'; 
} 
} 
} 
} 
?> 
        <form action="/index.php?vip=ticket" method="POST"> 
            <div class="row"> 
                <div class="col-md-6"> 
                <div class="input-group has-error"> 
                <span class="input-group-addon">Người Gửi:</span> 
                <input type="text" class="form-control" name="tieude" value="<?php echo $getuser['fullname'];?>" disabled> 
                  </div> 
                </div> 

                <div class="col-md-6"> 
                <div class="input-group has-error"> 
                <span class="input-group-addon">Username:</span> 
                <input type="text" class="form-control" name="tieude" value="<?php echo $getuser['username'];?>" disabled> 
                  </div> 
                </div> 
                </div><br> 
              <div class="input-group has-success"> 
                <span class="input-group-addon">Tiêu đề:</span> 
            <input type="text" class="form-control" name="tieude" placeholder="Tiêu Đề Hỗ Trợ..." required> 
          </div><br>     
              <div class="input-group has-success"> 
                <span class="input-group-addon">Nội Dung:</span> 
            <textarea class="form-control" id="noidung" name="noidung" rows="5" placeholder="Nội dung cần hỗ trợ..." required="" autofocus=""></textarea> 
              </div>    <br> 

            <center> 
<script src='https://www.google.com/recaptcha/api.js'></script> 
<div class="g-recaptcha" data-sitekey="6LdBSSoUAAAAAAq4adHH9YScPerV0pWgJS4hWOD8"></div><br> 
          <button type="submit" name="submit" class="btn btn-danger">Gửi Hỗ Trợ 
          </button></center> 
        </form> 
            </div> 
    </div> 
  </div> 

<!--Thống kê ticket--> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> DANH SÁCH TICKET CỦA BẠN</b> 
                        </div> 
<div class="panel-body"> 
<div class="table-responsive"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>Mã Số</th> 
              <th>Chủ Đề</th> 
              <th>Tình trạng</th> 
              <th>Ngày gửi</th> 
              <th>Hành động</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `id_gui`=".$getuser['id'].""); 
while($res = mysqli_fetch_assoc($req)){ 
?> 
            <tr> 
              <td> 
                <a href="/index.php?vip=view_ticket&id=<?php echo $res['maso']; ?>" target="_blank" data-toggle="tooltip" title="Xem Ticket" style="color:black"> 
                    <b><?php echo $res['maso']; ?></b></a> 
              </td> 
              <td> 
                    <?php echo $res['tenchude']; ?> 
              </td> 
              <td>               
                 <?php if ($res['trangthai']==0){ ?><span class="badge bg-yellow">Đang chờ.</span> <?php } ?> 
                 <?php if ($res['trangthai']==1){ ?><span class="badge bg-green">Đã giải quyết.</span><?php } ?> 
                 <?php if ($res['trangthai']==2){ ?><span class="badge bg-red">Bị hủy.</span><?php } ?> 
              </td> 
              <td> 
                <?php echo date('H:i d/m/Y', $res['time']); ?> 
              </td> 

              <td> 
<a href="/index.php?vip=ticket&huy=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Xóa ID" class="btn btn-success btn-simple btn-xs">Hủy Yêu Cầu</a> 
              </td> 
            </tr> 
            <?php 
} 
?> 
          </tbody> 
        </table> 
       </div> 
            </div> 
      </div> 

    </div> 
<?php 
if($_GET['xoa']){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `id` = '".$_GET['xoa']."' LIMIT 1")); 
if($infouser['id_gui'] != $getuser['id']){  
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=ticket'>"; 
            die("<script>alert('Không thể xóa ticket của người khác'); </script>"); 
} else { 
mysqli_query($vtasystem, "DELETE FROM `ticket` WHERE id ='" . mysqli_real_escape_string($vtasystem, $_GET['xoa']) . "'"); 
$userxoa = $getuser['username']; 
$idxoa = $infouser['fbid']; 
$soticket = $infouser['maso']; 
$time = time(); //date("H:i:s d/m/Y") 
$content = "<b>$userxoa</b> Vừa xóa Ticket Số <b>$soticket</b>."; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='TICKET',`content`='$content',`time`='".$time."'"); 
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=ticket'>"; 
            die("<script>alert('xóa thành công'); </script>"); 
exit; 
} 
} 

if($_GET['huy']){ 
$infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `ticket` WHERE `id` = '".$_GET['huy']."' LIMIT 1")); 
if($infouser['id_gui'] != $getuser['id']){  
      echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=ticket'>"; 
      die("<script>alert('Không thể hủy ticket của người khác'); </script>"); 
} else { 
mysqli_query($vtasystem, "UPDATE `ticket`SET `trangthai`='2' WHERE `id` = '".$_GET['huy']."'"); 
$userxoa = $getuser['username']; 
$idxoa = $infouser['fbid']; 
$soticket = $infouser['maso']; 
$time = time(); //date("H:i:s d/m/Y") 
$content = "<b>$userxoa</b> vừa hủy ticket số <b>$soticket</b>."; 
mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='TICKET',`content`='$content',`time`='".$time."'"); 
      echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=ticket'>"; 
      die("<script>alert('Thành công'); </script>"); 
exit; 
} 
} 
?> 

