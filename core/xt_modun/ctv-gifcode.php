<?php
session_start(); 
include '../../config.php'; 
$getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id`=".$_SESSION['id']."")); 

if(!$_POST){
	echo json_encode(array('error' => 'true', 'messages' => 'Mày vào đây ăn lồn à'));
	exit();
}else{
	$today = date('d/m/Y H:i:s');
	include 'func.php';
	if(checklogin()){
		$code = addslashes($_POST['code']);
		$result = mysqli_query($vtasystem, "SELECT * FROM gif_code WHERE code = '$code'");
		$check_log = mysqli_query($vtasystem, "SELECT * FROM `log_gifcode` WHERE `code` ='$code' AND `user` = '{$_SESSION['user']}'");
		if(mysqli_num_rows($result) > 0 AND mysqli_num_rows($check_log) < 1){
			$gif_code_data = mysqli_fetch_assoc($result);
			if($code == $gif_code_data['code'] AND $gif_code_data['limited'] > 0){
				//Update Tiền user
				mysqli_query($vtasystem, "UPDATE `account` SET `vnd` = `vnd` + {$gif_code_data['menhgia']} WHERE `id` = '{$_SESSION['user']}'");
				//Trừ số lượt 
				mysqli_query($vtasystem, "UPDATE `gif_code` SET `limited`=`limited` -1 WHERE `code` = '$code'");
				
				//lưu log
				$timess = time(); 
		        $nguoitao = $getuser['username']; 
		        $magiftt = $getgift['gift']; 
		        $content = "<b>".$nguoitao."</b> vừa nhận được mã gift <b>".$gif_code_data['code']."</b>. Mệnh giá <b>" . number_format($gif_code_data['menhgia']) . " VNĐ</b>"; 
		        $result = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$_SESSION['id']."', `type`='GIFT',`content`='$content',`time`='".$timess."'"); 

				//Thêm vào gif đã nạp
				mysqli_query($vtasystem, "INSERT INTO `log_gifcode`(`user`, `name`, `code`, `menhgia`, `thoigian`) VALUES ('{$_SESSION['user']}','{$nguoitao}','$code','{$gif_code_data['menhgia']}','$today')");

				echo 'Nhận Gif Code Thành Công ! Bạn Nhận Được '.number_format($gif_code_data['menhgia']).' VNĐ Vào Tài Khoản!';
			}else{
				echo 'Gif code này hiện không khả dụng hoặc đã hết hạn.';
			}

		}else{
			echo 'Nhận Lắm Thế!!';
		}
	}
}

?>
