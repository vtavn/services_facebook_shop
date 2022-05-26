<style> 
  $errorMsgColor: #ff0000; 
  .error { 
    color: $errorMsgColor; 
  } 
} 
</style>  
<div class="col-lg-6"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title"> Đăng Ký Hệ Thống Pro</h3> 
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
        <form action="/index.php?vip=tao_tai_khoan" name="registration" method="POST"> 
              <div class="input-group has-success"> 
                <span class="input-group-addon">Tên Đầy Đủ</span> 
            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Họ Và Tên" required> 
          </div><br>     
              <div class="input-group has-success"> 
                <span class="input-group-addon">Email</span> 
                <input type="email" class="form-control" name="mail" id="mail" placeholder="Vui lòng điền email chính xác để kích hoạt tài khoản." required> 
              </div>    <br>      
            <div class="input-group has-success"> 
                <span class="input-group-addon">Số Điện Thoại</span> 
            <input type="number" class="form-control" name="sdt" id="sdt" placeholder="Số Điện Thoại" required> 
          </div><br> 
              <div class="input-group has-success"> 
                <span class="input-group-addon">Tài Khoản</span> 
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required> 
              </div><br> 
              <div class="input-group has-success"> 
                <span class="input-group-addon">Mật Khẩu</span> 
            <input type="password" class="form-control" name="password" id="password" placeholder="Mật Khẩu" required> 
          </div><br><center> 
<script src='https://www.google.com/recaptcha/api.js'></script> 
<div class="g-recaptcha" data-sitekey="6LdBSSoUAAAAAAq4adHH9YScPerV0pWgJS4hWOD8"></div><br> 
          <button type="submit" name="submit" class="btn btn-danger">Đăng Ký 
          </button></center> 
        </form> 

      </div> 
    </div> 
  </div> 
<script type="text/javascript"> 
  // Wait for the DOM to be ready 
$(function() { 
  // Initialize form validation on the registration form. 
  // It has the name attribute "registration" 
  $("form[name='registration']").validate({ 
    // Specify validation rules 
    rules: { 
      // The key name on the left side is the name attribute 
      // of an input field. Validation rules are defined 
      // on the right side 
      fullname: "required", 
      username: "required", 
      email: { 
        required: true, 
        // Specify that email should be validated 
        // by the built-in "email" rule 
        email: true 
      }, 
      password: { 
        required: true, 
        minlength: 5 
      } 
    }, 
    // Specify validation error messages 
    messages: { 
      fullname: "Vui lòng nhập tên của bạn.", 
      username: "Vui lòng nhập tên tài khoản.", 
      password: { 
        required: "Vui lòng nhập mật khẩu.", 
        minlength: "Mật khẩu phải dài hơn 5 kí tự." 
      }, 
      email: "Vui lòng điền đúng địa chỉ email" 
    }, 
    // Make sure the form is submitted to the destination defined 
    // in the "action" attribute of the form when valid 
    submitHandler: function(form) { 
      form.submit(); 
    } 
  }); 
}); 
</script> 
  <div class="col-lg-6"> 

          <div class="box box-warning"> 
            <div class="box-header with-border"> 
              <h3 class="box-title"> Điều Khoản Hệ Thống</h3> 
            </div> 
<div class="panel-body"> 
<p>Tại hệ thống chúng tôi không bắt các bạn kích hoạt bằng tiền.</p> 
<p>Vì vậy vui lòng điền đầy đủ thông tin chính xác của bạn.</p> 
<strong>Khi đã quyết định đăng ký tài khoản tại hệ thống đồng nghĩa :</strong> 
<ul> 
<li>Bạn đã đồng ý với quy định và điều khoản của hệ thống.</li> 
<li>Tin tưởng sự uy tín và chất lượng của hệ thống.</li> 

</ul> 
</div> 
</div> 
</div> 