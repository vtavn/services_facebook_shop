<?php
session_start();
error_reporting(0);
include "config.php";
include "./core/head.php";
$vnd = $getuser['vnd'] + '0';
$id = $getuser['id'];
if(!$_SESSION['user']){
	echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=login_page">';
	die('<script>alert("VUI LÒNG ĐĂNG NHẬP VÀO HỆ THỐNG TRƯỚC KHI NHẬN QUÀ."); </script>');
}else if($getuser['otp'] != '1'){
	echo '<meta http-equiv=refresh content="0; URL=/hetlixi.php"">';
	die('<script>alert("BUỒN QUÁ NHỈ! HẾT LÌ XÌ MẤT RỒI.."); </script>'); 
}else if($getuser['chinhthuc'] != '1'){
	echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=nap_the">';
	die('<script>alert("BẠN KHÔNG ĐỦ ĐIỀU KIỆN ĐỂ NHẬN THƯỞNG VUI LÒNG NẠP TỐI ĐA 50.000 VNĐ!"); </script>'); 
}else if($getuser['qrcode'] == '1'){
	echo '<meta http-equiv=refresh content="0; URL=/index.php">';
	die('<script>alert("BẠN ĐÃ NHẬN QUÀ RỒI NHÉ!"); </script>'); 
}else{
	mysql_query("UPDATE account SET vnd = '$vnd', qrcode = '1' WHERE id = '$id'");
        //up log
		$timess = time();
		$content = "<b>" .$getuser['username']. "</b> vừa nhận 100.000 VNĐ Từ Quà Tết 2018!</b>";
	mysql_query("INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='TET2018',`content`='$content',`time`='".$timess."'");
	//show
	echo '<script>alert("BẠN ĐÃ NHẬN THÀNH CÔNG 100.000 vnđ VÀO TÀI KHOẢN! CẢM ƠN BẠN ĐÃ ĐỒNG HÀNH CÙNG HỆ THỐNG!."); </script>';
	die('<meta http-equiv=refresh content="0; URL=/index.php">');
}
include "./core/food.php";
?>