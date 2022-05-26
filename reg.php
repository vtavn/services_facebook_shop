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
         <title>Đăng Ký | HeThongSongAo.Com - Dịch Vụ Vip Like - Vip CMT - Vip Bot Giá Rẻ 2018</title> 
        <link href="https://camo.githubusercontent.com/beede1ff8999a3d69c452f1cd0df90e076454344/687474703a2f2f7275627967656d732e6f72672f66617669636f6e2e69636f" rel="shortcut icon" /> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="../giaodien/css.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.css" rel="stylesheet" /> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.js"></script> 
        <link rel="stylesheet" href="../giaodien/iCheck/square/blue.css">
        <script src="../giaodien/iCheck/icheck.min.js"></script>

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
$fullname = trim($_POST['fullname']); 
$mail = trim($_POST['mail']); 
$sdt = trim($_POST['sdt']); 
$username = trim($_POST['username']); 
$password = md5($_POST['password']); 
$mk2 = "e10adc3949ba59abbe56e057f20f883e"; 
$code = md5($_POST['mail']); 

        $checks = "SELECT * FROM `account` WHERE `username`='$username'";
        $results=mysqli_query($vtasystem, $checks);
        $check = mysqli_num_rows($results);

        $checkmails = "SELECT * FROM `account` WHERE `mail`='$mail'";
        $resultss=mysqli_query($vtasystem, $checkmails);
        $checkmail = mysqli_num_rows($resultss);

        $checksdts = "SELECT * FROM `account` WHERE `mail`='$mail'";
        $resultsss=mysqli_query($vtasystem, $checksdts);
        $checksdt = mysqli_num_rows($resultsss);

