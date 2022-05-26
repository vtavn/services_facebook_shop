<?php
session_start(); 
include '../../config.php'; 
	include 'func.php';
if(!$_POST){
	exit();
}
	if(isAdmin($_SESSION['id'])){
		if($_POST['action'] === 'creat'){
			$result = mysqli_query($vtasystem, "SELECT * FROM gif_code WHERE code = '{$_POST['code']}'");
			if(mysqli_num_rows($result) > 0){
				echo 'error';
			}else{
				$result = mysqli_query($vtasystem, "INSERT INTO `gif_code`(`code`, `limited`, `menhgia`) VALUES ('{$_POST['code']}','{$_POST['limit']}','{$_POST['menhgia']}')");
    //up log 
    $getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id`=".$_SESSION['id']."")); 
    $timess = time(); 
    $nguoitao = $getuser['username']; 
    $content = "<b>".$nguoitao."</b> vừa thêm tạo mã gift <b>".$_POST['code']."</b>. Số lượt nhận <b>" . number_format($_POST['limit']) . " . Mệnh giá <b>" . number_format($_POST['menhgia']) . " VNĐ</b>"; 
    $result = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$_SESSION['id']."', `type`='GIFT',`content`='$content',`time`='".$timess."'"); 
            //end 

				echo 'done';
			}
		}
		$input = filter_input_array(INPUT_POST);

		if ($input['action'] === 'edit') {
		    mysqli_query($vtasystem, "UPDATE `gif_code` SET `limited`='{$input['conlai']}',`menhgia`='{$input['menhgia']}' WHERE id = '{$input['id']}'");
		} else if ($input['action'] === 'delete') {
		    mysqli_query($vtasystem, "DELETE FROM `gif_code` WHERE id='" . $input['id'] . "'");
		}
		
	}
?>