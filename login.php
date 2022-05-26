<?php 
session_start(); 
error_reporting(0); 
date_default_timezone_set('Asia/Ho_Chi_Minh'); 
include 'config.php'; 
include '../core/functions.php'; 
if(!$_SESSION['user']){ 
?> 

<!DOCTYPE html> 
<!--  
    Source Code: VIP Facebook Auto System - (c) 2017-2018 Code By VTA - Release Date: 29/1/2018 
    MUA SOURCE LIÊN HỆ 0919.257.664 - FACEBOOK.COM/100009580369715 
--> 
<html lang="en"> 
<head> 
        <meta charset="utf-8" /> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
        <meta name="theme-color" content="pink" /> 
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" /> 
        <meta name="description" content="VTASYSTEM.COM là 1 hệ thống quản lí VIP Facebook Auto chuyên nghiệp nhất hiện nay với những tính năng mạnh mẽ và tối ưu hiệu quả cao." /> 
        <meta name="author" content="VTASYSTEM" /> 
        <meta name="copyright" content="VTASYSTEM" /> 
        <meta name="robots" content="index, follow" /> 
        <meta property="og:url" content="https://VTASYSTEM.Com" /> 
        <meta property="og:type" content="website" /> 
        <meta property="og:description" content="VTASYSTEM.COM là 1 hệ thống quản lí VIP Facebook Auto chuyên nghiệp nhất hiện nay với những tính năng mạnh mẽ và tối ưu hiệu quả cao." /> 
        <meta property="og:image" content="https://static.wixstatic.com/media/e7cb87_5cf818ca3196445a9d36ac47937730f9~mv2.png" /> 
        <meta property="og:locale" content="vi_VN" /> 
        <meta property="og:author" content="100009580369715" /> 
         <title>Đăng Nhập | HeThongSongAo.Com - Dịch Vụ Vip Like - Vip CMT - Vip Bot Giá Rẻ 2018</title> 
        <link href="https://camo.githubusercontent.com/beede1ff8999a3d69c452f1cd0df90e076454344/687474703a2f2f7275627967656d732e6f72672f66617669636f6e2e69636f" rel="shortcut icon" /> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="../giaodien/css.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.css" rel="stylesheet" /> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.js"></script> 
</head> 

</head> 

<div id="loading"> 
    <div class="spinner"> 
        <div class="bounce1"></div> 
        <div class="bounce2"></div> 
        <div class="bounce3"></div> 
    </div> 
</div> 
<body class="hold-transition login-page"> 
<div class="login-box"> 
  <div class="login-logo"> 
    <a href="/index.php"><b>HETHONGSONGAO</b></a> 
  </div> 
  <!-- /.login-logo --> 
  <div class="login-box-body"> 
    <p class="login-box-msg">Vui lòng đăng nhập để tiếp tục.!</p> 
<?php 
  function get_user_ip(){ 
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){ 
      //ip from share internet 
      $ip = $_SERVER['HTTP_CLIENT_IP']; 
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ 
      //ip pass from proxy 
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    }else{ 
      $ip = $_SERVER['REMOTE_ADDR']; 
    } 
      return $ip; 
    } 
  if (($_POST) && isset($_SESSION['captcha']) && isset($_POST['captcha'])) { 
    $username = isset($_POST['username']) ? htmlspecialchars(addslashes($_POST['username'])) : '';
    $password = isset($_POST['password']) ?  htmlspecialchars(addslashes(md5($_POST['password']))) : '';
    $mk2 = md5($_POST['mk2']); 
  if($_SESSION['captcha'] !== $_POST['captcha']){ 
    $loi['captcha'] = "<font color='red'>Sai mã Captcha, vui lòng nhập lại.</font>"; 
  }else if($username && $password){ 
    // cái sql check tồn tại hay chưa dùng toàn lỗi lỗi mỗi cái này thôi a
    $sql = "SELECT * FROM `account` WHERE `username`='$username' AND `password`='$password'";
    $result=mysqli_query($vtasystem, $sql);
    $row = mysqli_num_rows($result);
    //sao lại $row == 1 ?? nếu có thì phải thành công chứ
 if($row == 1){ 
    $res = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `username`='$username' AND `password`='$password'")); 
    $_SESSION['user'] = $res['id']; 
    $_SESSION['id'] = $res['id']; 

    $timess = time(); 
    $content = "<b>" .$username. "</b> đã đăng nhập với IP <b>".get_user_ip()."</b>"; 
    $update_log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$res['id']."', `type`='LOGIN',`content`='$content',`time`='".$timess."'"); 
    $setsk = mysqli_query($vtasystem, "UPDATE `account` SET `chinhthuc`='1' WHERE `napthe` >= '50000'"); 
    
    echo "<script>swal('Đăng Nhập Thành Công!','Hệ Thống Đang Xử Lý...','success');</script>"; 
    die('<meta http-equiv=refresh content="0; URL=/index.php">'); 
  }else{ 
    echo "<script>swal('Đăng Nhập Không Thành Công!','Sai tên đăng nhập hoặc mật khẩu.','error');</script>"; 
  } 
  } 
  } 
?> 
    <form method="POST"> 
      <div class="form-group has-feedback"> 
        <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản..." required> 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span> 
      </div> 
      <div class="form-group has-feedback"> 
        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu..." required> 
        <span class="glyphicon glyphicon-lock form-control-feedback"></span> 
      </div> 
      <div class="form-group"> 
        <label for="captcha"><img class="captcha" src="../giaodien/capcha2.php"><a class="chance-captcha"><img style="width:7%;" src="https://cdn3.iconfinder.com/data/icons/faticons/32/sync-01-128.png"></a></label> 
        <input class="form-control" placeholder="Nhập mã bảo mật bên trên vào đây" name="captcha" maxlength="6"> 
        <?php echo isset($loi['captcha']) ? $loi['captcha'] : ''; ?> 
      </div> 
      <div class="row"> 
        <div class="col-xs-6"> 
          <!--div class="checkbox icheck"> 
            <label> 
              <input type="checkbox"> Lưu mật khẩu 
            </label> 
          </div--> 
        </div> 
        <!-- /.col --> 
        <div class="col-xs-6"> 
          <button type="submit" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Vui lòng chờ..." class="btn btn-primary btn-block btn-flat">Đăng Nhập</button> 
        </div> 
        <!-- /.col --> 
      </div> 
    </form> 

    <a href="index.php?vip=lay_mat_khau">QUÊN MẬT KHẨU?</a><br> 
    <a href="index.php?vip=tao_tai_khoan" class="text-center">ĐĂNG KÍ TÀI KHOẢN MỚI.</a> 

  </div> 
  <!-- /.login-box-body --> 
</div> 
<!-- /.login-box --> 
<!-- Mainly scripts --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="../giaodien/js.js"></script> 
<script> 
  $('.btn').on('click', function() { 
    var $this = $(this); 
  $this.button('loading'); 
    setTimeout(function() { 
       $this.button('reset'); 
   }, 8000); 
}); 
    $(window).load(function(){ 
            setTimeout(function() { 
                $('#loading').fadeOut( 400, "linear" ); 
            }, 300); 
    }); 
$(function() { 
    $("a.chance-captcha").click(function(t) { 
        $.ajax({ 
            url: "../giaodien/capcha2.php", 
            type: "GET", 
            datatype: "html", 
            data: {}, 
            success: function(t) { 
                $("img.captcha").attr("src", "../giaodien/capcha2.php") 
            } 
        }) 
    }) 
}); 
</script> 

</body> 
</html> 
<?php  
}else{ 
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
} 
?> 