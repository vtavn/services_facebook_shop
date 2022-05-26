
<?php 
error_reporting(0); 
//Th??ng Tin 
$getsetting = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `setting_ht` WHERE `id`='1'")); 
$getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id`=".$_SESSION['user']."")); 
$get = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `thongbao` WHERE `id`='1'")); 
$now = getdate(); 

$viplikes = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM vip_like")); 
$vipcmts = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM vip_cmt")); 

$tokenhethong = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM token")); 
$taikhoans = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM account")); 
$botcamxuc = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM vip_bot")); 
$tokenhethong2 = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM tokencmt")); 
$tonggiaodich = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM `log_card` WHERE `thang` = '".$now['mon']."' ")); 

$infongdung = mysqli_query($vtasystem, "SELECT * FROM `log_card` WHERE `thang` = '".$now['mon']."' AND `menhgia` > 0"); 

$tonglichsu = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM `log_ht` WHERE `id_user`=".$_SESSION['user']."")); 
$viplikecanhan = mysqli_num_rows(mysqli_query($vtasystem, "SELECT * FROM `vip_like` WHERE `id_buy`=".$_SESSION['user']."")); 


$thunhap = 0; 
while ($getvtadz= mysqli_fetch_array($infongdung)){ 
$thunhap = $thunhap + $getvtadz[menhgia]; 
  } 

//thời gian tính 
function thoigiantinh($from, $to = '') { 
if (empty($to)) 
$to = time(); 

if(($from - time()) < 0){ 
$since = '0 ngày';     
}else{ 

$diff = (int) abs($to - $from); 
if ($diff <= 60) { 
$since = sprintf('vài giây'); 
} elseif ($diff <= 3600) { 
$mins = round($diff / 60); 
if ($mins <= 1) { 
$mins = 1; 
} 
/* translators: min=minute */ 
$since = sprintf('%s phút', $mins); 
} else if (($diff <= 86400) && ($diff > 3600)) { 
$hours = round($diff / 3600); 
if ($hours <= 1) { 
$hours = 1; 
} 
$since = sprintf('%s giờ', $hours); 
} elseif ($diff >= 86400) { 
$days = round($diff / 86400); 
if ($days <= 1) { 
$days = 1; 
} 
$since = sprintf('%s ngày', $days); 
} 

} 
return $since; 
} 

?> 
