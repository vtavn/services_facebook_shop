<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include '../config.php';
include 'functions.php';
include 'mail/PHPMailerAutoload.php';
include 'mail/func.php';
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
         <title><?php echo $getsetting['title']; ?></title>
	    <link href="https://camo.githubusercontent.com/beede1ff8999a3d69c452f1cd0df90e076454344/687474703a2f2f7275627967656d732e6f72672f66617669636f6e2e69636f" rel="shortcut icon" />
        <link rel="stylesheet" href="../giaodien/fonts.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="../giaodien/toastr.css">
        <link rel="stylesheet" href="../giaodien/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../giaodien/vta.css">
        <link rel="stylesheet" href="../giaodien/pace.min.css">

	    <link href="../giaodien/animate.css" rel="stylesheet" type="text/css" />
	    <script src="../giaodien/wow.js"></script>
	        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> 
	                <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.css" rel="stylesheet" />
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.js"></script>
		<link rel="stylesheet" href="../giaodien/lol.css" property="stylesheet"> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
		<script type="text/javascript" src="../giaodien/toastr.min.js"></script> 
		<script type="text/javascript" src="../giaodien/app.js"></script> 
		<script type="text/javascript" src="../giaodien/pace.min.js"></script> 
            <script type="text/javascript" src="../giaodien/jquery.dataTables.min.js"></script> 
    <script type="text/javascript" src="../giaodien/dataTables.bootstrap.min.js"></script> 
<style>
body{
  cursor: url('../giaodien/arrow.cur'), auto;
}
a:hover,input:hover,select:hover,button:hover{
  cursor: url('../giaodien/hover.cur'), auto;
}
</style>
<script type="text/javascript">
    $(window).load(function(){
            setTimeout(function() {
                $('#loading').fadeOut( 400, "linear" );
            }, 300);
    });
    new WOW().init();
      $(window).load(function() {
          $(".loader").fadeOut("slow");
    });
        function logout(){
            swal({
              title: 'Bạn có chắc chắn muốn đăng xuất?',
              text: "HETHONGSONGAO_COM",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Vâng, Tôi muốn!',
              cancelButtonText: 'Trở về'
            }).then(function() {
              location.href = "/index.php?vip=logout";
            })
        }

	window.onload = function(){
	    document.getElementById('warning').click();
	};
</script>

</head>

<div id="loading">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>


