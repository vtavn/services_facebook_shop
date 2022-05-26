<link rel="stylesheet" href="../../giaodien/toastr.css"> 
<script type="text/javascript" src="../../giaodien/toastr.min.js"></script> 
<?php
error_reporting(0);
session_start(); 
$now = getdate(); 
include '../../config.php'; 

        $TxtCard  = $_POST['key'];
        $TxtMaThe = $_POST['code'];
        $TxtSeri  = $_POST['serial'];
        $users      = $_POST['txtuser']; 

if (file_exists('aw.mp3'))
{
	unlink('aw.mp3');
}

    $loaithe = $TxtCard;
    $seri = $TxtSeri;
    $mathe = $TxtMaThe;
    $tk = 'vutienanh2901@gmail.com';
    $mk = 'nhianhbn123';

    $headers3 = array();
    $headers3[] = 'Content-Type: application/json;charset=utf-8';
    $postt = '{"username":"'.$tk.'","password":"'.$mk.'","remember":false}';
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, "https://ws.doithenhanh.com/portal/login");
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/aw.mp3");
    curl_setopt($c, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/aw.mp3");
    curl_setopt($c, CURLOPT_HTTPHEADER, $headers3);
    curl_setopt($c, CURLOPT_POST, 1);
    curl_setopt($c, CURLOPT_POSTFIELDS, $postt);
    $page = curl_exec($c);
    curl_close($c);
    $tra = json_decode($page,true);

    $headers3 = array();
    $headers3[] = 'X-Access-Token: '.$tra['token']['value'].'';
    $headers3[] = 'Content-Type: application/json;charset=utf-8';
    $postt = '{"provider":"'.$loaithe.'","serial":"'.$seri.'","pin":"'.$mathe.'"}';
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, "https://ws.doithenhanh.com/portal/charge");
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/aw.mp3");
    curl_setopt($c, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/aw.mp3");
    curl_setopt($c, CURLOPT_HTTPHEADER, $headers3);
    curl_setopt($c, CURLOPT_POST, 1);
    curl_setopt($c, CURLOPT_POSTFIELDS, $postt);
    $page = curl_exec($c);
    curl_close($c);
    $res = json_decode($page,true);

    $thongbaoerror = $res['message'];
    $maloi = $res['code'];

    print_r($res);
    if ($maloi == 0) {
        $tien = explode(' ',$thongbaoerror);
        //echo $tien['4'];
         if($tien['4'] === '10,000'){
         	$info_card = '10000';
         }else if($tien['4'] === '20,000'){
         	$info_card = '20000';
         }else if($tien['4'] === '30,000'){
         	$info_card = '30000';
         }else if($tien['4'] === '40,000'){
         	$info_card = '40000';
         }else if($tien['4'] === '50,000'){
         	$info_card = '50000';
         }else if($tien['4'] === '100,000'){
         	$info_card = '100000';
         }else if($tien['4'] === '200,000'){
         	$info_card = '200000';
         }else if($tien['4'] === '500,000'){
         	$info_card = '500000';
         }
	        mysqli_query($vtasystem, "UPDATE `account` SET  `vnd` = `vnd` + '".$info_card."', `napthe` = `napthe` + '".$info_card."' WHERE `username`  ='".$users."'"); 
	        mysqli_query($vtasystem, "INSERT INTO `log_card` SET `nguoinhan` = '".$users."', `time`='".date("d.m.Y, H:i:s")."', `mathe`='".$TxtMaThe."', `seri`='".$TxtSeri."', `loaithe`='".$TxtCard."', `thang` = '".$now['mon']."', `menhgia`='".$info_card."'"); 
	                //up log 
	        $timess = time(); 
	        $content = "<b>".$users."</b> vừa nạp thẻ ".$TxtCard.". Mệnh giá <b>" . number_format($info_card) . " VNĐ. Tổng thanh toán <b>" . number_format($info_card) . " VNĐ</b>"; 
	        mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['user']."', `type`='NAPTHE',`content`='$content',`time`='".$timess."'"); 
	        echo '<script>swal(
	                                    "Thông báo!",
	                                    "Nạp Thẻ Thành Công!! Mệnh giá ' . number_format($info_card) . ' VNĐ.",
	                                    "success"
	                                );</script>';
    }else {
    	//echo $thongbaoerror;
        echo '<script>swal(
                        "Thông báo!",
                        "'.$thongbaoerror.' & '.$users.' '.$TxtMaThe.' & '.$TxtSeri.' ",
                        "error"
                    );</script>';
    }
//0 thành công
//17 serial ko đúng
//13 sai mã thẻ
//-2 thẻ đã sử dụng
?>