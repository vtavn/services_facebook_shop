<?php 
if($getuser['chinhthuc'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=nap_the">'; 
die('<script>alert("ÍT Nhất 1 Lần Nạp Thẻ Và Tối Đa 50.000 VNĐ. Mới Có Thể Tham Gia Sự Kiện!"); </script>'); 
}else{ 
?> 
<script src="../giaodien/Event/sweetalert-dev.js"></script> 
<script src="../giaodien/Event/sweetalert.min.js"></script> 
<link rel="stylesheet" href="../giaodien/Event/sweetalert.css" type="text/css" /> 
<?php 
$idctv = $_SESSION['id']; 
            $get_user = mysqli_query($vtasystem, "SELECT * FROM account WHERE id = '".$_SESSION['id']."'"); 
            $user = mysqli_fetch_assoc($get_user); 
$timenhan = time(); 
    $get = mysqli_query($vtasystem, "SELECT tgiannhanqua FROM account WHERE id = '".$_SESSION['id']."'"); 
    $rows = mysqli_fetch_assoc($get); 

$tinhtime = $timenhan - $rows['tgiannhanqua'];  
//$conlai = 86400 - $tinhtime; 
$conlai = 86400 - $tinhtime;  
if(isset($_POST['submit'])) { 
$rand = rand(1,1);

if($rand == 1) { 
$list_money = array('1000','1000','3000','1000','5000','1020','1002','5000','1004','1050','10000','1300','2345','1021','1011','1110','1000','6000','1000','1000','1000','1000','9999','7000','1000','1000','10000','15000'); 
$money = number_format($list_money[array_rand($list_money)]); 
$tien = str_replace(',','',$money); 

if(time() > $rows['tgiannhanqua'] + 3600 * 23){ 
        $timess = time(); 
        $content = "<b>" .$user['username']. "</b> Nhận Được <b>$money VNĐ</b> Từ SK Điểm Danh"; 
        $add = mysqli_query($vtasystem, "UPDATE account SET vnd = vnd + '$tien', sao = sao + '1', tgiannhanqua = ".time()." WHERE id = '".$_SESSION['id']."'"); 
        $log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$user['id']."', `type`='BAODANH',`content`='$content',`time`='".$timess."'"); 
if($log){ 
echo "<script>swal({ 
html: true, 
title: 'ĐIỂM DANH THÀNH CÔNG!!', 
text: '$content', 
type: 'success', 
}, 
function(){ 
location.href = 'index.php?vip=bao_danh'; 
});</script>"; 
} 
} else { 
echo "<script>swal({ 
html: true, 
title: 'ĐIỂM DANH THẤT BẠI!!', 
text: 'BẠN ĐÃ ĐIỂM DANH NGÀY HÔM NAY!', 
type: 'error', 
});</script>"; 
} 
} 

if($rand == 2) { 
$so = rand(1,99);
$list_code = array('10','5','5','5','5','5','5','5','5','5','10','20','20','10','15','15','10','5','5','5','5','5','5','5'); 
$code = number_format($list_money[array_rand($list_money)]); 
$giamgia = str_replace(',','',$codes); 
$magiamgia = 'BAODANH_'.$so.'';

if(time() > $rows['tgiannhanqua'] + 3600 * 23){ 
        $timess = time(); 
        $content = "<b>" .$user['username']. "</b> Nhận Được Mã Giảm Giá <b>$magiamgia</b> Giảm <b>$giamgia %</b>  Từ SK Điểm Danh"; 

        mysqli_query($vtasystem, "INSERT INTO `coupon_ht` SET `username` = '".$_SESSION['username']."', `code`='".$magiamgia."', `giam`='".$giamgia."'"); 

        $log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$user['id']."', `type`='BAODANH',`content`='$content',`time`='".$timess."'"); 
if($log){ 
echo "<script>swal({ 
html: true, 
title: 'ĐIỂM DANH THÀNH CÔNG!!', 
text: '$content', 
type: 'success', 
}, 
function(){ 
location.href = 'index.php?vip=bao_danh'; 
});</script>"; 
} 
} else { 
echo "<script>swal({ 
html: true, 
title: 'ĐIỂM DANH THẤT BẠI!!', 
text: 'BẠN ĐÃ ĐIỂM DANH NGÀY HÔM NAY!', 
type: 'error', 
});</script>"; 
} 
} 

}  
?> 
<div class="col-md-6"> 
            <div class="box box-primary"> 
            <div class="box-header with-border"> 
              <h3 class="box-title"><i class="fa fa-calendar-o"></i> Điểm Danh Hằng Ngày</h3> 
            </div> 
            <!-- /.box-header --> 
            <div class="box-body"> 
