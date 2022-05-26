<?php
if (!$_SESSION['user']) {
  session_destroy();
  header("Location: login.php");
}
?>
<div class="col-lg-6"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Đăng Nhập Hệ Thống</h3> 
            </div> 
<div class="panel-body"> 
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
    $username = $_POST['username']; 
    $password = md5($_POST['password']); 
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
    echo "<script>swal('Đăng Nhập Thành Công!','Hệ Thống Sử Lý Trong 2s...','success');</script>"; 
    die('<meta http-equiv=refresh content="0; URL=/index.php">'); 
  }else{ 
    echo "<script>swal('Đăng Nhập Không Thành Công!','Sai tên đăng nhập hoặc mật khẩu.','error');</script>"; 
  } 
  } 
  } 
?> 
<form action="index.php?vip=login_page" method="POST"> 
      <div class="form-group"> 
  <label for="usr">Tên tài khoản:</label> 
  <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản..." required> 
</div> 
<div class="form-group"> 
  <label for="pwd">Mật khẩu:</label> 
  <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu..." required> 
</div> 
 <div class="form-group"> 
<label for="captcha"><img class="captcha" src="../giaodien/capcha2.php"><a class="chance-captcha"><img style="width:7%;" src="https://cdn3.iconfinder.com/data/icons/faticons/32/sync-01-128.png"></a></label> 
                <input class="form-control" placeholder="Nhập mã bảo mật bên trên vào đây" name="captcha" maxlength="6"> 
                                        <?php echo isset($loi['captcha']) ? $loi['captcha'] : ''; ?> 
              </div> 

                <div class="form-group"> 
                    <div class="checkbox"> 
                      <label> 
                        <input type="checkbox"> <b>Lưu mật khẩu.</b> 
                      </label> 
                    </div> 
                </div> 

          <button type="submit" class="btn btn-info">Đăng nhập 
          </button> 

<a href="/index.php?vip=lay_mat_khau" class="btn btn-danger pull-right">Lấy lại mật khẩu</a> 
        </form>     

      </div> 
    </div> 
  </div> 

  <div class="col-lg-6"> 
          <div class="box box-success"> 
            <div class="box-header with-border"> 
              <h3 class="box-title"> Điều Khoản Hệ Thống</h3> 
            </div> 
<div class="panel-body"> 
     <strong> Các chức năng trong phiên bản này</strong> 
    <ul> 
        <li> 
          Tạo chương trình để tự động tăng lượt thích bài đăng trên trang cá nhân. 
        </li> 
        <li> 
          Tạo chương trình để tự động tăng bình luận theo nội dung đặt sẵn để seeding bài viết trên trang cá nhân. 
        </li> 
    </ul>  
    

</div> 
</div> 
</div> 
<script> 
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