<?php
session_start();
error_reporting(0);
include "config.php";
include "./core/head.php";
$vnd = $getuser['vnd'] + '50000';
$id = $getuser['id'];
if(!$_SESSION['user']){
	echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=login_page">';
	die('<script>alert("VUI LÒNG ĐĂNG NHẬP VÀO HỆ THỐNG TRƯỚC KHI NHẬN MÃ QR!."); </script>');
}else if($getuser['qrcode'] == '1'){
	echo '<meta http-equiv=refresh content="0; URL=/index.php">';
	die('<script>alert("BẠN ĐÃ NHẬN THƯỞNG RỒI NHÉ!"); </script>');
}else if($getuser['idvip'] > '1'){
	echo '<meta http-equiv=refresh content="0; URL=/index.php">';
	die('<script>alert("CÓ ÍT NHẤT 1 UID VIP TRÊN HỆ THỐNG MỚI ĐƯỢC THAM GIA SỰ KIỆN!."); </script>'); 
}else{
	mysql_query("UPDATE account SET vnd = '$vnd', qrcode = '1' WHERE id = '$id'");
        //up log
		$timess = time();
		$content = "<b>" .$getuser['username']. "</b> vừa nhận 50.000 VNĐ Từ Quà Tặng Mã QR!</b>";
	mysql_query("INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='EVENT',`content`='$content',`time`='".$timess."'");
	//show
	echo '<script>alert("BẠN ĐÃ NHẬN THÀNH CÔNG 50.000 vnđ VÀO TÀI KHOẢN! CẢM ƠN BẠN ĐÃ ĐỒNG HÀNH CÙNG HỆ THỐNG!."); </script>';
	die('<meta http-equiv=refresh content="0; URL=/index.php">');
}
include "./core/food.php";
?>