<!--div class="loader"></div-->      
<?php
if(!$_SESSION['user']){
?>
<body class="hold-transition layout-boxed skin-<?php echo $getsetting['giaodien']; ?> sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <a href="/" class="logo" style="background: url('https://res-zaloapp.zadn.vn/pc/banners/newpattern-1.png'), linear-gradient(rgb(191, 53, 67), rgb(183, 25, 41));">
            <span class="logo-mini"><!--img src="" alt="" /--><b>VTA</b></span>
            <span class="logo-lg"><img src="<?php echo $getsetting['logo']; ?>" alt="<?php echo $getsetting['title']; ?>" ><!--b>VTA</b> SYSTEM--></span>
        </a>

        <nav class="navbar navbar-static-top" style="background: url('https://res-zaloapp.zadn.vn/pc/banners/newpattern-1.png'), linear-gradient(rgb(191, 53, 67), rgb(183, 25, 41));" role="navigation">
            <a class="sidebar-toggle" style="background: url('https://res-zaloapp.zadn.vn/pc/banners/newpattern-1.png'), linear-gradient(rgb(191, 53, 67), rgb(183, 25, 41));" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation </span>
            </a>


      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">
                <li><a class="dropdown-toggle" id="timer"></a></li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="https://graph.facebook.com/100009580369715/picture?type=large" class="user-image" alt="User Image">
              <span class="hidden-xs">Chào Khách</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="https://graph.facebook.com/100009580369715/picture?type=large" class="img-circle" alt="User Image">

                <p>
                  VTASYSTEM - Hệ Thống VIP LIKE
                  <small>Thành lập ngày 28-07-2017</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">+99 ID</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">+99 Tài Khoản</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">UY TÍN</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="https://www.facebook.com/NguyenThiLanNhi.Love.Ahihi" class="btn btn-default btn-flat">Admin</a>
                </div>
                <div class="pull-right">
                  <a href="/index.php?vip=reg" class="btn btn-default btn-flat">Sử Dụng</a>
                </div>
              </li>
            </ul>
          </li>
                    <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
</ul>
            </div>

        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
                 <div class="user-panel">
                      <div class="pull-left image">
                           <img class="img-circle" src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/e4299734559659.56d57de04bda4.gif" alt="Avatar" width="100" height="100">
                      </div>
                      <div class="pull-left info">
                           <p>
                          Chào Khách
                           </p>
                           <p>
                           <i class="text">
                             Bạn chưa đăng nhập
                           </i>
                           </p>
                      </div>
                 </div>
            <ul class="sidebar-menu">
                <li class="active Home wow wobble"><a href="/"><i class="fa fa-home" style="color: #00a65a;"></i> <span>TRANG CHỦ</span></a></li>
      <li class="bg-green"><a style="color: #fff;background-image: url('https://zmp3-static.zadn.vn/skins/zmp3-v5.1/images/tet/backgroud_tet.png'); background-repeat: no-repeat,repeat; background-position: center;" href="https://bit.ly/SupportVTASYSTEM" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i>
 <span>HỖ TRỢ THÀNH VIÊN</span></a></li>
        <li><a href="/index.php?vip=Top_Nap_The"><i class="fa fa-line-chart text-red"></i> <span>TOP CARD</span></a></li>

<li class="header">#MENU</li>


<li ><a href="/index.php?vip=tao_tai_khoan"><i class="fa fa-user-plus" aria-hidden="true"></i> <span>Đăng Ký</span></a></li>
<li><a href="/login.php"><i class="fa fa-user" aria-hidden="true"></i> <span>Đăng Nhập</span></a></li>
<li><a data-toggle="modal" href="#banggia"><i class="fa fa-usd" aria-hidden="true"></i> <span> <span>Bảng giá</span></a></li>
<li class="wow wobble"><a href="/index.php?vip=HETHONGSONGAO_COM"><i class="fa fa-usd" aria-hidden="true"></i> <span>QUẢN TRỊ</span></a></li>
<li class="wow fadeInUp" data-wow-duration="2.25s"><a href="#vtasystemnoti" id="warning" data-toggle="modal"><i class="glyphicon glyphicon-star-empty"></i> <span>Thông Báo Mới</span></a></li>

                </li>
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        <section class="content">
            <div class="row">
 <?php
 }else{
 ?>

<body onload="startTime()" class="hold-transition layout-boxed skin-<?php echo $getsetting['giaodien']; ?> sidebar-mini">
<div class="wrapper">
    <header class="main-header">

        <a href="/" class="logo" style="background: url('https://res-zaloapp.zadn.vn/pc/banners/newpattern-1.png'), linear-gradient(rgb(191, 53, 67), rgb(183, 25, 41));">
            <span class="logo-mini"><!--img src="" alt="" /--><b>VTA</b></span>
            <span class="logo-lg"><img src="<?php echo $getsetting['logo']; ?>" alt="<?php echo $getsetting['title']; ?>" ><!--b>VTA</b> SYSTEM--></span>
        </a>

        <nav class="navbar navbar-static-top" style="background: url('https://res-zaloapp.zadn.vn/pc/banners/newpattern-1.png'), linear-gradient(rgb(191, 53, 67), rgb(183, 25, 41));" role="navigation">
            <a class="sidebar-toggle" style="background: url('https://res-zaloapp.zadn.vn/pc/banners/newpattern-1.png'), linear-gradient(rgb(191, 53, 67), rgb(183, 25, 41));" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation </span>
            </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                <li><a class="dropdown-toggle" id="timer"></a></li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="https://graph.facebook.com/<?php echo $getuser['idfb']; ?>/picture?type=large" class="user-image" alt="User Image">
              <span class="hidden-xs"><b><?php echo $getuser['fullname']; ?></b>  <i class="fa fa-sort-desc" aria-hidden="true"></i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="https://graph.facebook.com/<?php echo $getuser['idfb']; ?>/picture?type=large" class="img-circle" alt="User Image">

                <p>
                 <?php echo $getuser['fullname']; ?> - @<?php echo $getuser['username']; ?>
                  <small><?php echo number_format($getuser['vnd'], 0, ',', ','); ?> VNĐ</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center">
                    <a href="#"><?php echo number_format($getuser['sao'], 0, ',', ','); ?> A+</a>
                  </div>
                  <div class="col-xs-6 text-center">
                    <a href="/index.php?vip=log_active">Lịch Sử</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="https://facebook.com/<?php echo $getuser['idfb']; ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" data-toggle="tooltip" title="" onclick="logout()" data-original-title="Đăng xuất khỏi hệ thống" class="btn btn-default btn-flat">Thoát</a>
                </div>
              </li>
            </ul>
          </li>
                    <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
</ul>
            </div>

        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
                 <div class="user-panel">
                      <div class="pull-left image">
                           <img class="img-circle" src="https://graph.facebook.com/<?php echo $getuser['idfb']; ?>/picture" alt="Avatar" width="100" height="100">
                      </div>
                      <div class="pull-left info">
                           <p>
                           <span class="badge bg-teal"><?php echo $getuser['fullname']; ?></span> <?php if($getuser['kichhoat'] ==  1) { echo '<img src="https://i.imgur.com/zDXXsoW.png" height="17px" weight="17px" aria-hidden="true" style="color:#60d43c;" data-toggle="tooltip" data-placement="right" title="" data-original-title="Verify">'; }?>
                           </p>
                           <p>
                           <i class="text-success">
                             <span class="badge bg-red"><?php echo number_format($getuser['vnd'], 0, ',', ','); ?> VNĐ</span>
                           </i>
                           </p>
                      </div>
                 </div>
            <ul class="sidebar-menu">
                <li class="active Home wow wobble"><a href="/"><i class="fa fa-home" style="color: #00a65a;"></i> <span>TRANG CHỦ</span></a></li>
      <li class="bg-green"><a style="color: #fff;background-image: url('https://zmp3-static.zadn.vn/skins/zmp3-v5.1/images/tet/backgroud_tet.png'); background-repeat: no-repeat,repeat; background-position: center;" href="https://bit.ly/SupportVTASYSTEM" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i> <span>Hỗ Trợ Thành Viên</span></a></li>

        <li><a href="/index.php?vip=Top_Nap_The"><i class="fa fa-line-chart text-red"></i> <span>TOP CARD</span></a></li>
        <li><a href="/index.php?vip=bao_danh"><i class="glyphicon glyphicon-star-empty"></i> <span>Báo Danh Nhận Quà</span></a></li>
        <!--li><a href="#vtasystemnoti" id="warning" data-toggle="modal"><i class="glyphicon glyphicon-star-empty"></i> <span>Báo Danh Nhận Quà</span></a></li--> 
        <li><a href="/index.php?vip=ticket"><i class="fa fa-life-ring text-red"></i> <span>GỬI HỖ TRỢ</span></a></li>
        <li><a href="#vtasystemnoti" id="warnings" data-toggle="modal"><i class="glyphicon glyphicon-star-empty"></i> <span>Thông Báo</span></a></li>

<li class="header">#MENU</li>
<li class="treeview">
          <a href="#">
<i class="fa fa-thumbs-o-up"></i> <span>VIP LIKE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?vip=add_viplikecx"><i class="fa fa-circle-o"></i> Thêm Vip Like</a></li>
            <li><a href="index.php?vip=manager_viplikecx"><i class="fa fa-circle-o"></i> Quản Lý ID VIP</a></li>
          </ul>
        </li>
<li class="treeview">
          <a href="#">
<i class="fa fa-comments-o"></i> <span>VIP CMT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?vip=add_vipcmt"><i class="fa fa-circle-o"></i> Thêm Vip Like</a></li>
            <li><a href="index.php?vip=manager_vipcmt"><i class="fa fa-circle-o"></i> Quản Lý ID VIP</a></li>
          </ul>
        </li>

<li class="treeview">
          <a href="#">
<i class="fa fa-thumbs-o-up"></i> <span>VIP BOT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a target="_blank" href="//tuongtac.me"><i class="fa fa-circle-o"></i> Thêm Vip BOT</a></li>
            <li><a href="index.php?vip=manager_vipbot"><i class="fa fa-circle-o"></i> Quản Lý ID BOT</a></li>
          </ul>
        </li>
<li><a href="/index.php?vip=vip_buff_like"><i class="fa fa-hand-o-right"></i> <span>VIP BUZZ</span></a></li>
<li><a data-toggle="modal" href="#banggia"><i class="fa fa-usd" aria-hidden="true"></i> <span> <span>Bảng giá</span></a></li>

<li class="header">#MEMBER PANEL</li>
<li><a href="/index.php?vip=nap_the"><i class="fa fa-money" aria-hidden="true"></i> <span>NẠP THẺ</span></a></li>
<li><a href="/index.php?vip=nhan_gift"><i class="fa fa-gift" aria-hidden="true"></i> <span>Nhận Gift</span></a></li>
<li><a href="/index.php?vip=chuyen_tien"><i class="fa fa-exchange" aria-hidden="true"></i> <span>Chuyển Tiền</span></a></li>
<li><a href="/index.php?vip=log_active"><i class="fa fa-history" aria-hidden="true"></i> <span>Lịch Sử</span></a></li>
<li class="treeview">
          <a href="#">
<i class="fa fa-info-circle" aria-hidden="true"></i> <span>Cập nhật thông tin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/index.php?vip=change_info"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> <span>Cập nhật thông tin</span></a></li>
            <li><a href="/index.php?vip=change_pass"><i class="fa fa-cloud" aria-hidden="true"></i> <span>Đổi mật khẩu</span></a></li>
            <li><a href="/index.php?vip=change_pass_2"><i class="fa fa-cloud" aria-hidden="true"></i> <span>Đổi mật khẩu cấp 2</span></a></li>
          </ul>
        </li>
<?php if($getuser['level'] == 2){ ?>
<li class="header">#DAILY PANEL</li>
<li><a href="/index.php?vip=them_ctv"><i class="fa fa-circle-o"></i> <span>Thêm Cộng Tác Viên</span></a></li>
<li><a href="/index.php?vip=quan_ly_ctv_cuaminh"><i class="fa fa-circle-o"></i> <span>Quản Lý CTV</span></a></li>

<?php } ?>


<?php if($getuser['level'] == 1){ ?>
<li class="header">#EXCHANGE PANEL</li>
                    <li><a href="/index.php?vip=chuyen_tien"><i class="fa fa-exchange" aria-hidden="true"></i> <span>Chuyển Tiền</span></a></li>
                    <li><a href="/index.php?vip=them_chuc_vu"><i class="fa fa-user-plus" aria-hidden="true"></i> <span>Thêm Chức Vụ</span></a></li>
<li class="header">#ADMIN PANEL</li>
<!--ADMIN-->
<li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-user"></i> <span>Quản Lý Member</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                     <li><a href="/index.php?vip=chuyen_tien"><i class="fa fa-circle-o"></i> <span>Chuyển Tiền Cho Member</span></a></li>
                     <li><a href="/index.php?vip=them_chuc_vu"><i class="fa fa-circle-o"></i> <span>Thêm Chức Vụ</span></a></li>
                     <li><a href="/index.php?vip=quan_ly_ctv"><i class="fa fa-circle-o"></i> <span>Danh Sách CTV</span></a></li>
                     <li><a href="/index.php?vip=quan_ly_dai_ly"><i class="fa fa-circle-o"></i> <span>Danh Sách Đại Lý</span></a></li>
                     <li><a href="/index.php?vip=manager_member"><i class="fa fa-circle-o"></i><span>Tài Khoản Hệ Thống</span></a></li>

              </ul>
            </li>
<?php if($getuser['id'] == 114 || $getuser['id'] == 1){ ?>
      <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-record"></i> <span>Quản Lý Token</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                     <li><a href="/index.php?vip=add_token"><i class="fa fa-circle-o"></i> <span>ADD TOKEN LIKE</span></a></li>
                     <li><a href="/index.php?vip=del_token"><i class="fa fa-circle-o"></i> <span>DELETE TOKEN LIKE</span></a></li>
                     <li><a href="/index.php?vip=add_token_cmt"><i class="fa fa-circle-o"></i> <span>ADD TOKEN CMT</span></a></li>
                     <li><a href="/index.php?vip=del_token_cmt"><i class="fa fa-circle-o"></i> <span>DELETE TOKEN CMT</span></a></li>              
              </ul>
            </li>
      <li class="treeview">
              <a href="#"><i class="fa fa-life-ring"></i> <span>Quản Lý Ticket</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                     <li><a href="/index.php?vip=quanly_ticket"><i class="fa fa-circle-o"></i> <span>Danh Sách Ticket</span></a></li>
              </ul>
            </li>
<?php } ?>

<li class="treeview">
              <a href="#"><i class="fa fa-flag" aria-hidden="true"></i> <span>Hệ Thống</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                     <li><a href="/index.php?vip=tao_gift"><i class="fa fa-gift" aria-hidden="true"></i> <span>Quản Lý & Tạo Gift</span></a></li>
                     <li><a href="/index.php?vip=tao_thong_bao"><i class="fa fa-circle-o"></i> <span>Tạo Thông Báo</span></a></li>
                     <li><a href="/index.php?vip=statics"><i class="fa fa-circle-o"></i> <span>Statics</span></a></li>
                     <li><a href="/index.php?vip=list_id_vip_camxuc"><i class="fa fa-circle-o"></i> <span>List ID VIP CX</span></a></li>
                     <li><a href="/index.php?vip=list_id_vip_bot"><i class="fa fa-circle-o"></i> <span>List ID BOT CX</span></a></li>
                     <li><a href="/index.php?vip=lich_su_he_thong"><i class="fa fa-circle-o"></i> <span>Lịch Sử Hệ Thống</span></a></li>
                     <li><a href="/index.php?vip=them_coupon"><i class="fa fa-circle-o"></i> <span>Quản Lý & Coupon</span></a></li>
              </ul>
            </li>
<?php if($getuser['id'] == 1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-hdd"></i> <span>Package VIP</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-thumbs-o-up"></i> Package VIP LIKE
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                     <li><a href="/index.php?vip=add_package_like"><i class="fa fa-circle-o"></i> <span>Add Package VIP LIKE</span></a></li>
                     <li><a href="index.php?vip=list_package_like"><i class="fa fa-circle-o"></i> <span>Quản Lý Package LIKE</span></a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-comments"></i> Package VIP CMT
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                     <li><a href="/index.php?vip=add_package_cmt"><i class="fa fa-circle-o"></i> <span>Add Package VIP CMT</span></a></li>
                     <li><a href="index.php?vip=list_package_cmt"><i class="fa fa-circle-o"></i> <span>Quản Lý Package CMT</span></a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-heartbeat"></i> Package VIP BOT
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                     <li><a href="/index.php?vip=add_package_like"><i class="fa fa-circle-o"></i> <span>Add Package VIP BOT</span></a></li>
                     <li><a href="index.php?vip=list_package_like"><i class="fa fa-circle-o"></i> <span>Quản Lý Package BOT</span></a></li>
              </ul>
            </li>
          </ul>
        </li>
<?php } ?>
<!--END ADMIN-->
        <li class="treeview">
                <a href="/index.php?vip=setting">
                    <i class="fa fa-cogs"></i> <span>Cài đặt</span>
                </a>
        </li>
<?php } ?>

                </li>
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        <section class="content">
            <div class="row">
<?php } ?>
