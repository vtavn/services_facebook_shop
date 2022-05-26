<?php 
if (isset($_POST['recoverpass'])) { 
    $loi = array(); 
    $email = $_POST['email']; 
    $get1 = "SELECT * FROM account WHERE mail='$email'"; 
    $result1 = mysqli_query($vtasystem, $get1); 
    $check = mysqli_fetch_assoc($result1); 
    if ($check == 0) { 
        $loi['404'] = '<font color="red">Email bạn vừa nhập không tồn tại trên hệ thống!</font>'; 
    }if (empty($loi)) { 
        $get = "SELECT * FROM account WHERE mail = '$email'"; 
        $result = mysqli_query($vtasystem, $get); 
        $x = mysqli_fetch_assoc($result); 
        $code = $x['macode']; 
        $name = $x['fullname']; 
        $so = rand(0,100000); 
        $so2 = rand(1,10); 
        $e = $x['email'];
        $subject = "Liên kết đặt lại mật khẩu cho tài khoản của bạn";
        $bcc = 'HETHONGSONGAO.COM - Recover Password';
        $noi_dung = "Xin chào <b>$name</b><br /><br />Chúng tôi gửi liên kết để đặt lại mật khẩu cho tài khoản của bạn.<br /><br /> <a href='http://hethongsongao.com/index.php?vip=lay_mat_khau&email='.$e.'&code='.$code.'' target='_blank'><span style='background:yellow; color:red'>http://hethongsongao.com/index.php?vip=lay_mat_khau&email='.$e.'&code='.$code.'</span></a><br /><br />Nếu đây không phải yêu cầu do bạn thực hiện, vui lòng xóa Email này. Xin cảm ơn!<br /><br />Đội ngũ <b>#HETHONGSONGAO</b>";
        if (guimailvta($e, $name, $subject, $noi_dung, $bcc)) {
          echo "<script>swal( 
                'Thông báo!', 
                'Chúng tôi đã gửi 1 email với liên kết đặt lại mật khẩu cho tài khoản của bạn. Vui lòng kiểm tra Email (Trong hòm thư spam)!!!', 
                'success' 
              );</script>"; 
        } 
  }
} 
if (isset($_POST['changepass'])) { 
    $email = $_GET['email']; 
    $new_pass = md5($_POST['password']); 
    $new_code = substr(md5(time() + rand(0, 9)), 0, 8); 
    $sql = "UPDATE account SET password = '$new_pass', macode = '$new_code' WHERE mail='$email'"; 
    if (mysqli_query($vtasystem, $sql)) { 
        echo "<script>alert('Đổi mật khẩu thành công. Vui lòng đăng nhập!');window.location='login.php';</script>"; 
    } 
} else if (isset($_GET['code'], $_GET['email'])) { 
    $email = $_GET['email']; 
    $code = $_GET['code']; 
    $sqlss = "SELECT * FROM account WHERE mail='$email' AND macode='$code'"; 
    $resultss = mysqli_query($vtasystem, $sqlss); 
    $x = mysqli_fetch_assoc($resultss); 
    if ($x == 1) { 
        ?> 
            <div class="col-md-12"> 
                <!-- Horizontal Form --> 
                <div class="box box-info wow fadeIn"> 
                    <div class="box-header with-border"> 
                        <h3 class="box-title">Đặt lại mật khẩu mới</h3> 
                    </div> 
                    <!-- /.box-header --> 
                    <!-- form start --> 
                    <form class="form-horizontal" method="post" action="#"> 

                        <div class="form-group"> 
                            <label for="password" class="col-sm-2 control-label">Mật khẩu:</label> 

                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" name="password" id="password" placeholder="Mật khẩu mới" required> 
                            </div> 
                        </div> 

                        <!-- /.box-body --> 
                        <div class="box-footer"> 

                            <button type="submit" name="changepass" class="btn btn-info pull-right">Đổi mật khẩu</button> 
                        </div> 
                        <!-- /.box-footer --> 
                    </form> 
                </div> 
            </div> 

    <?php } else { 
        echo "<script>alert('Liên kết không hợp lệ hoặc đã hết hạn'); window.location='index.php';</script>"; 
    } 
} else { ?> 
<div class="col-lg-12"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Reset Password</h3> 
            </div> 
<div class="panel-body"> 
         <center> <h4>Quên mật khẩu?</h4> 
          <p>Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn các hướng dẫn về cách đặt lại mật khẩu.</p> 
                
               <form method="post" action="#"> 
                    <div class="form-group"> 
                        <label for="email" class="col-sm-2 control-label">Nhập địa chỉ Email:</label> 

                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" name="email" id="email" placeholder="Nhập địa chỉ Email hoặc Username" required> 
                            <?php echo isset($loi['404']) ? $loi['404'] : ''; ?> 
                        </div> 
                    </div> 

                    <!-- /.box-body --> 
                    <div class="box-footer"> 

                        <button type="submit" name="recoverpass" class="btn btn-info pull-right">Đặt lại mật khẩu</button> 
                    </div></center>  
                    <!-- /.box-footer --> 
                </form> 
            </div> 
        </div> 
<?php } ?> 