if(strlen($username) > 20 || strlen($username) < 5){ 
echo '<div class="alert alert-danger">Tên tài khoản phải nhỏ hơn 20 và lớn hơn 5</div>'; 
}else if(strlen($sdt) < 8){ 
 echo '<div class="alert alert-danger">Số điện thoại  không hợp lệ. Vui long nhập lại.</div>'; 
}else if(!$username || !$password){ 
echo '<div class="alert alert-danger">Vui lòng điền đầy đủ thông tin</div>'; 
}else if($checkmail == 1){ 
echo '<div class="alert alert-danger">Email đã có trên hệ thống.</div>'; 
}else if($checksdt == 1){ 
echo '<div class="alert alert-danger">SĐT đã có trên hệ thống.</div>'; 
}else if($check == 1){ 
echo '<div class="alert alert-danger">Tài khoản đã tồn tại</div>'; 
}else{ 
mysqli_query($vtasystem, "INSERT INTO account(fullname, mail, toida, sdt, username, password, vnd, mk2, macode, doanhthu, level, kichhoat, sao, idvip, ip, tgiannhanqua, block, luotlike, otp) VALUES ('$fullname', '$mail', '10000', '$sdt', '$username', '$password', '0', '$mk2', '$code', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');");
        $so = rand(0,100000); 
        $so2 = rand(1,10); 
$to = $mail; 
$subject = 'Xác Minh Tài Khoản Hệ Thống VTASYSTEM'; 
$from = ''.$so.'noreply@'.$so2.'hethongsongao.com'; 
  
// To send HTML mail, the Content-type header must be set 
$headers  = 'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n"; 
  
// Create email headers 
$headers .= 'From: '.$from."\r\n". 
    'Reply-To: '.$from."\r\n" . 
    'X-Mailer: PHP/' . phpversion(); 
  
$message = '<html><body>'; 
$message .= '<style> 
.banner-color { 
background-color: #eb681f; 
         } 
         .title-color { 
         color: #0066cc; 
         } 
         .button-color { 
         background-color: #0066cc; 
         } 
         @media screen and (min-width: 500px) { 
         .banner-color { 
         background-color: #0066cc; 
         } 
         .title-color { 
         color: #eb681f; 
         } 
         .button-color { 
         background-color: #eb681f; 
         } 
         } 
      </style> 
   </head> 
   <body> 
      <div style="background-color:#ececec;padding:0;margin:0 auto;font-weight:200;width:100%!important"> 
         <table align="center" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%"> 
            <tbody> 
               <tr> 
                  <td align="center"> 
                     <center style="width:100%"> 
                        <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;max-width:512px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif" width="512"> 
                           <tbody> 
                              <tr> 
                                 <td bgcolor="#F3F3F3" width="100%" style="background-color:#f3f3f3;padding:12px;border-bottom:1px solid #ececec"> 
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important" width="100%"> 
                                       <tbody> 
                                          <tr> 
                                             <td align="left" valign="middle" width="50%"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">VTASYSTEM.COM</span></td> 
                                             <td valign="middle" width="50%" align="right" style="padding:0 0 0 10px"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">'.date('d/m/Y').'</span></td> 
                                             <td width="1">&nbsp;</td> 
                                          </tr> 
                                       </tbody> 
                                    </table> 
                                 </td> 
                              </tr> 
                              <tr> 
                                 <td align="left"> 
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%"> 
                                       <tbody> 
                                          <tr> 
                                             <td width="100%"> 
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%"> 
                                                   <tbody> 
                                                      <tr> 
                                                         <td align="center" bgcolor="#8BC34A" style="padding:20px 48px;color:#ffffff" class="banner-color"> 
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%"> 
                                                               <tbody> 
                                                                  <tr> 
                                                                     <td align="center" width="100%"> 
                                                                        <h1 style="padding:0;margin:0;color:#ffffff;font-weight:500;font-size:20px;line-height:24px">Xác Minh Tài Khoản</h1> 
                                                                     </td> 
                                                                  </tr> 
                                                               </tbody> 
                                                            </table> 
                                                         </td> 
                                                      </tr> 
                                                      <tr> 
                                                         <td align="center" style="padding:20px 0 10px 0"> 
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%"> 
                                                               <tbody> 
                                                                  <tr> 
                                                                     <td align="center" width="100%" style="padding: 0 15px;text-align: justify;color: rgb(76, 76, 76);font-size: 12px;line-height: 18px;"> 
                                                                        <h3 style="font-weight: 600; padding: 0px; margin: 0px; font-size: 16px; line-height: 24px; text-align: center;" class="title-color">Xin Chào: '.$fullname.'</h3> 
                                                                        <p style="margin: 20px 0 30px 0;font-size: 15px;text-align: center;">Bạn vừa đăng ký thành công tài khoản <b>'.$username.'</b> tại hệ thống VTASYSTEM. <br> Mã Xác Minh Của Bạn Là <b>'.$code.'</b></p>                           
                                                                     </td> 
                                                                  </tr> 
                                                               </tbody> 
                                                            </table> 
                                                         </td> 
                                                      </tr> 
                                                      <tr> 
                                                      </tr> 
                                                      <tr> 
                                                      </tr> 
                                                   </tbody> 
                                                </table> 
                                             </td> 
                                          </tr> 
                                       </tbody> 
                                    </table> 
                                 </td> 
                              </tr> 
                              <tr> 
'; 
$message .= '<td align="left"> 
<table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%"> 
                                       <tbody> 
                                          <tr> 
                                             <td align="center" width="100%"> 
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%"> 
                                                   <tbody> 
                                                      <tr> 
                                                         <td align="center" valign="middle" width="100%" style="border-top:1px solid #d9d9d9;padding:12px 0px 20px 0px;text-align:center;color:#4c4c4c;font-weight:200;font-size:12px;line-height:18px">Dịch Vụ Vip Like Facebook 
                                                            <br><b>VTASYSTEM TEAM</b> 
                                                         </td> 
                                                      </tr> 
                                                   </tbody></table></td></tr><tr><td align="center" width="100%"><table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%"> 
<tbody><tr><td align="center" style="padding:0 0 8px 0" width="100%"></td>'; 
$message .= '</tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></center></td></tr></tbody></table></div></body></html>'; 
mail($to, $subject, $message, $headers); 
echo '<div class="alert alert-success">Đăng ký thành công! <br> Tài khoản : <b>'.$username.'</b> <br> Mật khẩu : <b>'.$_POST['password'].'</b> <br> Mật khẩu cấp 2: <b>123456</b> <br> Vui lòng đăng nhập và kích hoạt! </div>'; 
} 
} 
} 
} 
?> 
    <form method="POST"> 
      <div class="form-group has-feedback">
        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Họ và Tên">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="mail" id="mail" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" name="sdt" id="sdt" class="form-control" placeholder="Số Điện Thoại">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="username" id="username" class="form-control" placeholder="Tên Tài Khoản">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Mật Khẩu">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <center> 
      <script src='https://www.google.com/recaptcha/api.js'></script> 
      <div class="g-recaptcha" data-sitekey="6LdBSSoUAAAAAAq4adHH9YScPerV0pWgJS4hWOD8"></div><br> 
      </center> 
      <div class="row"> 
        <!-- /.col --> 
        <div class="col-xs-12"> 
          <button type="submit" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Vui lòng chờ..." class="btn btn-primary btn-block btn-flat">Đăng Ký</button> 
        </div> 
        <!-- /.col --> 
      </div> 
    </form> 

    <a href="index.php?vip=lay_mat_khau">QUÊN MẬT KHẨU?</a><br> 
    <a href="login.php" class="text-center">CÓ TÀI KHOẢN. ĐĂNG NHẬP THÔI!.</a> 

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