<center> 
<div class="box-info">  
                <span class="badge bg-red btn-flat"><i class="fa fa-clock-o"></i> Thời Gian Chờ</span>  
<?php if($rows['tgiannhanqua'] == 0) { 
echo '<h3>Có Thể Nhận Quà</h3>'; 
}else{ 
echo '<h3><span id="countdown" class="timer"></span></h3>'; 
} 
?> 
</div></center> 
<center> 
<?php 
if($conlai < 0){  
?> 
<form action="#" method="post"><button type="submit" name="submit" class="btn btn-block btn-success" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Vui lòng chờ..." class="col-md-3"><i class="fa fa-gift"></i> NHẬN QUÀ NGAY</button></form> 
<?php }else{ ?> 
<button type="button" class="btn btn-block btn-danger disabled"><i class="fa fa-gift"></i> ĐÃ ĐIỂM DANH</button> 
<?php } ?> 
</center> 
</div></div> 

            <div class="box box-primary"> 
            <div class="box-header with-border"> 
              <h3 class="box-title"><i class="fa fa-gift"></i> Phần Quà</h3> 
            </div> 
            <!-- /.box-header --> 
            <div class="box-body"><center> 
<p>Các bạn có thể nhận được số tiền ngẫu nhiên từ <b>1.000 VNĐ</b> đến <b>100.000 VNĐ</b> từ sự kiện</p> 
<p><strong>Chúc các bạn vui vẻ!!!</strong></p> 
<h3><font color="red">ĐÃ BÁO DANH <span class="label label-success"><?php echo $user['sao'];?></span> NGÀY</font></h3>  
</center> 
</div></div> 
  
</div> 
<div class="col-md-6">  
            <div class="box box-success"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Lịch Sử Điểm Danh</h3> 
            </div> 
            <!-- /.box-header --> 
            <div class="box-body"> 
              <table id="example1" class="table table-bordered table-striped"> 
                <thead> 
                <tr> 
                    <th>ID</th> 
                  <th>Nội dung</th> 
                  <th>Thời gian</th> 
                </tr> 
                </thead> 
                <tbody> 
                    <?php 
                        $i = 1; 
                        $gethis = mysqli_query($vtasystem, "SELECT * FROM `log_ht` WHERE `type`='BAODANH'"); 
                        while($log = mysqli_fetch_assoc($gethis)){ 
                            $time = date('d/m/Y - H:i:s', $log['time']); 
                            $content  = $log['content'];  
                            //$i++; 
                    ?> 
                <tr> 
                    <td><?php echo $i++; ?></td> 
                  <td><?php echo $content; ?></td> 
                  <td><?php echo $time; ?></td> 
                </tr> 
                <?php } ?> 
                </tbody> 
                
              </table> 
            </div> 
            <!-- /.box-body --> 
          </div> 
          <!-- /.box --> 
</div> 
<script> 

var seconds = "<?php echo $conlai; ?>"; 
function secondPassed() { 
    var days        = Math.floor(seconds/24/60/60); 
    var hoursLeft   = Math.floor((seconds) - (days*86400)); 
    var hours       = Math.floor(hoursLeft/3600); 
    var minutesLeft = Math.floor((hoursLeft) - (hours*3600)); 
    var minutes     = Math.floor(minutesLeft/60);  
    var remainingSeconds = seconds % 60; 
    if (remainingSeconds < 10) { 
        remainingSeconds = "0" + remainingSeconds;   
    } 
    document.getElementById('countdown').innerHTML = hours + " Giờ " + minutes + " Phút " + remainingSeconds + " Giây "; 
    if (seconds <= 0) { 
        clearInterval(countdownTimer); 
        document.getElementById('countdown').innerHTML = "Có Thể Nhận Quà"; 
    } else { 
        seconds--; 
    } 
} 
var countdownTimer = setInterval('secondPassed()', 1000); 


$('.btn').on('click', function() { 
    var $this = $(this); 
  $this.button('loading'); 
    setTimeout(function() { 
       $this.button('reset'); 
   }, 8000); 
}); 


</script> 
<?php 
} 
?> 